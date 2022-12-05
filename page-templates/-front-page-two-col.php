<?php
/*
Template Name: Página Início
*/
?>

<div id="home-two-col"><!-- /open grid wrapper -->
    <?php get_header();?>
    <aside>
    <?php
if(is_front_page())
{
get_template_part('/template-parts/logo-container');
get_template_part('/template-parts/social');
}
else
{

}
?>
    </aside>
    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; else: ?>
        <?php endif; ?>
    </main>
    <?php get_footer(); ?>
</div><!-- /close grid wrapper -->