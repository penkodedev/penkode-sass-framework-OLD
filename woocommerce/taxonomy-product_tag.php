<?php get_template_part('/template-parts/doc-type'); ?>
<div id="grid-page-shop">    <!-- /open grid wrapper -->
    <?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(  ); ?>

    <section class="page-title">
        <h1 class="cat-title"><?php single_term_title(); ?></h1>
    </section>
    <main class="animate fadeIn" id="main-container">
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
            <article id="container" class="news secondady primary">

                <section class="mensaje-tienda">
                    <p><?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Mensaje Tienda')) ?></p>
                </section>

                <nav class="productos-meta">
                    <?php echo do_shortcode("[product_categories_dropdown]"); ?>
                    <?php do_action( 'woocommerce_before_shop_loop' ); //woocommerce ordering products ?>
                </nav>


                <?php if ( have_posts() ) : ?>

                <?php woocommerce_product_loop_start(); ?>
                <?php woocommerce_product_subcategories(); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <?php do_action( 'woocommerce_shop_loop' );?>
                <?php wc_get_template_part( 'content', 'product' ); ?>
                <?php endwhile; // end of the loop. ?>
                <?php woocommerce_product_loop_end(); ?>

                <?php do_action( 'woocommerce_after_shop_loop' );
			?>

                <?php elseif ( ! woocommerce_product_subcategories( array(
    'before' => woocommerce_product_loop_start( false ),
    'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php do_action( 'woocommerce_no_products_found' );?>

                <?php endif; ?>

            </article>
        </main>
        <?php get_footer(); ?>
</div> <!-- /close grid wrapper -->