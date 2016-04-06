<?php

//Add alpha.php functionality to customizer.php
require get_stylesheet_directory() . '/lib/alphaColorPicker.php';

/**
 * Description of customizer
 *
 * customizer.php include theme settings that located in "Customize" menu.
 * 
 * @author Alexander Gradov
 */
/* Site identity */

/** Add figure image uploader to customizer */
add_action('customize_register', 'figure_customize_register');

function figure_customize_register($wp_customize) {
    // Add setting for figure image uploader
    $wp_customize->add_setting('figure_image');
    // Add control for figure image uploader (actual uploader)
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'figure_image', array(
        'label' => __('Upload figure image'),
        'section' => 'title_tagline',
        'priority' => 60,
    )));
}

/** Add secondary logo uploader to customizer(main logo uploader located in 
  Admin panel -> Appearance -> Theme Options -> Logo ) */
add_action('customize_register', 'secondary_logo_customizer_register');

function secondary_logo_customizer_register($wp_customize) {
    // Add setting for logo uploader
    $wp_customize->add_setting('secondary_logo');
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_logo', array(
        'label' => __('Upload secondary logo'),
        'section' => 'title_tagline',
        'priority' => 70,
    )));
}

/* Colors */

/** Add links color picker to customizer */
add_action('customize_register', 'links_color_customizer_register');

function links_color_customizer_register($wp_customize) {
    // Add setting for links color
    $wp_customize->add_setting('link_color');
    // Add control for links color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label' => __('Link Color'),
        'section' => 'colors',
    )));
}

/** Add hover and focus links color picker to customizer */
add_action('customize_register', 'links_hover_focus_color_customizer_register');

function links_hover_focus_color_customizer_register($wp_customize) {
    // Add setting for hover and focus links color
    $wp_customize->add_setting('hover_focus_link_color');
    // Add control for hover and focus links color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hover_focus_link_color', array(
        'label' => __('Hover And Focus Link Color'),
        'section' => 'colors',
    )));
}

/** Add input field border focus color picker to customizer */
add_action('customize_register', 'input_field_border_focus_color_customizer_register');

function input_field_border_focus_color_customizer_register($wp_customize) {
    // Add setting for input field border focus color
    $wp_customize->add_setting('input_field_border_focus_color');
    // Add control for input field border focus color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'input_field_border_focus_color', array(
        'label' => __('Input Field Border Focus Color'),
        'section' => 'colors',
    )));
}

/** Add input field border shadow color picker to customizer */
add_action('customize_register', 'input_field_border_shadow_color_customizer_register');

function input_field_border_shadow_color_customizer_register($wp_customize) {
    // Add setting for input field shadow shadow color
    $wp_customize->add_setting('input_field_border_shadow_color');
    // Add control for input field shadow color picker 
    $wp_customize->add_control(new Pluto_Customize_Alpha_Color_Control($wp_customize, 'input_field_border_shadow_color', array(
        'label' => __('Input Field Shadow Focus Color'),
        'section' => 'colors',
        'palette' => true,
    )));
}

/** Add navbar active link color picker to customizer */
add_action('customize_register', 'navbar_active_link_color_customizer_register');

function navbar_active_link_color_customizer_register($wp_customize) {
    // Add setting for navbar active link color
    $wp_customize->add_setting('navbar_active_link_color');
    // Add control for hover and focus links color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_active_link_color', array(
        'label' => __('Navbar Active Link Color'),
        'section' => 'colors',
    )));
}

/** Add navbar hover and focus link color picker to customizer */
add_action('customize_register', 'navbar_hover_and_focus_link_color_customizer_register');

function navbar_hover_and_focus_link_color_customizer_register($wp_customize) {
    // Add setting for navbar hover and focus link color
    $wp_customize->add_setting('navbar_hover_and_focus_link_color');
    // Add control for hover and focus links color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_hover_and_focus_link_color', array(
        'label' => __('Navbar Hover And Focus Link Color'),
        'section' => 'colors',
    )));
}

/** Add search icon color picker to customizer */
add_action('customize_register', 'search_icon_color_customizer_register');

function search_icon_color_customizer_register($wp_customize) {
    // Add setting for search icon color
    $wp_customize->add_setting('search_icon_color');
    // Add control for search icon color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'search_icon_color', array(
        'label' => __('Search Icon Color'),
        'section' => 'colors',
    )));
}

/** Add search icon hover and focus color picker to customizer */
add_action('customize_register', 'search_icon_hover_and_focus_color_customizer_register');

function search_icon_hover_and_focus_color_customizer_register($wp_customize) {
    // Add setting for search icon hover and focus color
    $wp_customize->add_setting('search_icon_hover_and_focus_color');
    // Add control for search icon color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'search_icon_hover_and_focus_color', array(
        'label' => __('Search Icon Hover And Focus Color'),
        'section' => 'colors',
    )));
}
