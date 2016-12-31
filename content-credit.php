<? global $ver;?>

<div class="credits">
    <div class="container">
        <input type="checkbox" id="creditsToggle" class="credits__toggle dn">
        <label class="credits__header" for="creditsToggle">
            <h4 class="credits__header__title">View Credits</h4>
            <span class="credits__header__arrow icon-l-arrow2"></span>
        </label>

        <div class="credits__colsWrap">
            <ul class="credits__cols">
                <? if (have_rows('item')) {
                    while (have_rows('item')) {
                        the_row(); ?>
                        <li class="credits__col">
                            <h4 class="credits__title"><?= get_sub_field('title') ?></h4>
                            <ul class="credits__rows">
                                <?
                                if (get_sub_field('content'))
                                    foreach (get_sub_field('content') as $i => $v) { ?>
                                        <li class="credits__row">
                                            <b class="credits__rows__title light"><?= $v['title'] ?> :</b>
                                            <span class="credits__rows__body light"><?= $v['body'] ?></span>
                                        </li>
                                    <? } ?>
                            </ul>
                        </li>
                        <?
                    }
                } ?>

            </ul>
        </div>



    </div>
</div>

