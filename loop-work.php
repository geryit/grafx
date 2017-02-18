<?
if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';

$current_object = get_queried_object();// can be page,tax/term, single

//$post_tax = get_post_taxonomies($post)[1];//['post_tag','work-category']


if (isset($current_object->slug)) { //page object doesnt have slug, so this page is tax/terms page
  $post_term = $current_object->slug; //if tax/term page, get current term
} else {
  $post_term = ''; // get first term
}


$btn = get_field('case_study') ? get_button('View Case') : get_button('View Work');
if (!$btn) $btn = 'View Work';


?>
<div class="works__item <?= get_field('case_study') ? 'works__item--case' : ''; ?>"
     ng-click="go('<?= add_query_arg(array('term' => $post_term, 'se' => get_search_query(), 'orderby' => $orderby, 'order' => $order), get_permalink()) ?>')">
  <div class="works__inner"
       style="background-image: url(<?= get_field('main_image'); ?>?<?= VER ?>)">
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
        class="works__inner__desc light"><?= get_field('short_description'); ?></span>
      <a
        href="<?= add_query_arg(array('term' => $post_term, 'se' => get_search_query(), 'orderby' => $orderby, 'order' => $order), get_permalink()) ?>"
        class="diagonalBtn works__inner__btn">
        <span><?= $btn ?></span>
      </a>
    </div>

  </div>

</div>
