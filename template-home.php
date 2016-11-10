<?php
/* Template Name: Home */
get_header(); ?>

<slick class="hSlider" dots="true">

    <div class="hSlider__item" ng-repeat="i in [1, 2, 3, 4, 5]">
        <div class="hSlider__body">
            <div class="hSlider__r1">
                <span class="icon-play hSlider__play"></span>
                <div class="hSlider__title">{{i}} -GRA<b>FX</b> Reel</div>
            </div>
            <div class="hSlider__date">January, 2017</div>
            <div class="hSlider__msg">Click to view a select compilation of our <br> work completed. Enjoy!</div>
        </div>
        <img src="<?= get_template_directory_uri(); ?>/dist/img/home-slider/0.jpg"
             class="hSlider__img" alt="">
    </div>
</slick>

<div class="test">
    <div class="test__inner">
        <div class="test__left">left</div>
        <div class="test__right">right</div>
    </div>
</div>

<?php get_footer(); ?>
