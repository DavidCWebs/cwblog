<?php
/**
 * The Template for displaying all single posts.
 *
 * @package  Cwblog
 */

get_header(); ?>

<div class="main-content">	
	<div class="container">
		<div class="row">
			<div class="main-content-inner col-sm-12 col-md-8">
				

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

			<?php carawebs_simple_social(); ?>

		<?php cwblog_content_nav( 'nav-below' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>

	<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
