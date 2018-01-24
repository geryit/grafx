<?php
get_header();
$cats = get_field('categories', 'option');
//printr($cats);

$term_id = get_queried_object()->term_id;

//find index in acf list
foreach ($cats as $i => $v) {
  if ($v['category']->term_id == $term_id) {
    $term_index = $i;
    break;
  }
}

$bg_image = $cats[$term_index]['background_image'];


if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';

?>

<div id="wrap">
  <div class="headItemsWrap"
       style="background-image: url(<?= $bg_image ? $bg_image : '' ?>?<?= VER ?>)">
    <div class="container">

      <ul class="headItems headItems--cats">
        <li class="headItems__item">
          <a href="<?=get_permalink( get_page_by_path( 'works' ) )?>"
             class="headItems__link light">
            ALL
          </a>
        </li>
        <?
        foreach ($cats as $cat) { ?>
          <li class="headItems__item">
            <a href="<?= get_term_link($cat['category']->term_id) ?>"
               class="headItems__link light <?= $term_id == $cat['category']->term_id ? 'active' : '' ?>">
              <?= $cat['category']->name ?>
            </a>
          </li>

        <? } ?>

      </ul>

    </div>

  </div>


  <div class="container">

      <? get_template_part('part', 'reels');?>


    <h5 class="reelsContainer__head ">Works</h5>

    <div class="works works--orderBy-<?= $orderby ?> works--cats">
      <?

      $year_check = false;
      //            if($orderby == 'title') query_posts($query_string . '&orderby=title&order=ASC');
      if (have_posts()) {
        while (have_posts()) {
          the_post();


          get_template_part('loop', 'work');
        }
      }


      ?>
    </div>





  </div>
  <div class="pluses">
    <div class="container">
      <div class="pluses__inner"></div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
