<?php
/* Template Name: Home */
get_header(); ?>
<div class="slider__progress">
  <div class="slider__progress__inner"></div>
</div>
<div class="hSlider">

  <? foreach (get_field('home_slider') as $i => $v) {
    if ($v['show']) {
      ?>
      <div class="hSlider__item">
        <video id="hSlider__video__<?= $i ?>" class="hSlider__video"
               poster="<?= $v['first_frame'] ?>?<?= $ver ?>">
          <source src="<?= $v['video'] ?>" type="video/mp4">
        </video>
        <img src="<?= $v['first_frame'] ?>?<?= $ver ?>"
             id="hSlider__poster__<?= $i ?>" class="hSlider__poster" alt="">
        <img src="<?= get_template_directory_uri(); ?>/dist/img/1425x700.png"
             class="hSlider__placeHolder" alt="">

        <div id="hSlider__body__<?= $i ?>" class="hSlider__body"
          <? if ($v['link']) { ?>
            ng-click="go('<?=get_permalink($v["link"])?>')"
          <? } else { ?>
            ng-click="vModal.open('<?= $v['long_video'] ?>', '<?= $v['first_frame'] ?>', <?= $i ?>)"
          <? } ?>

        >
          <div class="hSlider__r1">
            <? if ($v['link']) { ?>
              <span class="icon-r-arrow hSlider__play"></span>
            <? } else { ?>
              <span class="icon-play hSlider__play"></span>
            <? } ?>
            <div class="hSlider__title light"><?= $v['title'] ?></div>
          </div>
          <div class="hSlider__date"><?= $v['date'] ?></div>
          <div class="hSlider__msg"><?= $v['description'] ?></div>
        </div>
      </div>
    <? }
  } ?>

</div>


<div class="container">
  <ul class="services">
    <? if (get_field('services'))
      foreach (get_field('services') as $i => $v) { ?>

        <li class="services__item" ng-click="go('<?= get_term_link($v['link']); ?>')">
          <span class="services__title"><?= $v['title'] ?></span>
          <span class="services__body light"><?= $v['body'] ?></span>
          <div class="services__item__btnWrapper">
            <a href="<?= get_term_link($v['link']); ?>"
               class="diagonalBtn services__item__btn">
              <span><?= get_button('View Works') ?></span>
            </a>
          </div>
        </li>
      <? } ?>
  </ul>


  <div class="works works--feat">
    <?

    while (have_rows('featured_works')) {
      the_row();

      $post_object = get_sub_field('work');


      if ($post_object) {
        $post = $post_object;
        setup_postdata($post);
//                printr($post);
//                printr($post->post_type);
//                printr(get_post_taxonomies( $post )[1]); //['post_tag','work-category']
//                printr(wp_get_post_terms( $post->ID, get_post_taxonomies( $post )[1]));

        $post_type = $post->post_type;


        get_template_part('loop', 'work');

        wp_reset_postdata();
      }
    }; ?>
  </div>


  <div class="brands">
    <h2 class="brands__title light"><?= get_field('brands_title') ?></h2>
    <ul class="brands__list">
      <? if (get_field('brands'))
        foreach (get_field('brands') as $v) { ?>
          <li class="brands__item"
              ng-click="go('<?= $v['custom_link'] ? $v['custom_link'] : get_permalink($v["link"]) ?>')"
          >
            <img class="brands__img" src="<?= $v["image"] ?>?<?= $ver ?>" alt="">
            <div class="brands__item__btnWrapper">
              <a href="<?= $v['custom_link'] ? $v['custom_link'] : get_permalink($v["link"]) ?>"
                 class="diagonalBtn brands__btn">
                <span><?= isset($v['button']->post_content) ? $v['button']->post_content : 'View Project' ?></span></a>
            </div>
          </li>
        <? } ?>
    </ul>
  </div>

</div>

<div class="social">
  <video id="social__video" class="social__video" preload="none" loop
         poster="<?= get_field('social_video_first_frame') ?>">
    <source src="<?= get_field('social_video') ?>" type="video/mp4">
  </video>

  <div class="social__video__overlay"></div>

  <a href="javascript:void(0)" class="social__pointer"></a>
  <div class="social__map"></div>
  <div class="social__map social__map--hover"></div>

  <div class="container">
    <div class="social__wrapper">
      <div class="social__left">
        <h6 class="social__head">FOLLOW US</h6>
        <ul class="social__networks">
          <? if (get_field('social'))
            foreach (get_field('social') as $v) { ?>
              <li class="social__network">
                <a href="<?= $v['link'] ?>"
                   class="social__link"><?= $v['title'] ?></a>
              </li>
            <? } ?>
        </ul>
      </div>
      <div class="social__right">
        <?= get_field('address') ?>
      </div>
    </div>

  </div>

</div>

<div class="vModal" ng-class="{on:vModal.on}">
  <div class="vModal__bg" ng-click="vModal.close()"></div>
  <span class="icon-close vModal__close" ng-click="vModal.close()"></span>
  <video id="vModal__video"
         class="video-js vjs-default-skin vjs-big-play-centered grafx-skin vModal__video"
         width="100%" height="100%" controls preload="none"
  >
    <source type='video/mp4'/>
  </video>

</div>


<?php get_footer(); ?>
