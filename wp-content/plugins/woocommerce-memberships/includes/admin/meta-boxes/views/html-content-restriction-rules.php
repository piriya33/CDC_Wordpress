<?php
/**
 * WooCommerce Memberships
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Memberships to newer
 * versions in the future. If you wish to customize WooCommerce Memberships for your
 * needs please refer to http://docs.woothemes.com/document/woocommerce-memberships/ for more information.
 *
 * @package   WC-Memberships/Admin/Views
 * @author    SkyVerge
 * @category  Admin
 * @copyright Copyright (c) 2014-2016, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * View for content restriction rules table
 *
 * @since 1.0.0
 * @version 1.0.0
 */
?>

<table class="widefat rules content-restriction-rules js-rules">

	<thead>
		<tr>

			<th class="check-column">
				<input type="checkbox"
				       id="content-restriction-rules-select-all">
				<label for="content-restriction-rules-select-all"> <?php esc_html_e( "Select all", 'woocommerce-memberships' ); ?></label>
			</th>

			<?php if ( 'wc_membership_plan' == $post->post_type ) : ?>

				<th class="content-restriction-content-type">
					<?php esc_html_e( "Type", 'woocommerce-memberships' ); ?>
				</th>

				<th class="content-restriction-objects">
					<?php esc_html_e( "Title", 'woocommerce-memberships' ); ?>
					<?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'Search&hellip; or leave blank to apply to all', 'woocommerce-memberships' ) ); ?>
				</th>

			<?php else : ?>

				<th class="content-restriction-membership-plan">
					<?php esc_html_e( "Plan", 'woocommerce-memberships' ); ?>
				</th>

			<?php endif; ?>

				<th class="content-restriction-access-schedule">
					<?php esc_html_e( "Accessible", 'woocommerce-memberships' ); ?>
					<?php echo SV_WC_Plugin_Compatibility::wc_help_tip( __( 'When will members gain access to content?', 'woocommerce-memberships' ) ); ?>
				</th>

		</tr>
	</thead>

	<?php foreach ( $content_restriction_rules as $index => $rule ) : ?>
		<?php require( wc_memberships()->get_plugin_path() . '/includes/admin/meta-boxes/views/html-content-restriction-rule.php' ); ?>
	<?php endforeach;?>

	<?php $membership_plans = wc_memberships_get_membership_plans( array( 'post_status' => array( 'publish', 'private', 'future', 'draft', 'pending', 'trash' ) ) ); ?>

	<tbody class="norules <?php if ( count( $content_restriction_rules ) > 1 ) : ?>hide<?php endif; ?>">
		<tr>

			<td colspan="<?php echo ( 'wc_membership_plan' == $post->post_type ) ? 4 : 3; ?>">

				<?php if ( 'wc_membership_plan' == $post->post_type ) : ?>

					<?php esc_html_e( 'There are no rules yet. Click below to add one.', 'woocommerce-memberships' ); ?>

				<?php else : ?>

					<?php if ( empty( $membership_plans ) ) : ?>
						<?php esc_html_e( 'To create restriction rules, please', 'woocommerce-memberships' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=wc_membership_plan' ) ); ?>"><?php esc_html_e( 'Add a Membership Plan', 'woocommerce-memberships' ); ?></a>.
					<?php else : ?>
						<?php esc_html_e( 'This content can be viewed by all visitors. Add a rule to restrict it to members.', 'woocommerce-memberships' ); ?>
					<?php endif; ?>

				<?php endif; ?>

			</td>

		</tr>
	</tbody>

	<?php if ( 'wc_membership_plan' == $post->post_type || ! empty( $membership_plans ) ) : ?>

		<tfoot>
			<tr>
				<th colspan="<?php echo ( 'wc_membership_plan' == $post->post_type ) ? 4 : 3; ?>">
					<button type="button"
					        class="button button-primary add-rule js-add-rule">
						<?php esc_html_e( 'Add New Rule', 'woocommerce-memberships' ); ?>
					</button>
					<button type="button"
					        class="button button-secondary remove-rules js-remove-rules
					        <?php if ( count( $content_restriction_rules ) < 2 ) : ?>hide<?php endif; ?>">
						<?php esc_html_e( 'Delete Selected', 'woocommerce-memberships' ); ?>
					</button>
				</th>
			</tr>
		</tfoot>

	<?php endif; ?>

</table>
