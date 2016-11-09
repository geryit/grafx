<?php

function scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_dequeue_script( 'jquery' );
        wp_deregister_script( 'wp-embed' );
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        wp_register_script('main', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('main'); // Enqueue it!
    }
}

function styles()
{

    wp_register_style('main', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0', 'all');
    wp_enqueue_style('main'); // Enqueue it!
}

add_action('init', 'scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'styles'); // Add Theme Stylesheet
