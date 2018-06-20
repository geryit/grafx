<footer class="footer">
  <div class="container">
    <div class="footer__wrapper">
      <div class="footer__left">ALL RIGHTS RESERVED SINCE © 2013 GRAFX™ - GRAFX IS A REGISTERED TRADEMARK - TM NO: 5450349</div>
      <div class="footer__right">
        <a href="<?= site_url() ?>/disclaimer" class="footer__right__link">Legal Disclaimer</a>
        <a href="#" class="footer__right__link">grafx.co</a>
      </div>
    </div>
  </div>
</footer>

<div class="vModal" ng-class="{on:vModal.on}">
  <div class="vModal__bg" ng-click="vModal.close()"></div>
  <span class="icon-close vModal__close" ng-click="vModal.close()"></span>
  <video id="vModal__video"
         class="video-js vjs-default-skin vjs-big-play-centered grafx-skin vModal__video"
         width="100%" height="100%" controls preload="none"
  >
    <source type='video/mp4'/>
  </video>

</div>

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

    <?= do_shortcode('[wd_asp id=1]'); ?>
  </div>

</div>

<?php wp_footer(); ?>
<script>

  $(document).ready(function () {
    $('.asp_main_container').on('asp_search_end', function (event, id, instance, phrase) {
      if (phrase.length > 2) {
        if (!$('#seeAll').length) $('.results').append("<div id='seeAll'></div>");

        const html = "<div class='container'><a href='/?s=" + phrase + "&orderby=date&order=DESC' id='seeAll__link'>See all results for '" + phrase + "' </a></div>";

        $('#seeAll').show().html(html);
      }else{
        $('#seeAll').hide();
      }

    })
  });

</script>
</body>
</html>
