<div class="imageForMobile">
  <div class="container">
    <div class="imageForMobile__item">
      <? if (have_rows('item')) {
        while (have_rows('item')) {
          the_row();
          ?>
          <img src="<?= get_sub_field('image') ?>?<?= VER ?>" alt="">
          <?
        }
      } ?>
    </div>
  </div>

</div>
