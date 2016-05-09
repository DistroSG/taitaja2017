<?php

/**
 * Description of functions
 *
 * functions.php include child theme's all additional functionality.
 * 
 * @author Alexander Gradov
 */
/*
 * Remove unnecessary styles.
 * 
 * Last argument(99999) is priority.
 * 
 * "Used to specify the order in which the functions associated with a
 * particular action are executed. 
 * 
 * Lower numbers correspond with earlier execution, and functions with the same 
 * priority are executed in the order in which they were added to the action."
 * (https://developer.wordpress.org/reference/functions/add_action/)
 * 
 * It's in use because of make sure that removing happen after adding these
 * styles.
 */
add_action('wp_enqueue_scripts', 'theme_denqueue_styles', 99999);

function theme_denqueue_styles() {
    /*
     * Remove parent bootstrap file(Because of breakpoint's changing.)
     * 
     * enlightenment_styles_directory_uri() return enlightenment theme's css 
     * directory URI (Parent theme´s style.css locate in main folder and 
     * get_template_directory_uri() should be used to access to it).
     */
    wp_deregister_style('bootstrap-min', enlightenment_styles_directory_uri()
            . '/bootstrap.min.css');
    wp_dequeue_script('enlightenment-call-js');
}

//Adding necessary styles
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles() {

// Assign 'parent-style' to the variable for usability.
    $parent_style = 'parent-style';
    $bootstrap = 'bootstrap-min-child';
    /*
     * Consistency is important!!!
     * 
     * First should go vendor's files(like bootstrap and other frameworks),
     * after that parents and only then owns. 
     * 
     * It all for right work of overriding.
     * 
     */
// Bootstrap with new breakpoint.
    wp_enqueue_style($bootstrap, get_stylesheet_directory_uri()
            . '/lib/css/bootstrap.min.css');
    /*
     * Parent style.css with using get_template_directory_uri() to get parent 
     * theme's main directory URI.
     * 
     * Third argument is array of registered style handles this stylesheet
     * depends on.
     * Dependent stylesheets will be loaded before this stylesheet.
     * 
     */
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css'
            , array($bootstrap));
    /*
     * Сhild style.css with using get_stylesheet_directory_uri() to get child 
     * theme's main directory URI.
     * 
     * It is dependent(go after) parent-style. 
     */
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css'
            , array($parent_style));
}

//Adding necessary scripts
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function theme_enqueue_scripts() {
//add call script 
    wp_enqueue_script('call', get_stylesheet_directory_uri() . '/js/call.js', array('jquery'), NULL, true);
}

//Removing unnecessary options from customizer
add_action('customize_register', 'remove_unnecessary_options_from_customizer');

//Removing background, header image and static front page options from customizer
function remove_unnecessary_options_from_customizer($wp_customize) {
    remove_custom_background();
    remove_custom_image_header();
    $wp_customize->remove_section('static_front_page');
}

/*
 * Add to nav menu new item which include search box.
 * 
 * add_filter is same like add_action except it use for update something and
 * add_action to create something new.
 * 
 * Last argument define number of arguments the function(s) accept(s).
 * 
 * Because function add_search_box_to_menu() has two arguments($items and $args).   
 * 
 */

/*
 * Add to nav menu the last item - secondary logo.
 */

//add_filter('enlightenment_site_branding', 'add_secondary_logo_to_menu', 20);
//function add_secondary_logo_to_menu($items) {
//    
//        $items .= '<img id="secondary-logo" '
//                . ' src="' . get_theme_mod('secondary_logo') . '"'
//                . ' alt="Finland 100">';
//
//       
//    
//    return $items;
//}

/*
 * Add social buttons to footer. 
 * Priority is 11 bacause of if the number is lower, than it has not enough time
 * to appear on the page and if number is too high, then element doesn't go to 
 * the container, but after it.
 */
add_action('enlightenment_footer', 'footer_content', 11);

function footer_content() {
    $output.= '<div class=row>';
    $output.= '<div class="col-md-3">' . footer_logo() . '</div>';
    $output.= '<div class="col-md-3">' . contact_information1() . '</div>';
    $output.= '<div class="col-md-3">' . contact_information2() . '</div>';
    $output.= '<div class="col-md-3">' . social_buttons() . '</div>';
    $output.= '</div>';
    echo $output;
}

function footer_logo() {
    $output = '<img id="footer-logo" src="' . get_stylesheet_directory_uri()
            . '/img/taitajaLogoWhite.png" alt="Footer logo"/>';
    return $output;
}

