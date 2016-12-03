<?php

function scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_dequeue_script('jquery');
        wp_deregister_script('wp-embed');
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

function remove_textarea()
{
    remove_post_type_support('page', 'editor');
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}


function register_my_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');


function my_acf_admin_head()
{
    ?>
    <script type="text/javascript">
        (function ($) {

            $(document).ready(function () {

//                $('.layout').addClass('-collapsed');
//                $('.acf-postbox').addClass('closed');

            });

        })(jQuery);
    </script>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');


/*Hide "Posts" from sidebar*/
function post_remove()
{
    remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');


//function set_custom_post_types_admin_order($wp_query)
//{
//    if (is_admin()) {
//
//        // Get the post type from the query
//        $post_type = $wp_query->query['post_type'];
//
//        if ($post_type == 'work') {
//            if (empty($_GET['orderby'])) {
//                echo "<meta http-equiv='refresh' content='0;url=" . $_SERVER['REQUEST_URI'] . "&orderby=date&order=desc'>";
//            }
//        }
//    }
//}

//add_filter('pre_get_posts', 'set_custom_post_types_admin_order');

function printr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function boldify($str)
{
    $str = preg_replace("/&#8211;(.*)/", "<b>$1</b>", $str);
    return preg_replace("/–(.*)/", "<b>$1</b>", $str);
}


function getTax()
{
    return 'work-category';
}

/* Convert hexdec color string to rgb(a) string */

function hex2rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}


//function acf_load_color_field_choices( $field ) {
//
//    // reset choices
//    $field['choices'] = array();
//
//
//    // if has rows
//    if( have_rows('button', 'option') ) {
//
//        // while has rows
//        while( have_rows('button', 'option') ) {
//
//            // instantiate row
//            the_row();
//
//
//            // vars
//            $value = get_sub_field('value');
//            $label = get_sub_field('label');
//
//
//            // append to choices
//            $field['choices'][ $value ] = $label;
//
//        }
//
//    }
//
//
//    // return the field
//    return $field;
//
//}
//
//add_filter('acf/load_field/name=work_button', 'acf_load_color_field_choices');
$buttons = array();
$loop = new WP_Query(array('post_type' => 'button', 'posts_per_page' => -1));
while ($loop->have_posts()) {
    $loop->the_post();
    $buttons[get_the_title()] = get_the_content();
}
function get_button($v)
{
    global $buttons;
    return $buttons[$v];
}

//wp_localize_script( 'wp-api', 'wpApiSettings', array( 'root' => esc_url_raw( rest_url() ), 'nonce' => wp_create_nonce( 'wp_rest' ) ) );

//
//add_filter('asp_pagepost_results', 'asp_add_category_titles', 1, 1);
//
//function asp_add_category_titles($pageposts)
//{
//    foreach ($pageposts as $k => $v) {
//
//        // Get the post categories
//        $post_categories = wp_get_post_categories($pageposts[$k]->id);
//        $cats = "";
//
//        // Concatenate category names to the $cats variable
//        foreach ($post_categories as $c) {
//            $cat = get_category($c);
//            $cats = " " . $cat->name;
//        }
//
//        // Modify the post title
//        $pageposts[$k]->title .= " " . $cats;
//    }
//
//    return $pageposts;
//}
//
///**
// * Numbering the results
// *
// * @link: https://wp-dreams.com/knowledge-base/numbering-the-results/
// */
//add_filter('asp_results', 'asp_number_results', 1, 1);
//
//function asp_number_results($results)
//{
//
//    $num = 1;
//    foreach ($results as $k => $v) {
//        // Modify the post title
//        $results[$k]->title = $num . ". " . $results[$k]->title;
//        $num++;
//    }
//
//    return $results;
//}




