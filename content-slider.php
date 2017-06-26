<style>
    .cSlider__arrow:before {
        color: <?= get_field('slider_arrow_color') ? get_field('slider_arrow_color') : '#000' ?>;
    }
</style>
<div class="cSliderWrap">
    <div class="cSlider" <? if (get_row_layout() == 'kuula') echo ' data-slick="{"draggable": false}" ';?>>

        <? if (have_rows('item')) {
            while (have_rows('item')) {
                the_row(); ?>
                <div class="cSlider__items <? if (get_row_layout() == 'kuula') echo 'no-before';?>">
                    <? if (get_row_layout() == 'image') {
                        ?>
                        <div class="cSlider__item cSlider__item--img">

                            <? if(get_sub_field('image')['caption']){ ?>
                                <div class="cSlider__caption">
                                    <?=get_sub_field('image')['caption']?>
                                </div>
                            <? }?>

                            <img class="cSlider__item__img" src="<?= get_sub_field('image')['url']
                                    ?>?<?= VER ?>" alt="">
                        </div>

                    <? } else if (get_row_layout() == 'video') { ?>
                        <div class="cSlider__item cSlider__item--video">
                            <video
                                    id="video__<?= rand() ?>"
                                    class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9 grafx-skin cSlider__item__video bigger-play darker-play"
                                    width="100%" height="100%" controls
                                    poster="<?= get_sub_field('video_first_frame') ?>?<?= VER ?>">
                                <source src="<?= get_sub_field('video') ?>" type='video/mp4'/>
                            </video>
                        </div>


                    <? } else if (get_row_layout() == 'kuula') { ?>
                        <div class="cSlider__item cSlider__item--kuula">
                            <iframe style="height: <?= get_sub_field('height') ?>px;" frameborder="0"
                                    scrolling="no" allowfullscreen="true"
                                    src="<?= get_sub_field('url') ?>"></iframe>
                        </div>


                    <? } ?>
                </div>
                <?
            }
        } ?>

    </div>
</div>

