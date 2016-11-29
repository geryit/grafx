<div class="imageVideoSet">
    <? if (have_rows('item')) {
        while (have_rows('item')) {
            the_row();
            if (get_row_layout() == 'image') {
                ?>
                <div class="imageVideoSet__item imageVideoSet__item--img">
                    <img class="imageVideoSet__img" src="<?= get_sub_field('image') ?>" alt="">
                </div>

            <? } else if (get_row_layout() == 'video') { ?>
                <div class="imageVideoSet__item imageVideoSet__item--video">
                    <video
                        id="imageVideoSet__video__<?=rand()?>"
                        class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9 grafx-skin bigger-play imageVideoSet__video"
                        width="100%" height="100%" loop autoplay
                        data-setup=''>
                        <source src="<?= get_sub_field('video') ?>" type='video/mp4'/>
                    </video>
                </div>


                <?
            }
        }
    } ?>


</div>
