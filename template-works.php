<?php
/* Template Name: Works */
get_header();

$cats = get_field('categories', 'option');

$term_id = get_queried_object()->term_id;

//find index in acf list
foreach ($cats as $i => $v) {
    if ($v['category']->term_id == $term_id) {
        $term_index = $i;
        break;
    }
}

if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';
if (get_query_var('order')) $order = get_query_var('order'); else $order = 'DESC';

?>


<div id="wrap">
    <div class="headItemsWrap"
         style="background-image: url(<?= get_field('page_header_image') ?>?<?= VER ?>)">
        <div class="container">

            <ul class="headItems headItems--cats">
                <li class="headItems__item">
          <span class="headItems__link light active">
            ALL
          </span>
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
            $loop = new WP_Query(array('post_type' => 'work', 'posts_per_page' => -1, 'orderby' => $orderby, 'order' => $order,));
            if ($loop->have_posts()) {
                while ($loop->have_posts()) {
                    $loop->the_post();

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

<? get_footer(); ?>
