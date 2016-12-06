<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <div class="footer__left">All rights reserved. Copyright &copy; 2016</div>
            <div class="footer__right">
                <a href="#" class="footer__right__link">Legal Disclaimer</a>
                <a href="#" class="footer__right__link">grafx.co</a>
            </div>
        </div>
    </div>
</footer>

<div class="sModal" ng-class="{on:sModal.on}">
    <div class="sModal__bg" ng-click="sModal.close()"></div>

    <div class="sModal__content">
        <div class="container">
            <div class="sModal__inner">

                <a class="" href="<?= home_url(); ?>"><img
                        src="<?= get_template_directory_uri(); ?>/dist/img/logo.svg"
                        class="sModal__logo" width="110" alt=""></a>
                <span class="icon-close sModal__close" ng-click="sModal.close()"></span>
            </div>
        </div>

        <?=do_shortcode('[wd_asp id=1]'); ?>
    </div>

</div>

<?php wp_footer(); ?>

</body>
</html>
