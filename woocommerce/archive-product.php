<?php get_template_part('/template-parts/doc-type'); ?>
<div id="grid-page-shop"><!-- OPEN GRID / close on footer -->

<div class="grid-header"><?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	get_header(  ); ?></div>
	
	<section class="page-title">
         <div class="page-title-container"><h1>Shop</h1></div>
    </section>
	
		
<!-- Modal BEGIN -->
         <span id="modal-open"></span>
         <div id="modal-window" class="modal">
             <div class="modal-content  animate fadeInRight">
                 <span class="modal-close">&times;</span>
                 <?php echo do_shortcode ('[wcpf_filters id="242"]'); ?>
             </div>
         </div>
<!-- Modal END -->
	
	
	 <main class="grid-main animate fadeIn" id="main-container">	 
        <article id="container" class="news secondady primary">
            <div class="mensaje-tienda"><?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Mensaje Tienda 02')) ?></div>
            <nav class="productos-meta">
                <?php echo do_shortcode("[product_categories_dropdown  hierarchical='1']"); ?>
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
    <?php get_footer( ); ?>


<script>
    // Get the modal
    var modal = document.getElementById("modal-window");

    // Get the button that opens the modal
    var btn = document.getElementById("modal-open");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("modal-close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>