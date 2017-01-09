<?php
/* Template Name: Reels */
get_header(); ?>
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
  <div class="workC workC--reels">
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
