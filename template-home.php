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
                       poster="<?= $v['first_frame'] ?>">
                    <source src="<?= $v['video'] ?>" type="video/mp4">
                </video>
                <img src="<?= $v['first_frame'] ?>"
                     id="hSlider__poster__<?= $i ?>" class="hSlider__poster" alt="">
                <img src="<?= get_template_directory_uri(); ?>/dist/img/1425x700.png"
                     class="hSlider__placeHolder" alt="">


                <div id="hSlider__body__<?= $i ?>" class="hSlider__body"
                     ng-click="vModal.open('<?= $v['long_video'] ?>', '<?= $v['first_frame'] ?>', <?= $i ?>)">
                    <div class="hSlider__r1">
                        <span class="icon-play hSlider__play"></span>
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
        <?
        foreach (get_field('services') as $i => $v) { ?>

            <li class="services__item">
                <a href="#" class="services__link">
                    <span class="services__title"><?= $v['title'] ?></span>
                    <span class="services__body light"><?= $v['body'] ?></span>
                </a>
            </li>
        <? } ?>
    </ul>


    <ul class="featWorks">
        <?

        while (have_rows('featured_works')) {
            the_row();

            $post_object = get_sub_field('work');

            $title = get_the_title();

            if ($post_object) {
                $post = $post_object;
                setup_postdata($post);

//            $description = get_the_content();
//            $download =

                ?>
                <li class="featWorks__item">
                    <div class="featWorks__inner"
                         style="background-image: url(<?= get_field('main_image'); ?>)">
                        <span class="featWorks__inner__cornerTitle"
                              style="color: <?= get_sub_field('title_color'); ?>"><?= get_the_title() ?></span>
                        <div class="featWorks__inner__items">
                            <span class="featWorks__inner__title"><?= get_the_title() ?></span>
                            <span
                                class="featWorks__inner__desc light"><?= get_field('short_description'); ?></span>
                            <a href="#" class="featWorks__inner__btn">VIEW CASE</a>
                        </div>

                    </div>

                </li>
                <?
                wp_reset_postdata();
            }
        }; ?>
    </ul>


</div>


<?php get_footer(); ?>
