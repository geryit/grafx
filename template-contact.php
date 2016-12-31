<?php
/* Template Name: Contact */
get_header(); ?>
<div id="wrap">
    <div class="headItemsWrap"
         style="background-image: url(<?= get_field('page_header_image') ?>?<?=$ver?>)">
        <div class="container">

            <ul class="headItems headItems--about">

                <li class="headItems__item">
                    <span class="headItems__link light active">Contact</span>
                </li>
            </ul>

        </div>

    </div>

    <?= do_shortcode('[wpgmza id="2"]'); ?>

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
