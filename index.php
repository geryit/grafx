<?php
get_header(); ?>

<div id="wrap">
    <div class="cats">
        <div class="cats__header">
            <ul>
                <? foreach (get_field('categories','option') as $v) {?>
                <li>
                    <a href="#"><?print_r($v)?></a>
                </li>
                <? }?>
            </ul>
        </div>
    </div>
</div>
<?php get_footer(); ?>
