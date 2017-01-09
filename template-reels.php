<?php
/* Template Name: Reels */
get_header();?>
<div id="wrap">
  <div class="headItemsWrap"
       style="background-image: url(<?= get_field('page_header_image') ?>?<?= VER ?>)">
    <div class="container">

      <ul class="headItems headItems--about">

        <li class="headItems__item">
          <span class="headItems__link light active">Reels</span>
        </li>
      </ul>

    </div>

  </div>
  <div class="container">
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



</div>
<?php get_footer(); ?>
