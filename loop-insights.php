<?
if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';

$current_object = get_queried_object();// can be page,tax/term, single

//$post_tax = get_post_taxonomies($post)[1];//['post_tag','insights-category']


if (isset($current_object->slug)) { //page object doesnt have slug, so this page is tax/terms page
    $post_term = $current_object->slug; //if tax/term page, get current term
} else {
    $post_term = ''; // get first term
}


$btn = get_field('case_study') ? get_button('View Case') : get_button('View Insights');
if (!$btn) $btn = 'View Insights';

?>


<div class="insights--item">





    <div class="insights--item--featured--image">

        <div class="works__inner"
             style="background-image: url(<?= the_post_thumbnail_url(); ?>?<?= VER ?>)">
            <?
            if (get_field('awards')) {?>
                <ul class="awardsTags">
                    <? if (get_field('awards'))
                        foreach (get_field('awards') as $m) { ?>
                            <li class="awardsTags__item"><?= $m ?></li>
                        <? } ?>
                </ul>
            <? } ?>
            <span class="works__inner__cornerTitle"
                  style="color: <?= get_field('corner_title_color'); ?>"><?= boldify(get_the_title()) ?></span>
            <div class="works__inner__items">
                <span class="works__inner__title"><?= boldify(get_the_title()) ?></span>
                <span
                        class="works__inner__desc light"></span>
                <a
                        href="<?= add_query_arg(array('term' => $post_term, 'se' => get_search_query(), 'orderby' => $orderby, 'order' => $order), get_permalink()) ?>"
                        class="diagonalBtn works__inner__btn">
                    <span><?= $btn ?></span>
                </a>
            </div>

        </div>

        <?php
//        the_post_thumbnail('full');
        ?>
    </div>


    <span class="insights--item--date">
        <?php
        the_date('F jS, Y', '', '');
        ?>
    </span>


    <div class="insights--item--title">
        <a href="<?= add_query_arg(array(), get_permalink()) ?>">
            <?= boldify(get_the_title()); ?>
        </a>
    </div>


    <div class="insights--item--content">
        <?php
        the_excerpt();

        /* if ( is_category() || is_archive() ) {
             the_excerpt();
         } else {
             the_content();
         }*/
        ?>
    </div>


    <div class="insights--item--foot">
        <!--        <p>-->
        <!--            By <strong>--><?php //the_author(); ?><!--</strong>-->
        <!--        </p>-->
        <p class="insights--item--tag">
            <?php echo get_the_tag_list('<strong>', ', ', '</strong>'); ?>
        </p>
    </div>
</div>

<hr class="insights--divider"/>