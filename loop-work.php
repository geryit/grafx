<div class="works__item <?=get_field('case_study') ? 'works__item--case' : ''; ?>">
    <div class="works__inner"
         style="background-image: url(<?= get_field('main_image'); ?>)">
        <ul class="awardsTags">
            <? if (get_field('awards'))
                foreach (get_field('awards') as $m) { ?>
                    <li class="awardsTags__item"><?= $m ?></li>
                <? } ?>
        </ul>
        <span class="works__inner__cornerTitle"
              style="color: <?= get_field('corner_title_color'); ?>"><?= boldify(get_the_title()) ?></span>
        <div class="works__inner__items">
            <span class="works__inner__title"><?= boldify(get_the_title()) ?></span>
            <span
                class="works__inner__desc light"><?= get_field('short_description'); ?></span>
            <a href="<?= get_permalink() ?>"
               class="diagonalBtn works__inner__btn">
                <span>VIEW CASE</span>
            </a>
        </div>

    </div>

</div>
