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
                <div class="hSlider__body" ng-click="vModal.open('<?= $v['long_video']['url'] ?>', <?=$i?>)">
                    <div class="hSlider__r1">
                        <span class="icon-play hSlider__play"></span>
                        <div class="hSlider__title light"><?= $v['title'] ?></div>
                    </div>
                    <div class="hSlider__date"><?= $v['date'] ?></div>
                    <div class="hSlider__msg"><?= $v['description'] ?></div>
                </div>
                <video class="hSlider__video hSlider__video__<?= $i ?>"
                    <? /*?>poster="<?= get_template_directory_uri(); ?>/dist/img/home-slider-posters/<?= $i ?>.png"<?*/
                    ?>
                >
                    <source src="<?= $v['video']['url'] ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <img src="<?= get_template_directory_uri(); ?>/dist/img/1425x700.png"
                     class="hSlider__placeHolder" alt="">
            </div>
        <? }
    } ?>
</div>


<?php get_footer(); ?>
