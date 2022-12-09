<?php

//******************* Woocommerce REMOVE category base *****************
add_filter('request', function( $vars ) {
global $wpdb;

if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
    $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
    $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
    if( $exists ){
        $old_vars = $vars;
        $vars = array('product_cat' => $slug );
        if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
            $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
        if ( !empty( $old_vars['orderby'] ) )
            $vars['orderby'] = $old_vars['orderby'];
        if ( !empty( $old_vars['order'] ) )
            $vars['order'] = $old_vars['order'];
    }
}
return $vars;
});
	


//*******************Woocommerce Logged status on body class *****************
add_filter('body_class','er_logged_in_filter');
function er_logged_in_filter($classes) {
if( is_user_logged_in() ) {
$classes[] = 'loggedin-product-class';
} else {
$classes[] = 'loggedout-product-class';
}
return $classes;
}

//*******************Woocommerce SHOW WEIGHT *****************
add_action ('woocommerce_single_product_summary', 'show_weight', 20);
function show_weight() {
global $product;
$weight_unit = get_option('woocommerce_weight_unit');
$attributes = $product->get_attributes();
if ( $product->has_weight() ) {
print '<p>Weight: '.$product->get_weight(). $weight_unit . '</p>'.PHP_EOL;
}
}

//*******************Woocommerce new text field on registration *****************
add_action( 'woocommerce_register_form', 'misha_add_register_form_field' );
function misha_add_register_form_field(){
 
	woocommerce_form_field(
		'nombre-empresa',
		array(
			'type'        => 'text',
			'required'    => false, // just adds an "*"
			'label'       => 'Nombre de la empresa',
            'placeholder'       => '',
		),
		( isset($_POST['nombre-empresa']) ? $_POST['nombre-empresa'] : '' )
	);
 
}
// Save on DDBB
add_action( 'woocommerce_created_customer', 'misha_save_register_fields' );
function misha_save_register_fields( $customer_id ){
	if ( isset( $_POST['nombre-empresa'] ) ) {
		update_user_meta( $customer_id, 'nombre-empresa', wc_clean( $_POST['nombre-empresa'] ) );
	}
}

//*******************Woocommerce new fields on registration *****************
add_action( 'woocommerce_register_form', 'bbloomer_extra_register_select_field' );
  
function bbloomer_extra_register_select_field() {
 ?>
  
<p class="form-row form-row-wide">
<select name="find_where" id="billing_postcode" />
    <option value="par">Particular</option>
    <option value="emp">Empresa</option>
</select>
</p>
  
<?php
    
}
  
// 2. Save field on Customer Created action
  
add_action( 'woocommerce_created_customer', 'bbloomer_save_extra_register_select_field' );
   
