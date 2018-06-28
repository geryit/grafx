<?php
/* Template Name: Insights */

get_header();

if (get_query_var('orderby')) $orderby = get_query_var('orderby'); else $orderby = 'date';
if (get_query_var('order')) $order = get_query_var('order'); else $order = 'DESC';
?>





<?php

$twitter_account = NULL;
$tweet_limit = 1;
$tweet_content_title = '';

if (have_rows('twitter_feed')) {

    while (have_rows('twitter_feed')) {
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
                    <span class="headItems__link light active">Insights</span>
                </li>
            </ul>

        </div>

    </div>


    <div class="container">


        <div class="insights insights--orderBy-<?= $orderby ?> ">

            <div class="insights--container">


                <div class="insights--side">
                    <div class="insights--side--left">

                        <?php // Display blog posts
                        $temp = $wp_query;
                        $wp_query = null;
                        $wp_query = new WP_Query(array('post_type' => 'insights', 'posts_per_page' => 3, 'orderby' => $orderby, 'order' => $order,));
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
            </div>

        </div>


    </div>
    <div class="pluses">
        <div class="container">
            <div class="pluses__inner"></div>
        </div>
    </div>
</div>

<? get_footer(); ?>
