<?php
const VER = 7; // version for cdn files (*.jpg?7)
const REELPAGEID = 941; // Reel page id
const HOMEID = 6; // Homepage id (to be used in VR template)

function scripts()
{
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

//        wp_dequeue_script('jquery');
    wp_deregister_script('wp-embed');

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/js/grafx.min.js?rel=1571279169433', array('jquery'), null, true); // Enqueue it!
    $translation_array = array('templateUrl' => get_stylesheet_directory_uri());
    wp_localize_script('main', 'theme_vars', $translation_array);


  }
}

function styles()
{

  wp_register_style('main', get_template_directory_uri() . '/dist/css/grafx.css?rel=1571279169432', array(), null, 'all');
  wp_enqueue_style('main'); // Enqueue it!
}

add_action('wp_footer', 'scripts'); // Add Custom Scripts to wp_head
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
  echo "<pre class='fltng'>";
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

function plog($v)
{
  file_put_contents('php://stderr', print_r($v, TRUE));
}


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


add_filter('asp_results', 'asp_number_results', 1, 1);

function asp_number_results($results)
{
  $aspp = $_POST['aspp'];//get keyword

  foreach ($results as $k => $v) {
    $results[$k]->link = $results[$k]->link . "?se=" . $aspp; // add keyword to the end of urls

    // Modify the post title
    $work_terms = wp_get_post_terms($results[$k]->id, 'work-category');

    $terms = "<span class='r_terms'>";

    foreach ($work_terms as $t) {
      $terms .= "<span class='r_term r_term--" . $t->slug . "'></span>";
    }
    $terms .= "</span>";
    $results[$k]->title = "<span class='r_title'>" . boldify($results[$k]->title) .
      "</span>" . $terms;
  }

  return $results;
}



//add "se" as so "get_query_var('se', '')" will work.
// You can get "se" var from url (?se=hea)
function add_query_vars_filter($vars)
{
  $vars[] = "se";
  return $vars;
}

add_filter('query_vars', 'add_query_vars_filter');




/**
 * Bulent
 */

function insights_category_nav($term_id = null){
    $categories = get_terms([
        'taxonomy' => 'insights-category',
        'hide_empty' => false,
    ]);

    $html_data = '<ul class="insights--categories">';


    foreach ($categories as $k => $v) {
        $category_link = get_category_link( $v->term_id );

        $html_data .= '<li>';
        $html_data .= '<a href="'.esc_url( $category_link ).'" title="'.$v->name.'" class="'.(($term_id == $v->term_id) ? 'active' : '').'">';
        $html_data .= $v->name;
        $html_data .= '</a>';
        $html_data .= ' (' . $v->count.')';
        $html_data .= '</li>';

    }
    $html_data .= '</ul>';

    return $html_data;
}

function insights_archive_nav(){
    $args = array(
        'type'            => 'monthly',
        'limit'           => 100,
        'format'          => 'html',
        'before'          => '',
        'after'           => '',
        'show_post_count' => true,
        'echo'            => 1,
        'order'           => 'DESC',
        'post_type'     => 'insights'
    );
    echo '<ul class="insights--archives">';

//    get_archives_link(wp_get_archives( $args ));
    $link_html = wp_get_archives( $args );

    if (  get_post_type() == 'insights' &&  (isset($_GET['post_type']) &&  $_GET['post_type'] == 'insights')) {
        $current_month = get_the_date("F Y");

        if ( preg_match('/'.$current_month.'/i', $link_html ) ){
            $link_html = preg_replace('/<a/i', '<a class="active" ', $link_html );
        }
    }

    echo $link_html;

    echo '</ul>';
}





function wpdocs_excerpt_more( $more ) {
    return '... <div class="fltng fullWidth db" style="height: 60px;"><a href="'.get_the_permalink().'" class="diagonalBtn" style="float: right;" rel="nofollow"> <span>Read More</span></a></div>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
add_theme_support( 'post-thumbnails' );






//function theme_pgp($query)
//{
//
//
//  if (is_admin()) {
//    return;                 // If we're in the admin panel - drop out
//  }
//
//  if ($query->is_single()) {      // Apply to all search queries
//    $term = get_query_var('term', ''); // get "term" from url = ?term=brand-design = 'brand-design' (if empty, default is first term)
//    // IF our category is set and not empty - include it in the query
//    if ($term) {
//      $query->set('tax_query',
//        array(
//          'post_type' => 'work',
//          array(
//            'taxonomy' => 'work',
//            'field' => 'slug',
//            'terms' => $term,
//          )));
//    }
//
//    printr($query);
//  }
//}
//
//add_action('pre_get_posts', 'theme_pgp');


//add_action('mytheme_aboveblog', 'mytheme_online_user_message', 10, 2);
//
//function mytheme_online_user_message($v, $k)
//{
//    echo "<br>echoing: " . $v . $k;
//}
//
//
//add_action('mytheme_aboveblog', 'mytheme_online_user_message2', 10, 2);
//
//function mytheme_online_user_message2($v, $k)
//{
//    echo "<br>echoing2: " . $v . $k;
//}
//
//
//add_filter( 'jacks_boast' , 'cut_the_boasting');
//function cut_the_boasting($boast) {
//    // Replace "best" with "second-best"
//    $boast = str_replace ( "best" , "second-best" , $boast );
//    // Append another phrase at the end of his boast
//    $boast = $boast . ' However, Gill can outshine me any day.';
//    return $boast;
//}

//
//add_action( 'asp_after_pagepost_results', 'asp_change_phrase', 10, 1);
//
//function asp_change_phrase( $search_phrase, $pageposts_assoc_array ) {
//    plog($search_phrase, $pageposts_assoc_array);
//}


//add_filter('asp_search_phrase_after_cleaning', 'tt', 1, 1);
//
//function tt($v){
//
//    plog($v);
//
//    return $v;
//}

//add_action('asp_after_autocomplete','tt');
//add_action('asp_layout_after_shortcode','tt');
//add_action('asp_layout_before_input','tt');
//add_action('asp_layout_after_input','tt');
//add_action('asp_layout_after_loading','tt');
//add_action('asp_res_vertical_end_item','tt');
//
//function tt(){
//
//    plog('amcik');
//
//    echo 'amcik';
//
//
//}

//remove stupid ajax loader upload folder
//wd_asp()->upload_dir = '';

