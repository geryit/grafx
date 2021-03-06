<!doctype html>
<html <?php language_attributes(); ?> ng-controller="grafxCtrl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
            echo ' :';
        } ?><?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/dist/img/touch.png"
          rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>

    <?

    if (is_page_template('template-home.php') || is_page_template('template-about.php') || is_page_template('template-vr.php')) {
        $activeSlidecount = 0;
        foreach (get_field('home_slider') as $v) {
            if ($v['show']) $activeSlidecount++;
        }
        ?>
        <script>
            window.hsAutoplay = <?=get_field('home_slider_autoplay') ? 'true' : 'false'?>;
            window.hsAutoplaySecs = <?=get_field('home_slider_duration')?>;
        </script>
        <style>
            .slider__progress__inner.on {
                transition-duration: <?=get_field('home_slider_duration')?>s !important;
            }

            .hSlider__arrow__prev {
                margin-left: -<?=$activeSlidecount*40?>px;
            }

            .hSlider__arrow__next {
                margin-left: <?=$activeSlidecount*40?>px;
            }

            <? foreach (get_field('home_slider') as $i=>$v) { ?>
            .hSlider__dots li:nth-child(<?=($i+1)?>) button:before {
                content: '<?=$v['subtitle']?>';
            }

            <? }?>

        </style>
    <? } ?>

    <style>
        <?
          $cats = get_field('categories', 'option');

          foreach ($cats as $v) {
            $c = $v['category'];

            ?>
        .r_term--<?=$c->slug;?> {
            color: <?=$v['color']?>;
        }

        .r_term--<?=$c->slug;?>:before {
            content: '<?=html_entity_decode($c->name);?>';
        }

        .r_term--<?=$c->slug;?>:after {
            content: '<?=$v['initials']?>';
        }

        <?}?>
    </style>


</head>
<body <?php body_class(); ?> ng-class="{oyh:vModal.on||sModal.on,mMenuOn:mMenu.on}"
                             ng-swipe-right="mMenu.on = false">


<div class="mMenu">
    <? wp_nav_menu(array('theme_location' => 'header-menu')); ?>
</div>


<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="logo header__inner__logo">
                <a class="logo__link" href="<?= home_url(); ?>">
                    <img src="<?= get_template_directory_uri(); ?>/dist/img/logo.svg"
                         class="logo__img" width="110" alt="">
                    <img src="<?= get_template_directory_uri(); ?>/dist/img/logo2.svg"
                         class="logo__img2" width="100" alt="">
                </a>
            </div>

            <? if (!is_page_template('template-vr.php')) {?>
                <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
            <? }else{ ?>
                <a href="<?=home_url();?>" id="back-home">Back to GRAFX CO. site -></a>
            <?}?>

            <a href="javascript:void(0)" class="header__ham"
               ng-click="mMenu.on = !mMenu.on">
                <span class="icon-ham ng-cloak" ng-if="!mMenu.on"></span>
                <span class="icon-close header__ham__close ng-cloak" ng-if="mMenu.on"></span>
            </a>

        </div>
    </div>
</header>




