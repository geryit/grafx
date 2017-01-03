<? global $ver;?>

<div class="cSliderWrap">
    <div class="cSlider">

        <? if (have_rows('item')) {
            while (have_rows('item')) {
                the_row(); ?>
                <div class="cSlider__items">
                    <? if (get_row_layout() == 'image') {
                        ?>
                        <div class="cSlider__item cSlider__item--img">
                            <img class="cSlider__item__img" src="<?= get_sub_field('image') ?>?<?=$ver?>" alt="">
                        </div>

                    <? } else if (get_row_layout() == 'video') { ?>
                        <div class="cSlider__item cSlider__item--video">
                            <video
                                id="video__<?=rand()?>"
                                class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9 grafx-skin cSlider__item__video bigger-play darker-play"
                                width="100%" height="100%" controls
                                poster="<?= get_sub_field('video_first_frame') ?>?<?=$ver?>">
                                <source src="<?= get_sub_field('video') ?>" type='video/mp4'/>
                            </video>
                        </div>


                    <? } ?>
                </div>
                <?
            }
        } ?>

    </div>
</div>

