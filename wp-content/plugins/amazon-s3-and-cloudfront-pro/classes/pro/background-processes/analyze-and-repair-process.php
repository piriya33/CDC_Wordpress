<?php

namespace DeliciousBrains\WP_Offload_Media\Pro\Background_Processes;

use DeliciousBrains\WP_Offload_Media\Items\Media_Library_Item;

abstract class Analyze_And_Repair_Process extends Background_Tool_Process {

	/**
	 * @var string
	 */
	protected $action = 'analyze_and_repair';

	/**
	 * Process attachments chunk.
	 *
	 * @param array $attachments
	 * @param int   $blog_id
	 *
	 * @return array
	 *
	 * @throws \Exception
	 */
	protected function process_attachments_chunk( $attachments, $blog_id ) {
		$processed = $attachments;

		foreach ( $attachments as $key => $attachment_id ) {
			if ( $this->as3cf->is_attachment_served_by_provider( $attachment_id, true, true ) ) {
				$this->handle_attachment( $attachment_id, $blog_id );
			}
		}

		// Whether handled or not, we processed every item.
		return $processed;
	}

	/**
	 * Analyze and repair each attachment's offload metadata and log any errors.
	 *
	 * @param int $attachment_id
	 * @param int $blog_id
	 *
	 * @return bool
	 * @throws \Exception
	 */
	protected function handle_attachment( $attachment_id, $blog_id ) {
		$as3cf_item = Media_Library_Item::get_by_source_id( $attachment_id );

		if ( empty( $as3cf_item ) ) {
			return false;
		}

		$result = $this->analyze_and_repair( $as3cf_item );

		// Build generic error message.
		if ( is_wp_error( $result ) ) {
			if ( $this->count_errors() < 100 ) {
				foreach ( $result->get_error_messages() as $error_message ) {
					$error_msg = sprintf( __( 'Error - %s', 'amazon-s3-and-cloudfront' ), $error_message );
					$this->record_error( $blog_id, $attachment_id, $error_msg );
				}
			}

			return false;
		}

		return true;
	}

	/**
	 * Performs required analysis and repairs for given offloaded item.
	 *
	 * @param Media_Library_Item $as3cf_item
	 *
	 * @return bool|\WP_Error Returns false if no action required, true if repaired, or WP_Error if could not be processed or repaired.
	 */
	abstract protected function analyze_and_repair( Media_Library_Item $as3cf_item );

	/**
	 * Called when background process has been cancelled.
	 */
	protected function cancelled() {
		// Do nothing at the moment.
	}

	/**
	 * Called when background process has been paused.
	 */
	protected function paused() {
		// Do nothing at the moment.
	}

	/**
	 * Called when background process has been resumed.
	 */
	protected function resumed() {
		// Do nothing at the moment.
	}

	/**
	 * Called when background process has completed.
	 */
	protected function completed() {
		// Do nothing at the moment.
	}
}