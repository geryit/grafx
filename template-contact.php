<?php
/* Template Name: Contact */
get_header(); ?>
<div id="wrap">
    <div class="headItemsWrap"
         style="background-image: url(<?= get_field('page_header_image') ?>?<?=VER?>)">
        <div class="container">

            <ul class="headItems headItems--about">

                <li class="headItems__item">
                    <span class="headItems__link light active">Contact</span>
                </li>
            </ul>

        </div>

    </div>

    <?= do_shortcode('[wpgmza id="2"]'); ?>

    <div class="contactForm">
        <div class="container">
            <h4 class="contactForm__head">INQUIRIES</h4>
            <div class="contactForm__note">For general or business inquiries, please fill out and submit the form below.</div>

            <? if (isset($_GET['contactSent'])) { ?>
                <div class="mModal">
                    <div class="mModal__inner">
                        <div class="pluses pluses1">
                            <div class="container">
                                <div class="pluses__inner"></div>
                            </div>
                        </div>
                        <h2 class="mModal__head">Thank you for your interest in Grafx!</h2>
                        <div class="mModal__copy">We will get back with you very soon
                        </div>
                        <div class="mModal__footer">
                            <a href="/" class="mModal__btn diagonalBtn"><span>MAIN PAGE</span></a>
                        </div>
                        <div class="pluses pluses2">
                            <div class="container">
                                <div class="pluses__inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
            <form name="contactForm__form" class="contactForm__form" novalidate
                  ng-submit="submitContact()">
                <div class="contactForm__left">
                    <div class="contactForm__item">
                        <input
                                name="first_name"
                                ng-model="first_name"
                                type="text"
                                class="contactForm__input"
                                id="first_name"
                                placeholder="Please Fill In"
                                ng-required="true"
                        >
                        <label for="first_name" class="contactForm__label">YOUR FIRST NAME (*)</label>
                    </div>
                    <div class="contactForm__item">
                        <input
                                name="last_name"
                                ng-model="last_name"
                                type="text"
                                class="contactForm__input"
                                id="last_name"
                                placeholder="Please Fill In"
                                ng-required="true"
                        >
                        <label for="last_name" class="contactForm__label">YOUR LAST NAME (*)</label>
                    </div>
                    <div class="contactForm__item">
                        <input
                                name="email"
                                ng-model="email"
                                type="email"
                                class="contactForm__input"
                                id="email"
                                placeholder="Please Fill In"
                                ng-required="true"
                        >
                        <label for="email" class="contactForm__label">E-MAIL (*)</label>
                    </div>
                </div>
                <div class="contactForm__right">
                    <div class="contactForm__item">
                        <textarea
                                name="msg"
                                ng-model="msg"
                                class="contactForm__input contactForm__textarea"
                                id="msg"
                                placeholder="Please Fill In"
                                ng-required="true"
                        ></textarea>
                        <label for="msg" class="contactForm__label">YOUR MESSAGE (*)</label>
                    </div>

                    <div class="contactForm__submit">
                        <div class="contactForm__captcha" ng-class="{'captchaMissing' : !captcha.response}">

                            <script
                                    src="//www.google.com/recaptcha/api.js?render=explicit&onload=vcRecaptchaApiLoaded"
                                    async defer></script>
                            <div
                                    vc-recaptcha
                                    key="captcha.key"
                                    on-success="captcha.setResponse(response)"
                                    class="contactForm__captcha__box"
                            ></div>
                        </div>
                        <button type="submit" class="contactForm__submitBtn">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>

    </div>


    <div class="contactFooter">
        <div class="container">
            <ul class="contactFooter__cols">
                <? if (get_field('contact_footer'))
                    foreach (get_field('contact_footer') as $i => $v) { ?>
                        <li class="contactFooter__col">
                            <?=$v['body']?>
                        </li>
                    <? } ?>
            </ul>
            <div class="pluses">
                <div class="container">
                    <div class="pluses__inner"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>
