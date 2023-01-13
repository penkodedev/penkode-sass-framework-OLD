<div class="author-container">
    <img><?php  echo get_avatar( get_the_author_meta($field ='user_email'), '80' ); ?></img>
    <div class="author-name"><?php _e( '', 'foo' ); ?> <?php the_author(); ?></div>
    <div class="author-desc"><?php get_the_author_meta($field = 'description'); ?></div>
</div>