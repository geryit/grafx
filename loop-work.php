<?
$current_object = get_queried_object();// can be page,tax/term, single
//printr($current_object);
$post_tax = get_post_taxonomies($post)[1];//['post_tag','work-category']

if ($current_object->slug) { //page object doesnt have slug, so this page is tax/terms page
    $post_term = $current_object->slug; //if tax/term page, get current term
} else {
    $post_term = wp_get_post_terms($post->ID, $post_tax)[0]->slug; // get first term
}
//echo "<br>post_tax:" . $post_tax;
//echo "<br>post_term:" . $post_term;
?>
<div class="works__item <?= get_field('case_study') ? 'works__item--case' : ''; ?>">
    <div class="works__inner"
         style="background-image: url(<?= get_field('main_image'); ?>)">
        <ul class="awardsTags">
            <? if (get_field('awards'))
                foreach (get_field('awards') as $m) { ?>
                    <li class="awardsTags__item"><?= $m ?></li>
                <? } ?>
        </ul>
        <span class="works__inner__cornerTitle"
              style="color: <?= get_field('corner_title_color'); ?>"><?= boldify(get_the_title()) ?></span>
        <div class="works__inner__items">
            <span class="works__inner__title"><?= boldify(get_the_title()) ?></span>
            <span
                class="works__inner__desc light"><?= get_field('short_description'); ?></span>
            <a href="<?= add_query_arg(array('term' => $post_term), get_permalink()) ?>"
               class="diagonalBtn works__inner__btn">
                <span>VIEW CASE</span>
            </a>
        </div>

    </div>

</div>
