<?php
/*
Template Name: Page Featured Image
*/
?>

<div id="grid-one-col">
    <!-- /open grid wrapper -->
    <?php get_header(); ?>

    <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
    <section class="page-title" style="background: url('<?php echo $backgroundImg[0]; ?>') repeat;"><h1><?php the_title(); ?></h1></section>
    

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