<? global $ver;?>

<div class="halfWidthText">
    <div class="container">
        <div class="halfWidthText__item">
            <? if (have_rows('item')) {
                while (have_rows('item')) {
                    the_row();
                    ?>
                    <div class="halfWidthText__col">
                        <h4 class="halfWidthText__head"><?= get_sub_field('title') ?></h4>
                        <div class="halfWidthText__body light"><?= get_sub_field('body') ?></div>
                    </div>


                    <?
                }
            } ?>
        </div>
    </div>

</div>
