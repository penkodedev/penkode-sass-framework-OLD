<?php
/*
Template Name: Index Full Width
*/
?>

<div id="home-full-col">
    <!-- /open grid wrapper -->
    <?php get_header();?>
            <div class="slider full-slider">
            <?php echo do_shortcode('[smartslider3 alias="homeslider"]'); ?>
        </div>
    <main>

        <article>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; else: ?>
            <?php endif; ?>
        </article>
    </main>
    <?php get_footer(); ?>
</div><!-- /close grid wrapper -->