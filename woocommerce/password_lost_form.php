<?php get_template_part('/template-parts/doc-type'); ?>
<?php
/*
Template Name: Password Lost
*/
?>
<div id="grid-one-col">
	<!-- /open grid wrapper -->
	<?php get_header(); ?>
	<section class="page-title">
		<h1><?php the_title(); ?></h1>
	</section>
	<main class="animate fadeIn" id="main-container">
		<article id="container" class="news secondady primary">

			<div id="password-lost-form">
				<?php if ( $attributes['show_title'] ) : ?>
				<h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
				<?php endif; ?>

				<p>
				<?php _e( "Enter your email address and we'll send you a link you can use to pick a new password.", 'personalize_login'); ?>
				</p>

				<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
					<p class="form-row">
						<label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?> </label>
							<input type="text" name="user_login" id="user_login" />
					</p>

					<p class="lostpassword-submit">
						<input type="submit" name="submit" class="lostpassword-button" value="<?php _e( 'Reset Password', 'personalize-login' ); ?>" />
					</p>
				</form>
			</div>


		</article>
	</main>
	<?php get_footer(); ?>
</div><!-- /close grid wrapper -->