
<?php
/*
Template Name: Página Dos Columnas
*/
?>
<div id="grid-two-col">
    <!-- /open grid wrapper -->
    <?php get_header(); ?>
     <section class="page-title"><h1><?php the_title(); ?></h1></section>
    <aside>
        <?php get_sidebar(); ?>
    </aside>

    <main id="main-container">
        <article id="container" class= "animate fadeIn one news secondady primary">
            <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; else: ?>
            <?php endif; ?>
        </article>
    </main>
    <?php get_footer(); ?>
</div><!-- /close grid wrapper -->