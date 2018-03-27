<?php

/*
 * Force gravity forms to load jquery in the footer
 */
function init_scripts() {
    return true;
}
add_filter("gform_init_scripts_footer", "init_scripts");


/*
 * adds class name to gravity forms submit buttons
 */
function form_submit_button( $button, $form ) {
    return '<input type="submit" id="gform_submit_button_'.$form["id"].'" class="btn" value="'.$form["button"]["text"].'">';
}
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );


/*
 * adds Hide Labels option in gravity forms admin side
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/*
 * removes gravity forms stylesheet
 */
function remove_gravityforms_style() {
    wp_dequeue_style('gforms_css');
}
add_action('wp_print_styles', 'remove_gravityforms_style');


/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 100; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );

add_filter( 'gform_confirmation_anchor', '__return_true' );