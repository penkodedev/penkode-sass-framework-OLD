<?php get_template_part('/template-parts/doc-type');?>
<div id="grid-one-col"><!-- OPEN GRID / close on footer -->
	<div class="grid-header"><?php get_header(); ?></div>
	<section class="page-title">
		<h1><?php $post_type = get_post_type_object( get_post_type($post) ); echo $post_type->label ; ?></h1>
	</section>
	<main class="grid-main animate fadeIn" id="main-container">
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

		<section class="post-grid animate fadeIn one">
			<?php new WP_Query(array(
			'post_type' => 'news',
			'has_archive' => true,
            'orderby'=> 'ASC',
            'paged'=>$paged, )); ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="post-col post-full col-6">
				<!-- /change between col or full on main.scss -->
				<div class="grid-item">
					<figure><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('large'); ?></a>
					</figure>
					<div class="grid-item-content">
						<h5>
							<?php the_title(); ?>
						</h5>
						<time class="time">
							<?php the_time ('j/F/Y'); ?>
						</time>
						<p class="grid-item-excerpt">
							<?php echo excerpt('22'); ?>
						</p>
						<a class="button" href="<?php the_permalink(); ?>"><?php _e('leer más', 'foo' ); ?></a>
					</div>
				</div>
			</div>
			<?php endwhile; else: ?>
			<p class="no-post-msj"><?php _e('Lo sentimos, ninguna entrada coincide con tus criterios de búsqueda. Utilize el menú de la parte superior para navegar por nuestra web.', 'foo' ); ?></p>
			<?php endif; ?>

			<nav class="pagination">
				<?php echo paginate_links( ); ?>
			</nav>
		</section>
	</main>
	<?php get_footer(); ?>