var cf7signature_resized = 0; // for compatibility with contact-form-7-signature-addon

var wpcf7cf_timeout;

var wpcf7cf_show_animation = { "height": "show", "marginTop": "show", "marginBottom": "show", "paddingTop": "show", "paddingBottom": "show" };
var wpcf7cf_hide_animation = { "height": "hide", "marginTop": "hide", "marginBottom": "hide", "paddingTop": "hide", "paddingBottom": "hide" };

var wpcf7cf_show_step_animation = { "width": "show", "marginLeft": "show", "marginRight": "show", "paddingRight": "show", "paddingLeft": "show" };
var wpcf7cf_hide_step_animation = { "width": "hide", "marginLeft": "hide", "marginRight": "hide", "paddingRight": "hide", "paddingLeft": "hide" };

var wpcf7cf_change_events = 'input.wpcf7cf paste.wpcf7cf change.wpcf7cf click.wpcf7cf propertychange.wpcf7cf';

wpcf7cf_forms = [];

// endswith polyfill
if (!String.prototype.endsWith) {
	String.prototype.endsWith = function(search, this_len) {
		if (this_len === undefined || this_len > this.length) {
			this_len = this.length;
		}
		return this.substring(this_len - search.length, this_len) === search;
	};
}

Wpcf7cfForm = function($form) {

    var options_element = $form.find('input[name="_wpcf7cf_options"]').eq(0);
    if (!options_element.length || !options_element.val()) {
        // doesn't look like a CF7 form created with conditional fields plugin enabled.
        return false;
    }

    var form = this;

    var form_options = JSON.parse(options_element.val());

    form.$form = $form;
    form.$hidden_group_fields = $form.find('[name="_wpcf7cf_hidden_group_fields"]');
    form.$hidden_groups = $form.find('[name="_wpcf7cf_hidden_groups"]');
    form.$visible_groups = $form.find('[name="_wpcf7cf_visible_groups"]');
    form.$repeaters = $form.find('[name="_wpcf7cf_repeaters"]');

    form.unit_tag = $form.closest('.wpcf7').attr('id');
    form.conditions = form_options['conditions'];

    // compatibility with conditional forms created with older versions of the plugin ( < 1.4 )
    for (var i=0; i < form.conditions.length; i++) {
        var condition = form.conditions[i];
        if (!('and_rules' in condition)) {
            condition.and_rules = [{'if_field':condition.if_field,'if_value':condition.if_value,'operator':condition.operator}];
        }
    }

    form.initial_conditions = form.conditions;
    form.settings = form_options['settings'];

    form.$groups = jQuery(); // empty jQuery set
    form.repeaters = [];
    form.multistep = null;
    form.fields = [];

    form.settings.animation_intime = parseInt(form.settings.animation_intime);
    form.settings.animation_outtime = parseInt(form.settings.animation_outtime);

    if (form.settings.animation === 'no') {
        form.settings.animation_intime = 0;
        form.settings.animation_outtime = 0;
    }

    form.updateGroups();
    form.updateEventListeners();
    form.displayFields();

    // bring form in initial state if the reset event is fired on it.
    form.$form.on('reset', form, function(e) {
        var form = e.data;
        setTimeout(function(){
            form.displayFields();
        },200);
    });

    //removed pro functions

}
Wpcf7cfForm.prototype.displayFields = function() {

    var form = this;

    wpcf7cf.get_simplified_dom_model(form.$form);

    var unit_tag = this.unit_tag;
    var wpcf7cf_conditions = this.conditions;
    var wpcf7cf_settings = this.settings;

    //for compatibility with contact-form-7-signature-addon
    if (cf7signature_resized === 0 && typeof signatures !== 'undefined' && signatures.constructor === Array && signatures.length > 0 ) {
        for (var i = 0; i < signatures.length; i++) {
            if (signatures[i].canvas.width === 0) {

                var $sig_canvas = jQuery(".wpcf7-form-control-signature-body>canvas");
                var $sig_wrap = jQuery(".wpcf7-form-control-signature-wrap");
                $sig_canvas.eq(i).attr('width',  $sig_wrap.width());
                $sig_canvas.eq(i).attr('height', $sig_wrap.height());

                cf7signature_resized = 1;
            }
        }
    }

    form.$groups.addClass('wpcf7cf-hidden');

    for (var i=0; i < wpcf7cf_conditions.length; i++) {

        var condition = wpcf7cf_conditions[i];

        var show_group = wpcf7cf.should_group_be_shown(condition, form.$form);

        if (show_group) {
            jQuery('[data-id='+condition.then_field+']',form.$form).eq(0).removeClass('wpcf7cf-hidden');
        }
    }

    var animation_intime = wpcf7cf_settings.animation_intime;
    var animation_outtime = wpcf7cf_settings.animation_outtime;

    form.$groups.each(function (index) {
        $group = jQuery(this);
        if ($group.is(':animated')) $group.finish(); // stop any current animations on the group
        if ($group.css('display') === 'none' && !$group.hasClass('wpcf7cf-hidden')) {
            if ($group.prop('tagName') === 'SPAN') {
                $group.show().trigger('wpcf7cf_show_group');
            } else {
                $group.animate(wpcf7cf_show_animation, animation_intime).trigger('wpcf7cf_show_group'); // show
            }
        } else if ($group.css('display') !== 'none' && $group.hasClass('wpcf7cf-hidden')) {

            if ($group.attr('data-clear_on_hide') !== undefined) {
                $inputs = jQuery(':input', $group).not(':button, :submit, :reset, :hidden');
                // $inputs.prop('checked', false).prop('selected', false).prop('selectedIndex', 0);
                // $inputs.not('[type=checkbox],[type=radio],select').val('');

                $inputs.each(function(){
                    $this = jQuery(this);
                    $this.val(this.defaultValue);
                    $this.prop('checked', this.defaultChecked);
                });

                $inputs.change();
                //display_fields();
            }

            if ($group.prop('tagName') === 'SPAN') {
                $group.hide().trigger('wpcf7cf_hide_group');
            } else {
                $group.animate(wpcf7cf_hide_animation, animation_outtime).trigger('wpcf7cf_hide_group'); // hide
            }

        }
    });

    form.updateHiddenFields();
};
Wpcf7cfForm.prototype.updateHiddenFields = function() {

    var form = this;

    var hidden_fields = [];
    var hidden_groups = [];
    var visible_groups = [];

    form.$groups.each(function () {
        var $this = jQuery(this);
        if ($this.hasClass('wpcf7cf-hidden')) {
            hidden_groups.push($this.data('id'));
            $this.find('input,select,textarea').each(function () {
                hidden_fields.push(jQuery(this).attr('name'));
            });
        } else {
            visible_groups.push($this.data('id'));
        }
    });

    form.hidden_fields = hidden_fields;
    form.hidden_groups = hidden_groups;
    form.visible_groups = visible_groups;

    form.$hidden_group_fields.val(JSON.stringify(hidden_fields));
    form.$hidden_groups.val(JSON.stringify(hidden_groups));
    form.$visible_groups.val(JSON.stringify(visible_groups));

    return true;
};
Wpcf7cfForm.prototype.updateGroups = function() {
    var form = this;
    form.$groups = form.$form.find('[data-class="wpcf7cf_group"]');

    form.conditions = wpcf7cf.get_nested_conditions(form.initial_conditions, form.$form);

};
Wpcf7cfForm.prototype.updateEventListeners = function() {

    var form = this;

    // monitor input changes, and call display_fields() if something has changed
    jQuery('input, select, textarea, button',form.$form).not('.wpcf7cf_add, .wpcf7cf_remove').off(wpcf7cf_change_events).on(wpcf7cf_change_events,form, function(e) {
        var form = e.data;
        clearTimeout(wpcf7cf_timeout);
        wpcf7cf_timeout = setTimeout(function() {
            form.displayFields();
        }, 100);
    });

    //removed pro functions
};

