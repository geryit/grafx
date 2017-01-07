<?php
get_header();
if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';


$post_id = $post->ID; // 275
$post_tax = get_post_taxonomies($post)[1]; // "work-category"
$post_first_term = wp_get_post_terms($post->ID, $post_tax)[0]->slug; // "brand-design"

$term = get_query_var('term', ''); // get "term" from url = ?term=brand-design = 'brand-design' (if empty, default is first term)
$s = get_query_var('se', ''); // get "se" from url = ?se=hea = 'hea' (if empty, default is '')


$args = array(
  'post_type' => get_post_type(), // 'work'
  's' => $s,
  'orderby' => $orderby,
  'order' => $order,

);


if ($term)
  $args['tax_query'] = array(
    array(
      'taxonomy' => $post_tax,
      'field' => 'slug',
      'terms' => $term,
    )
  );


$query = new WP_Query($args);
if ($s) relevanssi_do_query($query); // this works only there is search ('s' => $s,)

if ($query->have_posts()) {
  while ($query->have_posts()) {
    $query->the_post();
    $ids[] = $post->ID; // [294,275,274,273,270]
  }
  /* Restore original Post Data */
  wp_reset_postdata();
}


$thisindex = array_search($post_id, $ids); // 1


$workCount = count($ids); // 5
if ($thisindex > 0) $previd = $ids[$thisindex - 1]; // $previd = 294
if ($thisindex < $workCount - 1) $nextid = $ids[$thisindex + 1]; // $nextid = 274

//printr($args);
//printr($ids);
//printr("orderby:" . $orderby);
//printr("order:" . $order);
//printr("workCount:" . $workCount);
//printr("post_id:" . $post_id);
//printr("thisindex:" . $thisindex);
//if (isset($previd)) printr("previd:" . $previd); else echo "no previd";
//if (isset($nextid)) printr("nextid:" . $nextid); else echo "no nextid";

?>

<div id="wrap">
  <div class="workHead"
       <? if (isset($nextid)) { ?>ng-swipe-left="go('<?= add_query_arg(array('term' => $term, 'se' => $s, 'orderby' => $orderby, 'order' => $order), get_permalink($nextid)) ?>')"<? } ?>
       <? if (isset($previd)) { ?>ng-swipe-right="go('<?= add_query_arg(array('term' => $term, 'se' => $s, 'orderby' => $orderby, 'order' => $order), get_permalink($previd)) ?>')"<? } ?>
  >
    <div class="container">
      <ul class="workHead__items">


        <li class="workHead__nav workHead__nav--prev">
          <? if (isset($previd)) { ?>
            <a class="workHead__icon workHead__icon--prev icon-l-arrow2"
               href="<?= add_query_arg(array('term' => $term, 'se' => $s, 'orderby' => $orderby, 'order' => $order), get_permalink($previd)) ?>"></a>
          <? } ?>
        </li>

        <li class="workHead__item">
          <span class="workHead__head"><?= get_field('brand_title', 'option'); ?></span>
          <span class="workHead__link light active">
                    <?= boldify(get_the_title()) ?>
                    </span>
        </li>
        <li class="workHead__nav workHead__nav--next">
          <? if (isset($nextid)) { ?>
            <a class="workHead__icon workHead__icon--next icon-r-arrow2"
               href="<?= add_query_arg(array('term' => $term, 'se' => $s, 'orderby' => $orderby, 'order' => $order), get_permalink($nextid)) ?>"></a>
          <? } ?>
        </li>
      </ul>
    </div>
  </div>

  <div class="workC">
    <?


    if (have_rows('content')) {

      // loop through the rows of data
      while (have_rows('content')) {
        the_row();

        if (get_row_layout() == 'main_video') {


          if (have_rows('item')) {
            while (have_rows('item')) {
              the_row();
              get_template_part('content', 'main_video');
            }
          }
        } elseif (get_row_layout() == 'full_width_text') {
          if (have_rows('item')) {
            while (have_rows('item')) {
              the_row();
              get_template_part('content', 'full_width_text');
            }
          }
        } elseif (get_row_layout() == 'image_video_set') {
          get_template_part('content', 'image_video_set');

        } elseif (get_row_layout() == 'half_width_text') {
          get_template_part('content', 'half_width_text');

        } elseif (get_row_layout() == 'slider') {
          get_template_part('content', 'slider');

        } elseif (get_row_layout() == 'credit') {
          get_template_part('content', 'credit');

        }

      }

    }
    ?>
  </div>

  <div class="pluses">
    <div class="container">
      <div class="pluses__inner"></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
