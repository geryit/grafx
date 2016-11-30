<style>
    .vjs-big-play-button{
        color: <?=hex2rgba(get_sub_field('play_button_color'), 0.7);?> !important;
    }
    .vjs-big-play-button:hover {
        color: <?=get_sub_field('play_button_color')?> !important;
    }
</style>
<div class="mainVideo">
    <video id="mainVideo__video__<?= rand() ?>"
           class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9 grafx-skin mainVideo__video"
           width="100%" height="100%" controls preload="none"
           poster="<?= get_sub_field('first_frame') ?>"
           data-setup='{}'>
        <source src="<?= get_sub_field('video') ?>" type='video/mp4'/>
    </video>
    <div class="awardsTagsWrap">
        <div class="container">
            <ul class="awardsTags">
                <? if (get_field('awards'))
                    foreach (get_field('awards') as $m) { ?>
                        <li class="awardsTags__item"><?= $m ?></li>
                    <? } ?>
            </ul>
        </div>
    </div>

</div>
