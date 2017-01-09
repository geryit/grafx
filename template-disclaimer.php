<?php
/* Template Name: Disclaimer */
get_header(); ?>
<div id="wrap">
  <div class="headItemsWrap"
       style="background-image: url(<?= get_field('page_header_image') ?>?<?= VER ?>)">
    <div class="container">

      <ul class="headItems headItems--about">

        <li class="headItems__item">
          <span class="headItems__link light active"><?= get_field('disclaimer_title') ?></span>
        </li>
      </ul>

    </div>

  </div>


  <div class="disclaimer">
    <div class="container">
      <div class="pluses pluses1">
        <div class="container">
          <div class="pluses__inner"></div>
        </div>
      </div>
      <div class="disclaimer__inner">
        <?= get_field('disclaimer_body') ?>
      </div>
      <div class="pluses pluses2">
        <div class="container">
          <div class="pluses__inner"></div>
        </div>
      </div>
    </div>
  </div>


</div>
<?php get_footer(); ?>
