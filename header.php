<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php enlightenment_head(); ?>
        <?php if (!function_exists('_wp_render_title_tag')) : ?>
            <title><?php wp_title('&raquo;', true, 'right'); ?></title>
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class() ?> <?php enlightenment_body_extra_atts(); ?>>
        <?php enlightenment_before_page(); ?>
        <div id="page" class="site">
            <?php enlightenment_before_header(); ?>

            <header id="masthead" <?php enlightenment_header_class(); ?> <?php enlightenment_header_extra_atts(); ?>>
                <?php upbar(); ?>
                <div class="container">
                    <?php enlightenment_header(); ?>

                </div>
                <?php dynamic_sidebar('shortcuts'); ?>
            </header>
            <?php enlightenment_after_header(); ?>
            <?php
            if (is_front_page()) {
                big_logo();
            }
            ?>
            <?php get_sidebar('full-screen'); ?>
            <?php
            if (is_front_page()) {
                recent_2_posts();
            }
            ?>
            <?php get_sidebar('header'); ?>
            <?php get_sidebar('header-secondary'); ?>