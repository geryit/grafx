<?php
/* Template Name: Contact */
get_header(); ?>
<div id="wrap">
    <div class="headItemsWrap"
         style="background-image: url(<?= get_field('page_header_image') ?>)">
        <div class="container">

            <ul class="headItems headItems--about">

                <li class="headItems__item">
                    <span class="headItems__link light active">Contact</span>
                </li>
            </ul>

        </div>

    </div>

    <?=do_shortcode('[wpgmza id="2"]'); ?>

</div>
<?php get_footer(); ?>
