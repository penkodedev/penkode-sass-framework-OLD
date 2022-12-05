<?php get_template_part('/template-parts/doc-type');?>
<?php
/*
Template Name: Página Login
*/
?>

<div id="grid-login"><!-- /open grid wrapper -->
   <div class="grid-header"><?php get_header(); ?></div>
    <main class="grid-main animate fadeIn" id="main-container">
        <?php get_template_part('/template-parts/logo-container'); ?>

        <p><?php
if ( ! is_user_logged_in() ) { // Display WordPress login form:
    $args = array(
        'redirect' => admin_url(), 
        'form_id' => 'loginform',
        'label_username' => __( 'Nombre de usuario' ),
        'label_password' => __( 'Contraseña' ),
        'label_remember' => __( 'Recordarme' ),
        'label_log_in' => __( 'acceder' ),
        'remember' => true
    );
    wp_login_form( $args );
} else { 

    echo "Ya estás conectado al sistema, utilize uno de los enlaces abajo para la acción deseada.";
    echo "</br>";
    wp_loginout( home_url() );
    echo "  |  ";
    wp_register('', '');
}
?></p>
    </main>
    <?php get_footer(); ?>