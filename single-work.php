<?php
get_header();
$prev_post = get_adjacent_post( true, '', true, 'work-category' );
$next_post = get_adjacent_post( true, '', false, 'work-category' );
?>

<div id="wrap">
    <div class="workHead">
        <div class="container">
            <ul class="workHead__items">
                <li class="workHead__nav workHead__nav--prev">
                    <? if(isset($next_post->ID)){?>
                    <a class="workHead__icon workHead__icon--prev icon-l-arrow2"
                       href="<?php echo get_permalink( $next_post->ID ); ?>"></a>
                    <? }?>
                </li>
                <li class="workHead__item">
                    <span class="workHead__link light active">
                    <?=boldify(get_the_title())?>
                    </span>
                </li>
                <li class="workHead__nav workHead__nav--next">
                    <? if(isset($prev_post->ID)){?>
                    <a class="workHead__icon workHead__icon--next icon-r-arrow2"
                       href="<?php echo get_permalink( $prev_post->ID ); ?>"></a>
                    <?}?>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php get_footer(); ?>
