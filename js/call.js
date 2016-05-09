jQuery(window).load(function () {
    if (typeof enlightenment_slider_args != 'undefined') {
        var selector = enlightenment_slider_args.selector;
        delete enlightenment_slider_args['selector'];
        jQuery(selector).flexslider(enlightenment_slider_args);
    }
    if (typeof enlightenment_carousel_args != 'undefined') {
        var selector = enlightenment_carousel_args.selector;
        delete enlightenment_carousel_args['selector'];
        jQuery(selector).flexslider(enlightenment_carousel_args);
    }
});

jQuery(document).ready(function ($) {
    if (typeof enlightenment_masonry_args != 'undefined') {
        var $container = $(enlightenment_masonry_args.container);
        $container.imagesLoaded(function () {
            $container.masonry(enlightenment_masonry_args);
        });
    }
    if (typeof enlightenment_fluidbox_args != 'undefined') {
        $(enlightenment_fluidbox_args.selector).fluidbox();
    } else if (typeof enlightenment_colorbox_args != 'undefined') {
        $(enlightenment_colorbox_args.selector).colorbox(enlightenment_colorbox_args);
    } else if (typeof enlightenment_imagelightbox_args != 'undefined') {
        $(enlightenment_imagelightbox_args.selector).imageLightbox();
    }
    if ($.fn.fitVids)
        $('.entry-attachment, .entry-content').fitVids({
            customSelector: "embed[src*='wordpress.com'], embed[src*='wordpress.tv'], iframe[src*='wordpress.com'], iframe[src*='wordpress.tv'], iframe[src*='www.dailymotion.com'], iframe[src*='blip.tv'], iframe[src*='www.viddler.com']",
        });
    if (typeof enlightenment_ajax_navigation_args != 'undefined') {
        var selector = enlightenment_ajax_navigation_args.selector;
        delete enlightenment_ajax_navigation_args['selector'];
        enlightenment_ajax_navigation_args['complete'] = function (items) {
            if (typeof enlightenment_masonry_args != 'undefined') {
                var $container = $(enlightenment_masonry_args.container);
                $container.imagesLoaded(function () {
                    $container.masonry('appended', items);
                });
            }
            if (typeof $.fn.fitVids != 'undefined')
                $('.entry-attachment, .entry-content').fitVids({
                    customSelector: "embed[src*='wordpress.com'], embed[src*='wordpress.tv'], iframe[src*='wordpress.com'], iframe[src*='wordpress.tv'], iframe[src*='www.dailymotion.com'], iframe[src*='blip.tv'], iframe[src*='www.viddler.com']",
                });
            $('.wp-audio-shortcode, .wp-video-shortcode').css('visibility', 'visible');
        }
        $(selector).ajaxload(enlightenment_ajax_navigation_args);
    }
    if (typeof enlightenment_infinite_scroll_args != 'undefined') {
        $(enlightenment_infinite_scroll_args.contentSelector).infinitescroll(enlightenment_infinite_scroll_args, function (items) {
            if (typeof enlightenment_masonry_args != 'undefined') {
                var $container = $(enlightenment_masonry_args.container);
                $container.imagesLoaded(function () {
                    $container.masonry('appended', items);
                });
            }
            if (typeof $.fn.fitVids != 'undefined')
                $('.entry-attachment, .entry-content').fitVids({
                    customSelector: "embed[src*='wordpress.com'], embed[src*='wordpress.tv'], iframe[src*='wordpress.com'], iframe[src*='wordpress.tv'], iframe[src*='www.dailymotion.com'], iframe[src*='blip.tv'], iframe[src*='www.viddler.com']",
                });
            $('.wp-audio-shortcode, .wp-video-shortcode').css('visibility', 'visible');
        });
        $(enlightenment_infinite_scroll_args.navSelector).hide();
    }
});