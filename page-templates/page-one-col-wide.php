<?php
/*
Template Name: Page One Col Wide
*/
?>

<div id="grid-one-col-wide">
    <!-- /open grid wrapper -->
    <?php get_header(); ?>
     <section class="page-title"><h1><?php the_title(); ?></h1></section>

    <main id="main-container">
        <article class="news secondady primary" id="container">
            <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; else: ?>
            <?php endif; ?>
        </article>
    </main>
    <?php get_footer(); ?>
</div><!-- /close grid wrapper -->