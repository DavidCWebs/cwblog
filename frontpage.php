<?php
/**
 * Template Name: Custom Frontage Template
 *
 * @package  Cwblog
 */

get_header(); ?>

<div class="main-content">	
	<div class="container">
		<div class="row">
			<div class="main-content-inner col-sm-12 col-md-8">

	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php 
		
		# Get the page content template from the file content-frontpage.php
		get_template_part( 'content', 'frontpage' ); 
		
		?>
		
	<?php endwhile; // end of the loop. ?>
		
	<?php
 
    // WP_Query arguments
		$args = array (
			'post_type'              => 'course',
			'pagination'             => true,
			'posts_per_page'         => '10',
			'orderby'                => 'modified',
		);

		// The Query
		$custom_query = new WP_Query( $args );
    
    
    
    if ( $custom_query->have_posts() ):
		while ( $custom_query->have_posts() ) :
			$custom_query->the_post();

			?><div class="entry-summary">
				<div class="row">
					<div class="featured_image_container col-sm-4">
						<?php if ( has_post_thumbnail() ) 
						{
							?><a href ="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a><?php
							
						} 
						
						?>
					</div><!-- Image -->
			
					<div class="col-sm-8">
						<?php the_title( '<h3>', '</h3>' ); ?>
						<?php carawebs_custom_excerpt(); ?>
						
					</div><!-- Excerpt -->
					
		</div><!-- Row -->
		
	</div><!-- .entry-summary -->
	
	<?php

		endwhile;
	else:
		// Insert any content or load a template for no posts found.
	endif;

	wp_reset_query(); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
