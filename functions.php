<?php
/**
 * Description of functions
 *
 * functions.php include child theme's all additional functionality.
 * 
 * @author Alexander Gradov
 */
//Add customizer.php functionality to the child theme
require get_stylesheet_directory() . '/inc/customizer.php';

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
add_action('wp_enqueue_scripts', 'theme_deenqueue_styles', 99999);

function theme_deenqueue_styles() {
    /*
     * Remove parent bootstrap file(Because of breakpoint's changing.)
     * 
     * enlightenment_styles_directory_uri() return enlightenment theme's css 
     * directory URI (Parent theme´s style.css locate in main folder and 
     * get_template_directory_uri() should be used to access to it).
     */
    wp_deregister_style('bootstrap-min', enlightenment_styles_directory_uri()
            . '/bootstrap.min.css');
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

//Removing unnecessary options from customizer
add_action('customize_register', 'remove_unnecessary_options_from_customizer');

//Removing background, header image and static front page options from customizer
function remove_unnecessary_options_from_customizer($wp_customize) {
    remove_custom_background();
    remove_custom_image_header();
    $wp_customize->remove_section('static_front_page');
}

//Adding to head new styles for custom figure image
add_action('wp_head', 'figure_image_customize_css');

//Adding a style that get figure image from figure image uploader.
function figure_image_customize_css() {
    ?>
    <style type="text/css" id="custom-figure-image">
        .navbar-brand:after{background-image: url(' <?php echo get_theme_mod('figure_image'); ?>'); }
    </style>
    <?php
}

//Adding to head new styles for custom colors
add_action('wp_head', 'colors_customize_css');

//Adding a style that get colors from colors picker.
function colors_customize_css() {
    ?>
    <style type="text/css" id="custom-colors">
        a {  color: <?php echo get_theme_mod('link_color'); ?>;}
        a:hover, a:focus {color: <?php echo get_theme_mod('hover_focus_link_color'); ?>;}
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: <?php echo get_theme_mod('input_field_border_focus_color'); ?>;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px <?php echo get_theme_mod('input_field_border_shadow_color'); ?>;
        }
        .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > 
        .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
            color: <?php echo get_theme_mod('navbar_active_link_color'); ?>;
        }
        .navbar .nav > li > a:hover, .navbar .nav li.dropdown.open > .dropdown-toggle, 
        .navbar .nav li.dropdown.open > .dropdown-toggle .menu-item-description, 
        .navbar .nav li.dropdown:target > .dropdown-toggle {
            color: <?php echo get_theme_mod('navbar_hover_and_focus_link_color'); ?>;
        }
        #toggle-search-form{
            color: <?php echo get_theme_mod('search_icon_color'); ?>; 
        }
        #toggle-search-form:hover, #toggle-search-form:focus {
            color: <?php echo get_theme_mod('search_icon_hover_and_focus_color'); ?>;
        }
    </style>
    <?php
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
add_filter('wp_nav_menu_items', 'add_search_box_to_menu', 10, 2);

/*
 * $items is string argument, that we will return with necessary HTML code
 * $args is array argument, that we need to choose in which menu we want to add 
 * our items.
 */

function add_search_box_to_menu($items, $args) {
    if ($args->theme_location == 'primary') {
        //get_search_form(false) return serch form, if it without argument, 
        //than it write search form straight on the page; 
        $searchform = get_search_form(false);

        $items .= '<li  id="menu-item-search">' . $searchform . '</li>';

        return $items;
    }
    return $items;
}

/*
 * Add to nav menu the last item - secondary logo.
 */
add_filter('wp_nav_menu_items', 'add_secondary_logo_to_menu', 99999, 2);

function add_secondary_logo_to_menu($items, $args) {
    if ($args->theme_location == 'primary') {

        $items .= '<img id="secondary-logo" '
                . ' src="' . get_theme_mod('secondary_logo') . '"'
                . ' alt="Finland 100">';

        return $items;
    }
    return $items;
}
