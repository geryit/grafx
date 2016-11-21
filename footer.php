<div class="vModal" ng-class="{on:vModal.on}">
    <div class="vModal__bg" ng-click="vModal.close()"></div>
    <span class="icon-close vModal__close" ng-click="vModal.close()"></span>
    <video id="vModal__video" class="video-js vjs-default-skin vjs-big-play-centered vModal__video"
           width="100%" height="100%" controls preload="none"
           data-setup=''>
        <source type='video/mp4'/>
    </video>

</div>

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

<?php wp_footer(); ?>


</body>
</html>
