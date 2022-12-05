<?php get_template_part('/template-parts/doc-type');?>
<div id="grid-two-col"><!-- /open grid wrapper -->
     <?php get_header(); ?>
    <section class="page-title"><h1><?php _e( 'Blog', 'foo' ); ?></h1></section>
    <aside><?php get_sidebar(); ?></aside>
    
<main id="main-container">

    <article class="news secondady primary" id="container">
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        <div class="time"><?php the_time ('j/F/Y'); ?></div>
        
        <h1><?php the_title(); ?></h1>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; else: ?>
        <?php endif; ?>
        
        <?php get_template_part ('/template-parts/author'); ?>
    </article>
    
    <nav id="nav-single">
			<div class="pag-previous"><?php previous_post_link( '%link', __( '&laquo; Anterior', 'foo' ) ); ?></div>
			<div class="pag-next"><?php next_post_link( '%link', __( 'Siguiente &raquo;', 'foo' ) ); ?></div>
		</nav>
</main>
    </div><!-- /close grid wrapper -->
<?php get_footer(); ?>