function bbloomer_save_extra_register_select_field( $customer_id ) {
if ( isset( $_POST['find_where'] ) ) {
        update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}
  
// 3. Display Select Field @ User Profile (admin) and My Account Edit page (front end)
   
add_action( 'show_user_profile', 'bbloomer_show_extra_register_select_field', 30 );
add_action( 'edit_user_profile', 'bbloomer_show_extra_register_select_field', 30 ); 
add_action( 'woocommerce_edit_account_form', 'bbloomer_show_extra_register_select_field', 30 );
   
function bbloomer_show_extra_register_select_field($user){ 
    
  if (empty ($user) ) {
  $user_id = get_current_user_id();
  $user = get_userdata( $user_id );
  }
    
?>    
        
<p class="form-row form-row-wide">

<select name="find_where" id="find_where" />
    <option disabled value> -- Seleccionar una opción -- </option>
    <option value="par" <?php if (get_the_author_meta( 'find_where', $user->ID ) == "par") echo 'selected="selected" '; ?>>Particular</option>
    <option value="emp" <?php if (get_the_author_meta( 'find_where', $user->ID ) == "emp") echo 'selected="selected" '; ?>>Empresa</option>
</select>
</p>
  
<?php
  
}

// 4. Save User Field When Changed From the Admin/Front End Forms
   
add_action( 'personal_options_update', 'bbloomer_save_extra_register_select_field_admin' );    
add_action( 'edit_user_profile_update', 'bbloomer_save_extra_register_select_field_admin' );   
add_action( 'woocommerce_save_account_details', 'bbloomer_save_extra_register_select_field_admin' );
   
function bbloomer_save_extra_register_select_field_admin( $customer_id ){
if ( isset( $_POST['find_where'] ) ) {
   update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}

//*******************Woocommerce just one city *****************
add_filter('woocommerce_states', 'lista_provincias');
function lista_provincias( $provincias ) {
$provincias ['ES'] = array(
'M' => 'Madrid'
); //CODIGO Y NOMBRES DE PROVINCIAS DISPONIBLES

return $provincias;

}

//*******************Woocommerce change BUY NOW button text *****************
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' ); //on shop and others pages
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Al Carrito', 'woocommerce' );
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text'); //on single page
 
function woo_custom_cart_button_text() {
return __('Al Carrito', 'woocommerce');
}


//*************************Woocommerce Empty Cart Button ********************
add_action( 'wp_loaded', 'custom_woocommerce_empty_cart_action', 20 );
function custom_woocommerce_empty_cart_action() {
	if ( isset( $_GET['empty_cart'] ) && 'yes' === esc_html( $_GET['empty_cart'] ) ) {
		WC()->cart->empty_cart();

		$referer  = wp_get_referer() ? esc_url( remove_query_arg( 'empty_cart' ) ) : wc_get_cart_url();
		wp_safe_redirect( $referer );
	}
    
//*************************Woocommerce Empty Cart Button TEXT ********************
add_action( 'woocommerce_cart_coupon', 'custom_woocommerce_empty_cart_button' );
function custom_woocommerce_empty_cart_button() {
	echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="link-vaciar" title="' . esc_attr( 'Vaciar el carrito', 'woocommerce' ) . '">' . esc_html( 'Vaciar el Carrito', 'woocommerce' ) . '</a>';
}
}
//*************************Woocommerce Add Category Dropdown Shortcode ********************
add_shortcode( 'product_categories_dropdown', 'woo_product_categories_dropdown' );
function woo_product_categories_dropdown( $atts ) {
    
    // Attributes
    $atts = shortcode_atts( array(
        'hierarchical' => '0', // or '1'
        'hide_empty'   => '0', // or '1'
        'show_count'   => '0', // or '1'
        'depth'        => '2', // or Any integer number to define depth
        'orderby'      => 'order', // or 'name'
    ), $atts, 'product_categories_dropdown' );

    ob_start();

    wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_shortcode_dropdown_args', array(
        'depth'              => $atts['depth'],
        'hierarchical'       => $atts['hierarchical'],
        'hide_empty'         => $atts['hide_empty'],
        'orderby'            => $atts['orderby'],
        'show_uncategorized' => 0,
        'show_count'         => $atts['show_count'],
    ) ) );

    ?>
    <script type='text/javascript'>
        jQuery(function($){
            var product_cat_dropdown = $(".dropdown_product_cat");
            function onProductCatChange() {
                if ( product_cat_dropdown.val() !=='' ) {
                    location.href = "<?php echo esc_url( home_url() ); ?>/?product_cat=" +product_cat_dropdown.val();
                }
            }
            product_cat_dropdown.change( onProductCatChange );
        });
    </script>
    <?php

    return ob_get_clean();
}


//*************************Woocommerce Order Tabs ********************
add_filter( 'woocommerce_product_tabs', 'reordered_tabs', 98 );
function reordered_tabs( $tabs ) {
    $tabs['description']['priority'] = 1;
    $tabs['reviews']['priority'] = 7;

    return $tabs;
}

//*************************Woocommerce RENAME Tabs ********************
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = __( 'Descripción' ); // Rename the description tab
    $tabs['additional_information']['title'] = __( 'Peso y Medidas' ); // Rename the aditional info tab
	return $tabs;
}

//******************* Remove the password strength meter *****************
add_action( 'wp_enqueue_scripts', 'misha_deactivate_pass_strength_meter', 10 );
function misha_deactivate_pass_strength_meter() {
 
	wp_dequeue_script( 'wc-password-strength-meter' );
 
}

//************************* Remove Tabs ********************
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    //unset( $tabs['detailed-information'] );      	// Remove the detailed information
    unset( $tabs['reviews'] ); 			            // Remove the reviews tab

    return $tabs;
}

//************************* Remove Breadcrumbs ********************
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

//************************* Remove Related ********************
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


//*************************Woocommerce Auto Complete cart when Quantity changes ********************
add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' ); 
 
function bbloomer_cart_refresh_update_qty() { 
   if (is_cart()) { 
      ?> 
      <script type="text/javascript"> 
         jQuery('').on('click', 'input.qty', function(){ 
            jQuery("[name='update_cart']").trigger("click"); 
         }); 
      </script> 
      <?php 
   } 
}

//*************************Woocommerce shop columns number ********************
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; // products per row
	}
}

//*************************Woocommerce change paypal button images ********************
function isa_extended_paypal_icon() {
     // picture of accepted credit card icons for PayPal payments
     return get_stylesheet_directory_uri() . '/images/paypal-payments.png';
}
add_filter( 'woocommerce_paypal_icon', 'isa_extended_paypal_icon' );