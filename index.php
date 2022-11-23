<?php get_template_part('/template-parts/doc-type');?>
<div id="grid-one-col-wide">
    <!-- /open grid wrapper -->
    <?php get_header(); ?>
    <section class="page-title"><h1><?php _e( 'Magazine', 'panambi' ); ?></h1></section>

    <main>
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

        <section class="post-grid">
            
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="post-col col-4">
                <div class="grid-item">
                    <figure><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?></a>
                    </figure>
                    <div class="grid-item-content">
                        <h5>
                            <?php the_title(); ?>
                        </h5>
                        <p class="grid-item-excerpt">
                            <?php echo excerpt('24'); ?>
                        </p>

                        <a class="button" href="<?php the_permalink(); ?>"><?php _e('leer más', 'panambi' ); ?></a>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.', 'panambi' ); ?></p>
        <?php endif; ?>

            <nav class="pagination">
                <?php echo paginate_links( $args ); ?>
            </nav>

        </section>
    </main>
</div><!-- /close grid wrapper -->
<?php get_footer(); ?>