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
       style="background-image: url(<?= $bg_image ? $bg_image : '' ?>?<?= $ver ?>)">
    <div class="container">

      <ul class="headItems headItems--cats">

        <?
        foreach ($cats as $cat) { ?>
          <li class="headItems__item fx">
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
    <div class="works works--orderBy-<?= $orderby ?> works--cats">
      <?

      $year_check = false;
      //            if($orderby == 'title') query_posts($query_string . '&orderby=title&order=ASC');
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          $year = get_the_date('Y');
//                    $year_check = false;
          // If your year hasn't been echoed earlier in the loop, echo it now
          if ($year !== $year_check) { ?>
            <div class='works__head'>
              <div class="works__head__inner container">
                <div class="works__head__left">
                  <h5 class='works__head__year'><?= $year ?></h5>
                </div>
                <div class="works__head__right">
                  <h5 class='works__head__sortBy'>Sort by</h5>
                  <? if ($orderby == 'title') { ?>
                    <span class='works__head__sortBtn on'>A-Z</span>
                    <?
                  } else { ?>
                    <a
                      href="<?= esc_url(add_query_arg(array('orderby' => 'title', 'order' => 'ASC'))) ?>"
                      class='works__head__sortBtn'>A-Z</a>
                    <?
                  } ?>

                  <? if ($orderby == 'date') { ?>
                    <span class='works__head__sortBtn on'>DATE</span>
                    <?
                  } else { ?>
                    <a
                      href="<?= esc_url(add_query_arg(array('orderby' => 'date', 'order' => 'DESC'))) ?>"
                      class='works__head__sortBtn'>DATE</a>
                    <?
                  } ?>


                </div>
              </div>

            </div>
          <? }

          // Now that your year has been printed, assign it to the $year_check variable
          $year_check = $year;


          get_template_part('loop', 'work');
        }
      }


      ?>
    </div>


    <div class="reelsItems">
      <h5 class="reelsItems__head">Reels</h5>
      <ul class="reelsItems__list">

        <? foreach (get_field('reels', 'option') as $i => $v) { ?>

          <li class="reelsItems__item">
            <a
              ng-click="vModal.open('<?= $v['video'] ?>', '<?= $v['first_frame'] ?>', <?= $i ?>)"
              class="reelsItems__link"
              style="background-image: url(<?= $v['image'] ?>)"
            >
              <span class="reelsItems__inner">
                <span class="icon-play reelsItems__play"></span>
                <span class="reelsItems__title"><?= $v['title'] ?></span>
              </span>

            </a>
          </li>
        <? } ?>
      </ul>
    </div>


  </div>
  <div class="pluses">
    <div class="container">
      <div class="pluses__inner"></div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
