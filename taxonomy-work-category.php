<?php
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

$bg_image = $cats[$term_index]['background_image'];

$cat_num = count($cats);

$term_prev_index = $term_index - 1;
if ($term_prev_index < 0) $term_prev_index = $cat_num - 1;

$term_next_index = ($term_index + 1) % $cat_num;

function single_cat($i)
{
    global $cats;
    return $cats[$i]['category'];
}


if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';
?>

<div id="wrap">
    <div class="catsWrap" style="background-image: url(<?= $bg_image ? $bg_image : '' ?>)">
        <div class="container">

            <ul class="cats">
                <li class="cats__nav cats__nav--prev">
                    <a class="cats__icon cats__icon--prev icon-l-arrow2"
                       href="<?= get_term_link(single_cat($term_prev_index)->term_id) ?>"></a>
                </li>
                <li class="cats__item fx">
                    <a href="<?= get_term_link(single_cat($term_prev_index)->term_id) ?>"
                       class="cats__link light">
                        <?= single_cat($term_prev_index)->name ?>
                    </a>
                </li>
                <li class="cats__item">
                    <span class="cats__link light active">
                        <?= single_cat($term_index)->name ?>
                    </span>
                </li>
                <li class="cats__item fx">
                    <a class="cats__link light"
                       href="<?= get_term_link(single_cat($term_next_index)->term_id) ?>">
                        <?= single_cat($term_next_index)->name ?>
                    </a>
                </li>
                <li class="cats__nav cats__nav--next">
                    <a class="cats__icon cats__icon--next icon-r-arrow2"
                       href="<?= get_term_link(single_cat($term_next_index)->term_id) ?>"></a>
                </li>
            </ul>

        </div>

    </div>


    <div class="container">
        <div class="works works--orderBy-<?= $orderby ?> works--cats">
            <?

            $year_check = false;
            //            if($orderby == 'title') query_posts($query_string . '&orderby=title&order=ASC');
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $year = get_the_date('Y');
//                    $year_check = false;
                    // If your year hasn't been echoed earlier in the loop, echo it now
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
                                        <a href="<?= esc_url(add_query_arg(array('orderby' => 'title', 'order' => 'ASC'))) ?>"
                                           class='works__head__sortBtn'>A-Z</a>
                                    <?
                                    } ?>

                                    <? if ($orderby == 'date') { ?>
                                        <span class='works__head__sortBtn on'>DATE</span>
                                    <?
                                    } else { ?>
                                        <a href="<?= esc_url(add_query_arg(array('orderby' => 'date', 'order' => 'DESC'))) ?>"
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
<?php get_footer(); ?>
