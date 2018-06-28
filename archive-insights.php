<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 *
 */

get_header();


if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';
if (get_query_var('order')) $order = get_query_var('order'); else $order = 'DESC';





/* Queue the first post, that way we know
 * what date we're dealing with (if that is the case).
 *
 * We reset this later so we can run the loop
 * properly with a call to rewind_posts().
 */
//if (have_posts())
//    the_post();
?>

<?php


$twitter_account = NULL;
$tweet_limit = 1;
$tweet_content_title = '';


$insights_page = get_page_by_path( 'insights');
$insights_page_id =$insights_page->ID;

if (have_rows('twitter_feed', $insights_page_id)) {

    while (have_rows('twitter_feed', $insights_page_id)) {
        the_row();

        if (get_row_layout() == 'twitter_settings') {
            $twitter_account =  get_sub_field('twitter_account');
            $tweet_limit = get_sub_field('tweet_limit');
            $tweet_content_title = get_sub_field('tweet_content_title');

        }
    }
}
?>

    <div id="wrap">
        <div class="headItemsWrap"
             style="background-image: url(<?= get_field('page_header_image') ?>?<?= VER ?>)">
            <div class="container">

                <ul class="headItems headItems--about">

                    <li class="headItems__item">
                        <span class="headItems__link light active">
                            Archive /
                            <?php
                            if (is_day()) :
                                printf(__('Daily Archives: %s', 'insights'), get_the_date());
                            elseif (is_month()) :
                                printf(__('Monthly Archives: %s', 'insights'), get_the_date('F Y'));
                            elseif (is_year()) :
                                printf(__('Yearly Archives: %s', 'insights'), get_the_date('Y'));
                            else :
                                _e('Blog Archives', 'insights');
                            endif;
                            ?>

                        </span>
                    </li>
                </ul>

            </div>

        </div>



        <div class="container">


            <div class="insights insights--orderBy-<?= $orderby ?>">

                <article class="insights--container">


                    <div class="insights--side">
                        <div class="insights--side--left">

                            <?php // Display blog posts
                            $temp = $wp_query;
                            $wp_query = null;
                            $wp_query = new WP_Query(array('post_type' => 'insights', 'posts_per_page' => 10, 'orderby' => $orderby, 'order' => $order,));
                            while ($wp_query->have_posts()) {
                                $wp_query->the_post();
                                get_template_part('loop', 'insights');
                            }
                            ?>

                            <nav id="nav-posts" class="nav-insights">
                                <div class="prev"><?php next_post_link('%link', '&laquo; Older Posts'); ?></div>
                                <div class="next"><?php previous_post_link('%link', 'Newer Posts &raquo;'); ?></div>
                            </nav>

                        </div>


                        <div class="insights--side--right">

                            <div>
                                <?php
                                echo do_shortcode( "[apss-share icon_set_value='2']" );
                                ?>
                            </div>



                            <h5>Categories</h5>
                            <div>
                                <?php
                                echo insights_category_nav();
                                ?>
                            </div>

                            <hr/>

                            <h5>Archives</h5>
                            <div>
                                <?php
                                insights_archive_nav();
                                ?>
                            </div>



                            <?php
                            if(!empty($twitter_account)){
                                ?>
                                <hr/>

                                <h5><?php echo $tweet_content_title;?></h5>
                                <div>
                                    <a class="twitter-timeline" data-chrome="nofooter noheaders"
                                       href="https://twitter.com/<?php echo $twitter_account;?>"
                                       data-tweet-limit="<?php echo $tweet_limit;?>">
                                        <?php echo $tweet_content_title;?></a>
                                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php wp_reset_postdata(); ?>
                </article>

            </div>


        </div>

    </div>


<?php get_footer(); ?>