<?php
/**
 * Template Name: Course Unit Content
 * 
 * Called by single-course_unit
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
		
	<div class="entry-meta">
			<?php cwblog_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<div class="featured_image_container">
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				  the_post_thumbnail();
				} 
			?>
			<h1>Test</h1>
		</div>
			
		<?php the_content(); ?>
		
		<?php carawebs_simple_social(); ?>
		
		<div class="image_attribution">
			
			<p><?php the_field('image_attribution'); ?></p>
			
		</div>
		
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
