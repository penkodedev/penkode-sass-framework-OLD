<?php get_template_part('/template-parts/doc-type');?>
<div id="grid-one-col"><!-- OPEN GRID / close on footer -->
	<div class="grid-header"><?php get_header(); ?></div>
	<section class="page-title">
		<div class="page-title-container">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<main class="grid-main animate fadeIn" id="main-container">
		<article class="grid-article">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; else: ?>
			<?php endif; ?>
		</article>
	</main>
	<?php get_footer(); ?>