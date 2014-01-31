<?php

/**
 * Template Name: Course Unit Template
 *
 * @package  Cwblog
 */
 
get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php cwblog_content_nav( 'nav-below' ); ?>

		<h1>No Comments!</h1>

	<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
