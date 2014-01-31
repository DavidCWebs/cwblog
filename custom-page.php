<?php
/**
 * Template Name: Custom Page Template One
 *
 * @package  Cwblog
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
	
	<h1>CUSTOM PAGE TEMPLATE</h1>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>

	<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
