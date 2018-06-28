<?php
/**
 * File name: single-insights.php
 * Created Date: 22.06.2018 13:01
 *
 * @copyright: 2018 bulent
 * @author: Bulent Kocaman <me@bulentkocaman.com>
 */


get_header(); ?>

    <div id="wrap">
        <div class="headItemsWrap"
             style="background-image: url(<?= get_field('page_header_image') ?>?<?= VER ?>)">
            <div class="container">

                <ul class="headItems headItems--about">

                    <li class="headItems__item">
                        <span class="headItems__link light active">

                            <?= boldify(get_the_title()) ?>

                        </span>
                    </li>
                </ul>

            </div>

        </div>

        <div class="container">
            <div class="insights insights--orderBy-<?= $orderby ?>">

                <article class="insights--container">

                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();

                        get_template_part('content', get_post_format());

                        ?>









                        <div class="insights--item">

                            <div class="workC">
                                <?


                                if (have_rows('content')) {

                                    // loop through the rows of data
                                    while (have_rows('content')) {
                                        the_row();
//        echo '<div>'.get_row_layout().'</div>';

                                        if (get_row_layout() == 'main_video') {

                                            if (have_rows('item')) {
                                                while (have_rows('item')) {
                                                    the_row();

                                                    get_template_part('content', 'main_video');

                                                }
                                            }

                                        }else if(get_row_layout() != 'main_video'){
                                            ?>

                                            <div class="insights--item--featured--image">
                                                <?php
                                                the_post_thumbnail('full');
                                                ?>
                                            </div>

                                            <?php
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

                                        } elseif (get_row_layout() == 'credit') {
                                            get_template_part('content', 'credit');

                                        } elseif (get_row_layout() == 'image_for_m') {
                                            get_template_part('content', 'image_for_mobile');

                                        }

                                    }

                                }else{
                                    ?>

                                    <div class="insights--item--featured--image">
                                        <?php
                                        the_post_thumbnail('full');
                                        ?>
                                    </div>

                                    <?php
                                }
                                ?>
                            </div>






                            <span class="insights--item--date">
                                <?php
                                the_date('F jS, Y', '', '');
                                ?>
                            </span>


                            <div class="insights--item--title">
                                <a href="<?= add_query_arg(array(), get_permalink()) ?>">
                                    <?= boldify(get_the_title()); ?>
                                </a>
                            </div>


                            <div class="insights--item--content">
                                <?php
                                the_content();
                                ?>
                            </div>


                            <div class="insights--item--foot">
<!--                                <p>-->
<!--                                    By <strong>--><?php //the_author(); ?><!--</strong>-->
<!--                                </p>-->
                                <p class="insights--item--tag">
                                    <?php echo get_the_tag_list('<strong>',', ','</strong>'); ?>
                                </p>

                                <p>
                                    <?php
                                    echo do_shortcode( "[apss-share icon_set_value='4']" );
                                    ?>
                                </p>
                            </div>
                        </div>





                        <hr class="insights--divider"/>

                        <nav id="nav-posts" class="nav-insights">
                            <div class="prev"><?php next_post_link('%link','&laquo; Older Posts'); ?></div>
                            <div class="next"><?php previous_post_link('%link', 'Newer Posts &raquo;'); ?></div>
                        </nav>



                        <?php


    /*                    // Previous/next post navigation.
                        the_post_navigation(array(
                            'next_text' => '<span class="next">' . __('Next:', 'insights') . '</span> ' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="prev">' . __('Previous:', 'insights') . '</span> ' .
                                '<span class="post-title">%title</span>',
                        ));*/

                        // End the loop.
                    endwhile;
                    ?>
                </article>
            </div>
        </div>






        <div class="pluses">
            <div class="container">
                <div class="pluses__inner"></div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>