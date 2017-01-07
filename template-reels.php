<?php
/* Template Name: Reels */
get_header();
global $ver; ?>
<div id="wrap">
  <div class="headItemsWrap"
       style="background-image: url(<?= get_field('page_header_image') ?>?<?= $ver ?>)">
    <div class="container">

      <ul class="headItems headItems--about">

        <li class="headItems__item">
          <span class="headItems__link light active">Reels</span>
        </li>
      </ul>

    </div>

  </div>
  <div class="reels">
    <div class="container">
      <? if (have_rows('reels')) {
        while (have_rows('reels')) {
          the_row();
          ?>
          <div class="reels__item">
            <video id="reels__video__<?= rand() ?>"
                   class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9 grafx-skin reels__video"
                   width="100%" height="100%" controls preload="none" loop
                   poster="<?= get_sub_field('first_frame') ?>?<?= $ver ?>">
              <source src="<?= get_sub_field('video') ?>" type='video/mp4'/>
            </video>
          </div>


          <?
        }
      } ?>
      <div class="pluses">
        <div class="container">
          <div class="pluses__inner"></div>
        </div>
      </div>
    </div>
  </div>


</div>
<?php get_footer(); ?>