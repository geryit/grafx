<?php
/* Template Name: Home */
get_header(); ?>
<div class="slider__progress">
    <div class="slider__progress__inner"></div>
</div>
<div class="hSlider">

    <? for ($i = 0; $i <= 2; $i++) { ?>
        <div class="hSlider__item">
            <div class="hSlider__body">
                <div class="hSlider__r1">
                    <span class="icon-play hSlider__play"></span>
                    <div class="hSlider__title"><?= $i ?> -GRA<b>FX</b> Reel</div>
                </div>
                <div class="hSlider__date">January, 2017</div>
                <div class="hSlider__msg">Click to view a select compilation of our <br> work
                    completed. Enjoy!
                </div>
            </div>
            <video class="hSlider__video hSlider__video__<?= $i ?>" autoplay
               <?/*?>poster="<?= get_template_directory_uri(); ?>/dist/img/home-slider-posters/<?= $i ?>.png"<?*/?>
            >
                <source src="<?= get_template_directory_uri(); ?>/dist/video/<?= $i ?>.mov"
                        type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <img src="<?= get_template_directory_uri(); ?>/dist/img/1425x700.png"
                 class="hSlider__placeHolder" alt="">
        </div>
    <? } ?>
</div>


<?php get_footer(); ?>
