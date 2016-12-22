<?php
/* Template Name: About */
get_header(); ?>
<div id="wrap">
    <div class="headItemsWrap"
         style="background-image: url(<?= get_field('page_header_image') ?>)">
        <div class="container">

            <ul class="headItems headItems--about">

                <li class="headItems__item">
                    <span class="headItems__link light active">About</span>
                </li>
            </ul>

        </div>

    </div>

    <div class="hSlider hSlider--about">

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
    <div class="slider__progress">
        <div class="slider__progress__inner"></div>
    </div>


    <div class="welcome">
        <div class="container">
            <h2 class="welcome__head light"><?=get_field('welcome_title')?></h2>
            <div class="welcome__body"><?=get_field('welcome_body')?></div>
        </div>
    </div>

    <div class="servicesWrap servicesWrap--about">
        <div class="container">
            <h2 class="services__head light">
                <span class="services__head__inner">Our List Of Services</span>
            </h2>
            <div class="pluses pluses1">
                <div class="container">
                    <div class="pluses__inner"></div>
                </div>
            </div>
            <ul class="services">
                <? if (get_field('services'))
                    foreach (get_field('services') as $i => $v) { ?>

                        <li class="services__item">
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
            <div class="pluses pluses2">
                <div class="container">
                    <div class="pluses__inner"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="stats">
        <div class="container">
            <h2 class="stats__head light">
                <span class="stats__head__inner">Our Stats</span>
            </h2>
            <div class="pluses pluses1">
                <div class="container">
                    <div class="pluses__inner"></div>
                </div>
            </div>
            <ul class="stats__list">
                <? if (get_field('stats'))
                    foreach (get_field('stats') as $i => $v) { ?>
                        <li class="stats__item">
                            <div class="stats__main">
                                <span class="stats__num"><?= $v['number'] ?></span>
                                <span class="stats__title"><?= $v['title'] ?></span>
                            </div>

                            <div class="stats__body">
                                <?= $v['body'] ?>
                            </div>


                        </li>
                    <? } ?>
            </ul>
            <div class="pluses pluses2">
                <div class="container">
                    <div class="pluses__inner"></div>
                </div>
            </div>
        </div>
    </div>


</div>
<?php get_footer(); ?>
