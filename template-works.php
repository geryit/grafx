<?php
/* Template Name: Works */
get_header();

$cats = get_field('categories', 'option');

$term_id = get_queried_object()->term_id;

//find index in acf list
foreach ($cats as $i => $v) {
    if ($v['category']->term_id == $term_id) {
        $term_index = $i;
        break;
    }
}

if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';
if (get_query_var('order')) $order = get_query_var('order'); else $order = 'DESC';

?>


<div id="wrap">
    <div class="headItemsWrap"
         style="background-image: url(<?= get_field('page_header_image') ?>?<?= VER ?>)">
        <div class="container">

            <ul class="headItems headItems--cats">
                <li class="headItems__item">
          <span class="headItems__link light active">
            ALL
          </span>
                </li>
                <?
                foreach ($cats as $cat) { ?>
                    <li class="headItems__item">
                        <a href="<?= get_term_link($cat['category']->term_id) ?>"
                           class="headItems__link light <?= $term_id == $cat['category']->term_id ? 'active' : '' ?>">
                            <?= $cat['category']->name ?>
                        </a>
                    </li>

                <? } ?>

            </ul>

        </div>

    </div>


    <div class="container">

        <? get_template_part('part', 'reels');?>

        <div class="works works--orderBy-<?= $orderby ?> works--cats">
            <?

            $year_check = false;
            $loop = new WP_Query(array('post_type' => 'work', 'posts_per_page' => -1, 'orderby' => $orderby, 'order' => $order,));
            if ($loop->have_posts()) {
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $year = get_the_date('Y');

                    if ($year !== $year_check) { ?>
                        <div class='works__head'>
                            <div class="works__head__inner container">
                                <div class="works__head__left">
                                    <h5 class='works__head__year'><?= $year ?></h5>
                                </div>
                                <div class="works__head__right">
                                    <h5 class='works__head__sortBy'>Sort by</h5>
                                    <? if ($orderby == 'title') { ?>
                                        <span class='works__head__sortBtn on'>A-Z</span>
                                        <?
                                    } else { ?>
                                        <a
                                                href="<?= esc_url(add_query_arg(array('orderby' => 'title', 'order' => 'ASC'))) ?>"
                                                class='works__head__sortBtn'>A-Z</a>
                                        <?
                                    } ?>

                                    <? if ($orderby == 'date') { ?>
                                        <span class='works__head__sortBtn on'>DATE</span>
                                        <?
                                    } else { ?>
                                        <a
                                                href="<?= esc_url(add_query_arg(array('orderby' => 'date', 'order' => 'DESC'))) ?>"
                                                class='works__head__sortBtn'>DATE</a>
                                        <?
                                    } ?>


                                </div>
                            </div>

                        </div>
                    <? }

                    // Now that your year has been printed, assign it to the $year_check variable
                    $year_check = $year;


                    get_template_part('loop', 'work');
                }
            }


            ?>
        </div>


    </div>
    <div class="pluses">
        <div class="container">
            <div class="pluses__inner"></div>
        </div>
    </div>
</div>

<? get_footer(); ?>
