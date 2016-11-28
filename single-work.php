<?php
get_header();

$post_id = $post->ID;
$post_tax = get_post_taxonomies($post)[1];
$post_first_term = wp_get_post_terms($post->ID, $post_tax)[0]->slug;

$term = get_query_var('term', $post_first_term);

$args = array(
    'post_type' => get_post_type(),
    'tax_query' => array(
        array(
            'taxonomy' => get_post_taxonomies($post)[1],
            'field' => 'slug',
            'terms' => $term
        )
    )

);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $ids[] = $post->ID;
    }
    /* Restore original Post Data */
    wp_reset_postdata();
}

//printr($ids);

$thisindex = array_search($post_id, $ids);
if ($thisindex > 0) $previd = $ids[$thisindex - 1];
if ($thisindex < count($ids) - 1) $nextid = $ids[$thisindex + 1];

?>

<div id="wrap">
    <div class="workHead">
        <div class="container">
            <ul class="workHead__items">

                <li class="workHead__nav workHead__nav--prev">
                    <? if (isset($previd)) { ?>
                        <a class="workHead__icon workHead__icon--prev icon-l-arrow2"
                           href="<?= add_query_arg(array('term' => $term), get_permalink($previd)) ?>"></a>
                    <? } ?>
                </li>
                <li class="workHead__item">
                    <span class="workHead__head">BRAND & TITLE</span>
                    <span class="workHead__link light active">
                    <?= boldify(get_the_title()) ?>
                    </span>
                </li>
                <li class="workHead__nav workHead__nav--next">
                    <? if (isset($nextid)) { ?>
                        <a class="workHead__icon workHead__icon--next icon-r-arrow2"
                           href="<?= add_query_arg(array('term' => $term), get_permalink($nextid)) ?>"></a>
                    <? } ?>
                </li>
            </ul>
        </div>
    </div>

    <div class="workC">
        <?


        if (have_rows('content')) {

            // loop through the rows of data
            while (have_rows('content')) {
                the_row();

                if (get_row_layout() == 'main_video') {

                    if (have_rows('item')) {
                        while (have_rows('item')) {
                            the_row();
                            get_template_part('content', 'main_video');
                        }
                    }
                } elseif (get_row_layout() == 'full_width_text') {
                    if (have_rows('item')) {
                        while (have_rows('item')) {
                            the_row();
                            get_template_part('content', 'full_width_text');
                        }
                    }
                } elseif (get_row_layout() == 'image_video_set') {
                    get_template_part('content', 'image_video_set');

                } elseif (get_row_layout() == 'half_width_text') {
                    get_template_part('content', 'half_width_text');

                } elseif (get_row_layout() == 'slider') {
                    get_template_part('content', 'slider');

                }elseif (get_row_layout() == 'credit') {
                    get_template_part('content', 'credit');

                }

            }

        }
        ?>
    </div>

    <div class="pluses">
        <div class="container">
            <div class="pluses__inner"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
