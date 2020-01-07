<?php
/**
 * View: Top Bar Hide Recurring Events Toggle
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/views/v2/recurrence/hide-recurring.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.7.5
 *
 */
?>
<div class="tribe-common-form-control-toggle tribe-events-c-top-bar__hide-recurring">
	<input
		class="tribe-common-form-control-toggle__input tribe-events-c-top-bar__hide-recurring-input"
		id="hide-recurring"
		name="hide-recurring"
		type="checkbox"
		data-js="tribe-events-pro-top-bar-toggle-recurrence"
		<?php echo checked( tribe_events_template_var( [ 'bar', 'hide_recurring' ], false ) ) ?>
		autocomplete="off"
	/>
	<label
		class="tribe-common-form-control-toggle__label tribe-events-c-top-bar__hide-recurring-label"
		for="hide-recurring"
	>
		<?php esc_html_e( 'Hide Recurring Events', 'tribe-events-calendar-pro' ); ?>
	</label>
</div>
