<?php

//******************** Create CPT SHORTCODE **************************
function news_shortcode()
{
  $args = array(
    'post_type' => 'news',
    'post_status' => 'publish'
  );
  $loop = new WP_Query($args); ?>
  <div class="testimonial-slider-wrap owl-carousel">
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
      <div class="post_column">
        <div class="post-thumbnail">
          <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
        </div>
        <div class="title">
          <h4><?php echo the_title(); ?></h4>
        </div>
        <div class="content">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php
  wp_reset_postdata();
}
add_shortcode('news', 'news_shortcode'); // given the CPT shortcode name

//******************** Add Post Type & Post Name to Body Class **************************
add_filter('body_class', 'add_post_class');
function add_post_class($classes)
{
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_type . ' ' . $post->post_name;
    
  }
  return $classes;
}