<?php

/**
 * Description of customizer
 *
 * customizer.php include theme settings that located in "Customize" menu.
 * 
 * @author Alexander Gradov
 */
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
        'priority' => 60,
    )));
}
