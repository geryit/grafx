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
    <ul class="cats">
        <?
        $a = array(
            array(
                'title' => 'Branding-Design',
                'body' => 'From a strategic tagline to a logo design, a business
                    card to a global campaign, our partnership is derived from who you really are.
                    Our 360 Branding & Design services are tailored to help deliver your promise to
                    your clients; a successful brand.',
            ),
            array(
                'title' => 'Production',
                'body' => 'Our production services are tailored for original cinema,
                    television, digital and virtual reality content. Our experienced directors and
                    crew are equipped with state of the art production equipment. We will deliver on
                    our promise of the highest standards.
                ',
            ),
            array(
                'title' => 'Post-Production',
                'body' => 'Our in-house post-production studio, featuring editing,
                    2D / 3D motion graphics and design, character animation, visual effects, color
                    correction, as well as sound design and composing, is a compliment to all our
                    other services.
                ',
            ),
            array(
                'title' => 'Experiental & Digital',
                'body' => 'Our experience design expertise is based on a decade long
                    dedication to digital design, out-of-home media, strategic user experience and
                    user interface design for web, mobile, virtual reality as well as live event
                    media and real-time interactive installations.
                ',
            ),


        );
        foreach ($a as $v) { ?>

            <li class="cats__item">
                <a href="#" class="cats__link">
                    <span class="cats__title"><?= $v['title'] ?></span>
                    <span class="cats__body"><?= $v['body'] ?></span>
                </a>
            </li>
        <? } ?>
    </ul>


    <div class="imagebox">
        <div class="imagebox__full--linkbox"><a href="">
                <div class="imagebox__full">
                    <div class="imagebox__full--link">VIEW CASE
                    </div>
                    <div class="imagebox__full--title">
                    </div>
                    <div class="imagebox__full--image"><img style="width:100%; height:100%"
                                                            src="<?= get_template_directory_uri(); ?>/dist/img/home-imagebox/imagebox-full.png">
                    </div>
                </div>
            </a></div>
    </div>
    <div class="imagebox">
        <div class="imagebox__half">
            <div class="imagebox__half--link">VIEW CASE
            </div>
            <div class="imagebox__half--title black">
            </div>
            <img class="imagebox__half--image"
                 src="<?= get_template_directory_uri(); ?>/dist/img/home-imagebox/imagebox-half1.png">
        </div>
        <div class="imagebox__half">
            <div class="imagebox__half--link">VIEW CASE
            </div>
            <div class="imagebox__half--title black">
            </div>
            <img class="imagebox__half--image"
                 src="<?= get_template_directory_uri(); ?>/dist/img/home-imagebox/imagebox-half2.png">
        </div>
        <div class="imagebox__half">
            <div class="imagebox__half--link">VIEW CASE
            </div>
            <div class="imagebox__half--title black">
            </div>
            <img class="imagebox__half--image"
                 src="<?= get_template_directory_uri(); ?>/dist/img/home-imagebox/imagebox-half3.png">
        </div>
        <div class="imagebox__half">
            <div class="imagebox__half--link">VIEW CASE
            </div>
            <div class="imagebox__half--title white">
            </div>
            <img class="imagebox__half--image"
                 src="<?= get_template_directory_uri(); ?>/dist/img/home-imagebox/imagebox-half4.png">
        </div>
    </div>
    <div class="clients">
        <div class="clients__title">Brands We Work With
        </div>
        <div class="clients__list">
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo1.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo2.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo3.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo4.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo5.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo6.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo7.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo8.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo9.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo10.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo11.png">
            </div>
            <div class="clients__item">
                <div class="clients__item--link">LEARN MORE
                </div>
                <img class="clients__item--logo"
                     src="<?= get_template_directory_uri(); ?>/dist/img/home-brand-logos/logo1.png">
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
