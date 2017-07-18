<div class="reelsContainer">
    <h5 class="reelsContainer__head "><?= get_field('reel_category_page_title', 'option'); ?></h5>

    <div class="reelsContainer__list">
        <?
        foreach (get_field('reels', 'option') as $pages) {
            $id = $pages['page']->ID;
            if($id) {?>
                <div class="works__item" ng-click="go('<?= get_permalink($id) ?>')">
                    <div class="works__inner"
                         style="background-image: url(<?= get_field('main_image', $id); ?>?<?= VER ?>)"><span
                                class="works__inner__cornerTitle"
                                style="color: <?= get_field('corner_title_color', $id); ?>"><?= get_field('reel_title', $id); ?></span>
                        <div class="works__inner__items"><span
                                    class="works__inner__title"><?= get_field('reel_title', $id); ?></span> <span
                                    class="works__inner__desc light"><?= get_field('short_description', $id); ?></span>
                            <a href="<?= get_permalink($id) ?>" class="diagonalBtn works__inner__btn">
                                <span><?= get_field('button_label', $id); ?></span> </a></div>
                    </div>
                </div>
            <? }}?>
    </div>



</div>
