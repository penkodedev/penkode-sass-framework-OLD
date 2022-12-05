<?php get_template_part('/template-parts/doc-type'); ?>
<div id="single-product"><!-- /open grid wrapper -->
	
<div class="grid-header"><?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	get_header(  ); ?></div>
    
<main class="grid-main animate fadeIn" id="main-container">
    <article class="grid-article">
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        
<?php do_action( 'woocommerce_before_main_content' );?>              
<?php while ( have_posts() ) : the_post(); ?>
<?php wc_get_template_part( 'content', 'single-product' ); ?>
<?php endwhile; // end of the loop. ?>
        

<?php global $product;

if( ! is_a( $product, 'WC_Product' ) ){
    $product = wc_get_product(get_the_id());
}

woocommerce_related_products( array(
    'posts_per_page' => 4,
    'columns'        => 4,
    'orderby'        => 'rand'
) );?>
    
        
    </article>  
    
<nav id="nav-single">
			<div class="pag-previous"><?php previous_post_link( '%link', __( '&laquo; Anterior', 'foo' ) ); ?></div>
			<div class="pag-next"><?php next_post_link( '%link', __( 'Siguiente &raquo;', 'foo' ) ); ?></div>
</nav>
    
 </main>   
<?php get_footer(); ?>