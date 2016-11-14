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

        <div class="block">
            <div class="infobox">
                <a href="">
                    <div class="infobox__item infobox__item--first">
                        <div class="infobox__link">VIEW WORKS
                        </div>
                        <div class="infobox__title">Branding-Design
                        </div>
                        <div class="infobox__text">From a strategic tagline to a logo design, a business card to a global campaign, our partnership is derived from who you really are. Our 360 Branding & Design services are tailored to help deliver your promise to your clients; a successful brand.
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="infobox__item">
                        <div class="infobox__link">VIEW WORKS
                        </div>
                        <div class="infobox__title">Production
                        </div>
                        <div class="infobox__text">Our production services are tailored for original cinema, television, digital and virtual reality content. Our experienced directors and crew are equipped with state of the art production equipment. We will deliver on our promise of the highest standards.
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="infobox__item">
                        <div class="infobox__link">VIEW WORKS
                        </div>
                        <div class="infobox__title">Post-Production
                        </div>
                        <div class="infobox__text">Our in-house post-production studio, featuring editing, 2D / 3D motion graphics and design, character animation, visual effects, color correction, as well as sound design and composing, is a compliment to all our other services.
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="infobox__item">
                        <div class="infobox__link">VIEW WORKS
                        </div>
                        <div class="infobox__title">Experiental & Digital
                        </div>
                        <div class="infobox__text">Our experience design expertise is based on a decade long dedication to digital design, out-of-home media, strategic user experience and user interface design for web, mobile, virtual reality as well as live event media and real-time interactive installations.
                        </div>
                    </div>
                </a>
            </div>
            <div class="imagebox">
                <div class="imagebox__full--linkbox"> <a href="">
                    <div class="imagebox__full">
                        <div class="imagebox__full--link">VIEW CASE
                        </div>
                        <div class="imagebox__full--title">
                        </div>
                        <div class="imagebox__full--image"> <img style="width:100%; height:100%" src="assets/img/imagebox__full.png"></div>
                    </div>
                </a></div>
            </div>
            <div class="imagebox">
                <div class="imagebox__half">
                    <div class="imagebox__half--link">VIEW CASE
                    </div>
                    <div class="imagebox__half--title black">
                    </div>
                    <img class="imagebox__half--image" src="assets/img/imagebox__half--left1.png">
                </div>
                <div class="imagebox__half">
                    <div class="imagebox__half--link">VIEW CASE
                    </div>
                    <div class="imagebox__half--title black">
                    </div>
                    <img class="imagebox__half--image" src="assets/img/imagebox__half--right1.png">
                </div>
                <div class="imagebox__half">
                    <div class="imagebox__half--link">VIEW CASE
                    </div>
                    <div class="imagebox__half--title black">
                    </div>
                    <img class="imagebox__half--image" src="assets/img/imagebox__half--left2.png">
                </div>
                <div class="imagebox__half">
                    <div class="imagebox__half--link">VIEW CASE
                    </div>
                    <div class="imagebox__half--title white">
                    </div>
                    <img class="imagebox__half--image" src="assets/img/imagebox__half--right2.png">
                </div>
            </div>
            <div class="clients">
                <div class="clients__title">Brands We Work With
                </div>
                <div class="clients__list">
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo1.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo2.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo3.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo4.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo5.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo6.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo7.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo8.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo9.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo10.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo11.png">
                    </div>
                    <div class="clients__item">
                        <div class="clients__item--link">LEARN MORE
                        </div>
                        <img class="clients__item--logo" src="assets/img/brand__logo1.png">
                    </div>
                </div>
            </div>
        </div>

sdfsdf
<?php get_footer(); ?>
