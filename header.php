<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
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

</head>
<body <?php body_class(); ?> ng-app="grafxApp" ng-controller="grafxCtrl">
<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="logo header__inner__logo">
                <a class="logo__link">
                    <img src="<?= get_template_directory_uri(); ?>/dist/img/logo.svg"
                        class="logo__img" width="110" alt="">
                </a>
            </div>

            <ul class="menu">
                <li class="menu__item">
                    <a href="#" class="menu__link">About</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">Work</a>
                </li>
                <li class="menu__item">
                    <a href="#" class="menu__link">Contact</a>
                </li>
            </ul>

            <div class="search">
                <a href="#" class="search__btn icon-search">
                </a>
            </div>


        </div>
    </div>
</header>


