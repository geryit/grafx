<?php

function scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_dequeue_script( 'jquery' );
        wp_deregister_script( 'wp-embed' );
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        wp_register_script('main', get_template_directory_uri() . '/dist/js/grafx.min.js', array(), null); // Conditional script(s)
        wp_enqueue_script('main'); // Enqueue it!
    }
}

function styles()
{

    wp_register_style('main', get_template_directory_uri() . '/dist/css/grafx.css', array(), null, 'all');
    wp_enqueue_style('main'); // Enqueue it!
}

add_action('init', 'scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'styles'); // Add Theme Stylesheet

add_action('admin_init', 'remove_textarea');

function remove_textarea() {
    remove_post_type_support( 'page', 'editor' );
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}


add_action('acf/input/admin_head', 'my_acf_input_admin_head');
function my_acf_input_admin_head() {
    ?>
    <script type="text/javascript">
        jQuery(function(){
            jQuery('.layout').addClass('-collapsed');
        });
    </script>
    <?php
}

function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}
