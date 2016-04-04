<?php

/**
 * Description of customizer
 *
 * customizer.php include theme settings that located in "Customize" menu.
 * 
 * @author Alexander Gradov
 */
/* Site identity */

/** Add figure image uploader to customize menu */
add_action('customize_register', 'figure_customize_register');

function figure_customize_register($wp_customize) {
    // Add setting for figure image uploader
    $wp_customize->add_setting('figure_image');
    // Add control for figure image uploader (actual uploader)
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'figure_image', array(
        'label' => __('Upload figure image', 'figure image'),
        'section' => 'title_tagline',
        'settings' => 'figure_image',
        'priority' => 60,
    )));
}

/** Add secondary logo uploader to customize menu(main logo uploader located in 
  Admin panel -> Appearance -> Theme Options -> Logo ) */
add_action('customize_register', 'secondary_logo_customize_register');

function secondary_logo_customize_register($wp_customize) {
    // Add setting for logo uploader
    $wp_customize->add_setting('secondary_logo');
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_logo', array(
        'label' => __('Upload secondary logo', 'secondary logo'),
        'section' => 'title_tagline',
        'settings' => 'secondary_logo',
        'priority' => 70,
    )));
}

/* Colors */

/** Add links color picker to customize menu */
add_action('customize_register', 'links_color_customize_register');

function links_color_customize_register($wp_customize) {
    // Add setting for links color
    $wp_customize->add_setting('link_color');
    // Add control for links color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label' => __('Link Color', 'link_color'),
        'section' => 'colors',
        'settings' => 'link_color',
    )));
}

/** Add hover and focus links color picker to customize menu */
add_action('customize_register', 'links_hover_focus_color_customize_register');

function links_hover_focus_color_customize_register($wp_customize) {
    // Add setting for hover and focus links color
    $wp_customize->add_setting('hover_focus_link_color');
    // Add control for hover and focus links color picker 
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hover_focus_link_color', array(
        'label' => __('Hover And Focus Link Color', 'hover_focus_link_color'),
        'section' => 'colors',
        'settings' => 'hover_focus_link_color',
    )));
}
