<div class="main-carousel">
	<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$custom_query = new WP_Query(array(
		'post_type' => 'news',
		'has_archive' => true,
		'orderby' => 'ASC',
		'paged' => $paged,
	));

	if ($custom_query->have_posts()) :
		while ($custom_query->have_posts()) :
			$custom_query->the_post();
	?>
			<div class="carousel-cell">
				<figure><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('large'); ?></a>
				</figure>
				<div class="card-content">
					<a href="<?php the_permalink(); ?>" class="article-title"><?php the_title("<h4>", "</h4>") ?></a>
				</div>
			</div>
	<?php
		endwhile;
	else :
	// No posts found
	endif;

	// Reset post data
	wp_reset_postdata();
	?>
</div>

<script>
	var elem = document.querySelector('.main-carousel');
	var flkty = new Flickity(elem, {
		autoPlay: 1700, // number, true or false
		pauseAutoPlayOnHover: false,
		cellAlign: 'center',
		contain: true,
		prevNextButtons: true,
		pageDots: true,
		draggable: true,
		freeScroll: true,
		wrapAround: true,
	});

	// element argument can be a selector string
	//   for an individual element
	var flkty = new Flickity('.main-carousel', {
		// options
	});
</script>