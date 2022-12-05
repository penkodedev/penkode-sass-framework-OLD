<?php get_template_part('/template-parts/doc-type');?>
<div id="Grid-One-Col"><!-- /open grid wrapper -->
     <?php get_header(); ?>
<div class="PageTitle">
        <h1>
            <?php the_title(); ?>
        </h1>
    </div>
<main id="MainContainer">

    <article id="ArticleContainer">
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; else: ?>
        <?php endif; ?>
    </article>
</main>
<?php get_footer(); ?>
    </div><!-- /close grid wrapper -->