//removed pro functions

wpcf7cf = {

    // keep this for backwards compatibility
    initForm : function($form) {
        wpcf7cf_forms.push(new Wpcf7cfForm($form));
    },

    get_nested_conditions : function(conditions, $current_form) {
        //loop trough conditions. Then loop trough the dom, and each repeater we pass we should update all sub_values we encounter with __index
        var simplified_dom = wpcf7cf.get_simplified_dom_model($current_form);
        var groups = simplified_dom.filter(function(item, i) {
            return item.type==='group';
        });

        var sub_conditions = [];

        for(var i = 0;  i < groups.length; i++) {
            var g = groups[i];
            var relevant_conditions = conditions.filter(function(condition, i) {
                return condition.then_field === g.original_name;
            });
            
            var relevant_conditions = relevant_conditions.map(function(item,i) {
                return {
                    then_field : g.name,
                    and_rules : item.and_rules.map(function(and_rule, i) {
                        return {
                            if_field : and_rule.if_field+g.suffix,
                            if_value : and_rule.if_value,
                            operator : and_rule.operator
                        };
                    })
                }
            });

            sub_conditions = sub_conditions.concat(relevant_conditions);
        }
        return conditions.concat(sub_conditions);
    },

    get_simplified_dom_model : function($current_form) {
        // if the dom is something like:
        // <form>
        //   <repeater ra>
        //     <group ga__1>
        //         <repeater rb__1>
        //             <input txta__1__1 />
        //             <input txta__1__2 />
        //         </repeater>
        //         <group gb__1>
        //             <input txtb__1 />
        //         </group>
        //     </group>
        //     <group ga__2>
        //         <repeater rb__2>
        //             <input txta__2__1 />
        //         </repeater>
        //         <group gb__2>
        //             <input txtb__2 />
        //         </group>
        //     </group>
        //   </repeater>
        // </form>
        // 
        // return something like:
        // [{type:repeater, name:'ra', suffix: '__1'}, {type: group, name:'ga', suffix: '__1'}, ...]

        var currentNode,
        ni = document.createNodeIterator($current_form[0], NodeFilter.SHOW_ELEMENT);

        var simplified_dom = [];

        while(currentNode = ni.nextNode()) {
            if (currentNode.classList.contains('wpcf7cf_repeater')) {
                simplified_dom.push({type:'repeater', name:currentNode.dataset.id, original_name:currentNode.dataset.orig_data_id})
            } else if (currentNode.dataset.class == 'wpcf7cf_group') {
                simplified_dom.push({type:'group', name:currentNode.dataset.id, original_name:currentNode.dataset.orig_data_id})
            } else if (currentNode.hasAttribute('name')) {
                simplified_dom.push({type:'input', name:currentNode.getAttribute('name'), original_name:currentNode.getAttribute('data-orig_name')})
            }
        }

        simplified_dom = simplified_dom.map(function(item, i){
            var original_name_length = item.original_name == null ? item.name.length : item.original_name.length;
            item.suffix = item.name.substring(original_name_length);
            return item;
        });

        // console.table(simplified_dom);
        return simplified_dom;

    },

    should_group_be_shown : function(condition, $current_form) {

        var $ = jQuery;

        var show_group = true;

        for (var and_rule_i = 0; and_rule_i < condition.and_rules.length; and_rule_i++) {

            var condition_ok = false;

            var condition_and_rule = condition.and_rules[and_rule_i];

            var $field = jQuery('[name="' + condition_and_rule.if_field + '"], [name="' + condition_and_rule.if_field + '[]"], [data-original-name="' + condition_and_rule.if_field + '"], [data-original-name="' + condition_and_rule.if_field + '[]"]',$current_form);

            var if_val = condition_and_rule.if_value;
            var if_val_as_number = isFinite(parsedval=parseFloat(if_val)) ? parsedval:0;
            var operator = condition_and_rule.operator;
            var regex_patt = new RegExp(if_val, 'i');


            if ($field.length === 1) {

                // single field (tested with text field, single checkbox, select with single value (dropdown), select with multiple values)

                if ($field.is('select')) {

                    if (operator === 'not equals') {
                        condition_ok = true;
                    }

                    $field.find('option:selected').each(function () {
                        var $option = jQuery(this);
                        option_val = $option.val()
                        if (
                            operator === 'equals' && option_val === if_val ||
                            operator === 'equals (regex)' && regex_patt.test($option.val())
                        ) {
                            condition_ok = true;
                        } else if (
                            operator === 'not equals' && option_val === if_val ||
                            operator === 'not equals (regex)' && !regex_patt.test($option.val())
                        ) {
                            condition_ok = false;
                            return false; // break out of the loop
                        }
                    });

                    show_group = show_group && condition_ok;
                }

                var field_val = $field.val();
                var field_val_as_number = isFinite(parsedval=parseFloat(field_val)) ? parsedval:0;

                if ($field.attr('type') === 'checkbox') {
                    var field_is_checked = $field.is(':checked');
                    if (
                        operator === 'equals'             && field_is_checked && field_val === if_val ||
                        operator === 'not equals'         && !field_is_checked ||
                        operator === 'is empty'           && !field_is_checked ||
                        operator === 'not empty'          && field_is_checked ||
                        operator === '>'                  && field_is_checked && field_val_as_number > if_val_as_number ||
                        operator === '<'                  && field_is_checked && field_val_as_number < if_val_as_number ||
                        operator === '≥'                  && field_is_checked && field_val_as_number >= if_val_as_number ||
                        operator === '≤'                  && field_is_checked && field_val_as_number <= if_val_as_number ||
                        operator === 'equals (regex)'     && field_is_checked && regex_patt.test(field_val) ||
                        operator === 'not equals (regex)' && !field_is_checked

                    ) {
                        condition_ok = true;
                    }
                } else if (
                    operator === 'equals'             && field_val === if_val ||
                    operator === 'not equals'         && field_val !== if_val ||
                    operator === 'equals (regex)'     && regex_patt.test(field_val) ||
                    operator === 'not equals (regex)' && !regex_patt.test(field_val) ||
                    operator === '>'                  && field_val_as_number > if_val_as_number ||
                    operator === '<'                  && field_val_as_number < if_val_as_number ||
                    operator === '≥'                  && field_val_as_number >= if_val_as_number ||
                    operator === '≤'                  && field_val_as_number <= if_val_as_number ||
                    operator === 'is empty'           && field_val === '' ||
                    operator === 'not empty'          && field_val !== '' ||
                    (
                        operator === 'function'
                        && typeof window[if_val] == 'function'
                        && window[if_val]($field)
                    )
                ) {
                    condition_ok = true;
                }


            } else if ($field.length > 1) {

                // multiple fields (tested with checkboxes, exclusive checkboxes, dropdown with multiple values)

                var all_values = [];
                var checked_values = [];
                $field.each(function () {
                    all_values.push(jQuery(this).val());
                    if (jQuery(this).is(':checked')) {
                        checked_values.push(jQuery(this).val());
                    }
                });

                var checked_value_index = jQuery.inArray(if_val, checked_values);
                var value_index = jQuery.inArray(if_val, all_values);

                if (
                    ( operator === 'is empty' && checked_values.length === 0 ) ||
                    ( operator === 'not empty' && checked_values.length > 0  )
                ) {
                    condition_ok = true;
                }


                for (var ind = 0; ind < checked_values.length; ind++) {
                    var checked_val = checked_values[ind];
                    var checked_val_as_number = isFinite(parsedval=parseFloat(checked_val)) ? parsedval:0;
                    if (
                        ( operator === 'equals'             && checked_val === if_val ) ||
                        ( operator === 'not equals'         && checked_val !== if_val ) ||
                        ( operator === 'equals (regex)'     && regex_patt.test(checked_val) ) ||
                        ( operator === 'not equals (regex)' && !regex_patt.test(checked_val) ) ||
                        ( operator === '>'                  && checked_val_as_number > if_val_as_number ) ||
                        ( operator === '<'                  && checked_val_as_number < if_val_as_number ) ||
                        ( operator === '≥'                  && checked_val_as_number >= if_val_as_number ) ||
                        ( operator === '≤'                  && checked_val_as_number <= if_val_as_number )
                    ) {
                        condition_ok = true;
                    }
                }
            }

            show_group = show_group && condition_ok;
        }

        return show_group;

    }

};


jQuery('.wpcf7-form').each(function(){
    wpcf7cf_forms.push(new Wpcf7cfForm(jQuery(this)));
});

// Call displayFields again on all forms
// Necessary in case some theme or plugin changed a form value by the time the entire page is fully loaded.
jQuery('document').ready(function() {
    wpcf7cf_forms.forEach(function(f){
        f.displayFields();
    });
});

// fix for exclusive checkboxes in IE (this will call the change-event again after all other checkboxes are unchecked, triggering the display_fields() function)
var old_wpcf7ExclusiveCheckbox = jQuery.fn.wpcf7ExclusiveCheckbox;
jQuery.fn.wpcf7ExclusiveCheckbox = function() {
    return this.find('input:checkbox').click(function() {
        var name = jQuery(this).attr('name');
        jQuery(this).closest('form').find('input:checkbox[name="' + name + '"]').not(this).prop('checked', false).eq(0).change();
    });
};

