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
if ($term_prev_index < 0) {
    $term_prev_index = $cat_num - 1;
}

$term_next_index = ($term_index + 1) % $cat_num;

function single_cat($i)
{
    global $cats;
    return $cats[$i]['category'];
}

?>

<div id="wrap" style="background-image: url(<?= $bg_image ? $bg_image : '' ?>)">
    <div class="inner__header">
        <div class="container">

            <ul class="cats">
                <li class="cats__nav cats__nav--prev">
                    <span class="cats__icon cats__icon--prev icon-l-arrow"></span>
                </li>
                <li class="cats__item">
                    <a href="<?= get_term_link(single_cat($term_prev_index)->term_id) ?>">
                        <?= single_cat($term_prev_index)->name ?>
                    </a>
                </li>
                <li class="cats__item">
                    <a href="<?= get_term_link(single_cat($term_index)->term_id) ?>">
                        <?= single_cat($term_index)->name ?>
                    </a>
                </li>
                <li class="cats__item">
                    <a href="<?= get_term_link(single_cat($term_next_index)->term_id) ?>">
                        <?= single_cat($term_next_index)->name ?>
                    </a>
                </li>
                <li class="cats__nav cats__nav--next">
                    <span class="cats__icon cats__icon--prev icon-l-arrow"></span>
                </li>
            </ul>

        </div>

    </div>

</div>
<?php get_footer(); ?>
