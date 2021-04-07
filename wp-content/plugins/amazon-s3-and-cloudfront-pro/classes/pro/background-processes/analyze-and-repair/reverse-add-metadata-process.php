<?php

namespace DeliciousBrains\WP_Offload_Media\Pro\Background_Processes\Analyze_And_Repair;

use DeliciousBrains\WP_Offload_Media\Items\Media_Library_Item;
use DeliciousBrains\WP_Offload_Media\Pro\Background_Processes\Analyze_And_Repair_Process;
use WP_Error;

class Reverse_Add_Metadata_Process extends Analyze_And_Repair_Process {

	/**
	 * @var string
	 */
	protected $action = 'reverse_add_metadata';

	/**
	 * Get blog attachments to process.
	 *
	 * @param int  $last_attachment_id
	 * @param int  $limit Maximum number of attachment IDs to return
	 * @param bool $count Just return the count, negates $limit, default false
	 *
	 * @return array|int
	 */
	protected function get_blog_attachments( $last_attachment_id, $limit, $count = false ) {
		return Media_Library_Item::get_source_ids( $last_attachment_id, $limit, $count, Media_Library_Item::ORIGINATORS['metadata-tool'] );
	}

	/**
	 * Performs required analysis and repairs for given offloaded item.
	 *
	 * @param Media_Library_Item $as3cf_item
	 *
	 * @return bool|WP_Error Returns false if no action required, true if repaired, or WP_Error if could not be processed or repaired.
	 */
	protected function analyze_and_repair( Media_Library_Item $as3cf_item ) {
		return $as3cf_item->delete();
	}

	/**
	 * Get complete notice message.
	 *
	 * @return string
	 */
	protected function get_complete_message() {
		return __( '<strong>WP Offload Media</strong> &mdash; Finished removing items previously created with the Add Metadata tool.', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Called when background process has completed.
	 */
	protected function completed() {
		delete_site_option( $this->prefix . '_add_metadata_last_started' );
		$this->as3cf->update_media_library_total();
	}
}