<?php
/* Template Name: VR */
get_header(); ?>
<div class="hSlider">

    <? foreach (get_field('home_slider') as $i => $v) {
        if ($v['show']) {
            ?>
            <div class="hSlider__item">
                <video id="hSlider__video__<?= $i ?>" class="hSlider__video"
                       poster="<?= $v['first_frame'] ?>?<?= VER ?>" loop>
                    <source src="<?= $v['video'] ?>" type="video/mp4">
                </video>
                <img src="<?= $v['first_frame'] ?>?<?= VER ?>"
                     id="hSlider__poster__<?= $i ?>" class="hSlider__poster" alt="">
                <img src="<?= get_template_directory_uri(); ?>/dist/img/1425x700.png"
                     class="hSlider__placeHolder" alt="">

                <div id="hSlider__body__<?= $i ?>" class="hSlider__body"
                    <? if ($v['link']) { ?>
                        ng-click="go('<?=get_permalink($v["link"])?>')"
                    <? } else { ?>
                        ng-click="vModal.open('<?= $v['long_video'] ? $v['long_video'] : $v['video'] ?>', '<?= $v['first_frame'] ?>', <?= $i ?>)"
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
                    <div class="hSlider__date"><?= $v['alternate_subtitle'] ? $v['alternate_subtitle'] : $v['date']?></div>
                    <div class="hSlider__msg"><?= $v['description'] ?></div>
                </div>
            </div>
        <? }
    } ?>

</div>


<div class="container">
    <ul class="services">
        <? if (get_field('services'))
            foreach (get_field('services') as $i => $v) {
                $link = $v['external_link'] ? $v['external_link'] : get_term_link($v['link']);
                $button = $v['external_link_button'] ? $v['external_link_button'] : get_button('View Works');
                ?>

                <li class="services__item">
                    <span class="services__title"><?= $v['title'] ?></span>
                    <span class="services__body light"><?= $v['body'] ?></span>
                </li>
            <? } ?>
    </ul>


</div>

<div class="workC">
    <?


    if (have_rows('content')) {

        // loop through the rows of data
        while (have_rows('content')) {
            the_row();
//        echo '<div>'.get_row_layout().'</div>';

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

            }elseif (get_row_layout() == 'image_for_m') {
                get_template_part('content', 'image_for_mobile');

            }

        }

    }
    ?>
</div>

<div class="container">

    <div class="brands">
        <h2 class="brands__title light"><?= get_field('brands_title') ?></h2>
        <ul class="brands__list">
            <? if (get_field('brands'))
                foreach (get_field('brands') as $v) { ?>
                    <li class="brands__item"
                    >
                        <img class="brands__img" src="<?= $v["image"] ?>?<?= VER ?>" alt="">
                    </li>
                <? } ?>
        </ul>
    </div>
</div>

<div class="social">
    <video id="social__video" class="social__video" preload="none" loop
           poster="<?= get_field('social_video_first_frame', HOMEID) ?>">
        <source src="<?= get_field('social_video', HOMEID) ?>" type="video/mp4">
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
                    <? if (get_field('social', HOMEID))
                        foreach (get_field('social', HOMEID) as $v) { ?>
                            <li class="social__network">
                                <a href="<?= $v['link'] ?>"
                                   class="social__link"><?= $v['title'] ?></a>
                            </li>
                        <? } ?>
                </ul>
            </div>
            <div class="social__right">
                <?= get_field('address', HOMEID) ?>
            </div>
        </div>

    </div>

</div>




<?php get_footer(); ?>
