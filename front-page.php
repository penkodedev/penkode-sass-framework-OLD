<?php get_template_part('/template-parts/doc-type');?>
<?php
/*
Template Name: Index Full Width
*/
?>
<div id="home-full-col"><!-- OPEN GRID / close on footer -->
	<?php get_header();?>

	<main class="grid-main animate fadeIn" id="main-container">
		<section class="section-01">
			<article id="article">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; else: ?>
				<?php endif; ?>
			</article>
		</section>

		<section class="section-02">
		<article id="article">
			<div class="post-grid">
			<?php query_posts(array(
				'post_type' => 'news',
				'has_archive' => true,
				'orderby'=> 'ASC',
				'paged'=>$paged, )); ?>

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="post-full col-3">
						<div class="grid-item">
							<figure><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('large'); ?></a>
							</figure>
							<div class="grid-item-content">
								<h5>
									<?php the_title(); ?>
								</h5>
								<p class="grid-item-excerpt">
									<?php echo excerpt('22'); ?>
								</p>
								<a class="button" href="<?php the_permalink(); ?>"><?php _e('leer más', 'foo' ); ?></a>
							</div>
						</div>
					</div>
					<?php endwhile; else: ?>
					<?php endif;
			wp_reset_query();?>
				</div>
			</article>
		</section>

		<?php get_template_part ('/template-parts/carousel'); ?>

		<section class="section-03">
			<article id="article">

			</article>
		</section>
	</main>
	<?php get_footer(); ?>