function contact_information1() {

    $output.= '<p class="contact-information">';
    $output.= 'Taitaja2017-kilpailutoimisto postiosoite:';
    $output.= '</p>';
    $output.= '<br>';
    $output.=' <address class="contact-information"> ';
    $output.= 'PL 3926, 00099 Helsingin kaupunki</address>';
    $output.= '</address>';

    return $output;
}

function contact_information2() {

    $output.= '<p class="contact-information">';
    $output.= 'Taitaja-kilpailutoimisto käyntiosoite:';
    $output.= '</p>';
    $output.= '<br>';
    $output.= '<address class="contact-information">';
    $output.= 'Hattulantie 2, 00550 Helsinki</address>';

    return $output;
}

function social_buttons() {
    global $wpdb;
    $sql = "SELECT nimi,path,link FROM wp_social_buttons";
    $socialButtons = $wpdb->get_results($sql);

    if ($socialButtons) { // check if there are any results
        $output.=' <ul class="social-buttons">';
        foreach ($socialButtons as $socialButton) {
            $output.=' <li><a href="' . $socialButton->link . '/"><img alt="'
                    . $socialButton->nimi . '" src="'
                    . get_stylesheet_directory_uri() . $socialButton->path
                    . '"></a></li>';
        }
        $output.=' </ul>';
        return $output;
    }
}

/*
 * Function that include code of upbar
 */

function upbar() {
//Catch the code from the_widget('MslsWidget'), that it dosen´t appear on
// the page immediately. 
    ob_start();
    the_widget('MslsWidget');
    $widget = ob_get_contents();
    ob_end_clean();

    $output.= '<div id="upbar">';
    $output.= '<div class="container">';
    $output.= '<div class="dropdown searchform-dropdown pull-right">';
    $output.= ' <a id="toggle-search-form" data-toggle="dropdown" 
                            href="#" aria-expanded="false"><span class="glyphicon 
                            glyphicon-search"></span></a>';
    $output.= ' <ul class="dropdown-menu" role="menu"
                            aria-labelledby="toggle-search-form">';
    $output.= '<li>';
    $output.= get_search_form(false);
    $output.= '</li>';
    $output.= ' </ul>';

    $output.= '</div>';
    $output.=$widget;
    $output.= '</div>';


    $output.= ' </div>';

    echo $output;
}

/*
 * Register our sidebars and widgetized areas.
 */
add_action('widgets_init', 'new_widgets_init');

function new_widgets_init() {

    register_sidebar(array(
        'name' => 'Shortcuts sidebar',
        'id' => 'shortcuts',
        'before_widget' => '',
        'after_widget' => '',
    ));
}

/*
 * Function that include code of shortcuts
 */

function shortcuts() {
    ob_start();
    dynamic_sidebar('shortcuts');
    $sidebar = ob_get_contents();
    ob_end_clean();

    echo '<div id = "shortcuts" class="hidden-xs">' . $sidebar . '</div>';
}

function big_logo() {
    $output .= '<div id = "big-logo">';
    $output .= '<img class = "img-responsive" '
            . 'alt = "Taitaja ammSM" '
            . 'src = "' . get_stylesheet_directory_uri() . '/img/Taitaja_ammSM_logo.jpg">';
    $output .='</div>';
    echo $output;
}

function recent_2_posts() {

    $output .= '<div id="recent-2-posts">';
    $output .= '<div class="container">';
    $output .= '<h2>AJANKOHTAISTA</h2>';
    $output .= '<div class="row">';

    $args = array('numberposts' => '2');
    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $recent) {
        $output .= '<div class="col-md-6">';
        $output .= '<div class="content">';
        $output .= '<a href="' . get_permalink($recent["ID"]) . '">';
        if (has_post_thumbnail($recent["ID"])) {
            $feat_image_url = wp_get_attachment_url(get_post_thumbnail_id($recent["ID"], 'medium'));
            $output .= '<img src="' . $feat_image_url . '" alt="' . $recent["post_title"] . ' image"/>';
        } else {

            $output .= '<img src="' . get_bloginfo('stylesheet_directory')
                    . '/img/thumbnail-default.png" />';
        }
        $output .= '<h3>' . $recent["post_title"] . '</h3>';
        $output .= '</a>';
        $output .= '<p class="post-time">' . get_the_time('d.m.Y', $recent["ID"]) . '</p>';
        $output .= '<div class="description hidden-xs">';
        $output .= '<p>' . get_the_excerpt($recent["ID"]) . '</p>';
        $output .= '<a href="' . get_permalink($recent["ID"]) . '">'
                . 'LUE LISÄÄ'
                . '</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    echo $output;
}
