<div class="vModal" ng-class="{on:vModal.on}">
    <div class="vModal__bg" ng-click="vModal.close()"></div>
    <div class="vModal__container">
        <span class="icon-close vModal__close" ng-click="vModal.close()"></span>
        <video id="vModal__video" class="video-js vjs-default-skin vjs-big-play-centered vModal__video"
               width="1280" height="720" controls preload="none"
               data-setup=''>
            <source  type='video/mp4'/>
        </video>
    </div>

</div>

<?php wp_footer(); ?>


</body>
</html>
