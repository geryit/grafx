<?php
get_header();
if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';

$allCats = new stdClass;
$allCats->term_id = -1;
$allCats->name = "All Categories";
$allCats->slug = "all-categories";

$cats = get_field('categories', 'option');
array_unshift($cats, array("category" => $allCats, "background_image" => $cats[0]['background_image']));
//printr(get_queried_object());

$term_id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : -1;

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

function single_cat($i){
    global $cats;
    return $cats[$i]['category'];
}

function get_term_url($i){
    $slug = $i ? single_cat($i)->slug : '';
    return esc_url(add_query_arg(array('work-category' => $slug)));
}

?>

<div id="wrap">
    <div class="headItemsWrap" style="background-image: url(<?= $bg_image ? $bg_image : '' ?>?<?=$ver?>)">
        <div class="container">

            <ul class="headItems">
                <li class="headItems__nav headItems__nav--prev">
                    <a class="headItems__icon headItems__icon--prev icon-l-arrow2"
                       href="<?= get_term_url($term_prev_index) ?>"></a>
                </li>
                <li class="headItems__item fx">
                    <a href="<?= get_term_url($term_prev_index) ?>"
                       class="headItems__link light">
                        <?= single_cat($term_prev_index)->name ?>
                    </a>
                </li>
                <li class="headItems__item">
                    <span class="headItems__link light active">
                        <?= single_cat($term_index)->name ?>
                    </span>
                </li>
                <li class="headItems__item fx">
                    <a class="headItems__link light"
                       href="<?= get_term_url($term_next_index) ?>">
                        <?= single_cat($term_next_index)->name ?>
                    </a>
                </li>
                <li class="headItems__nav headItems__nav--next">
                    <a class="headItems__icon headItems__icon--next icon-r-arrow2"
                       href="<?= get_term_url($term_next_index) ?>"></a>
                </li>
            </ul>

        </div>

    </div>


    <div class="container">
        <div class="works works--orderBy-<?= $orderby ?> works--cats">
            <?

            $i = 0;
            if (have_posts()) {
                while (have_posts()) {
                    the_post();

                    if (!$i) {
                        ?>
                        <div class='works__head'>
                            <div class="works__head__inner container">
                                <div class="works__head__left">
                                    <h5 class='works__head__keyword'>
                                        <?php printf(__('Search results for: <b>"%s"</b>', 'shape'), '<span>' . get_search_query() . '</span>'); ?>
                                    </h5>
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
                        <?
                    }
                    get_template_part('loop', 'work');
                    $i++;
                }
            } else {
                ?>
                No results!
                <?
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
