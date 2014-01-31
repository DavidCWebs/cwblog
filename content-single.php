<?php
/**
 * @package  Cwblog
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
				  the_post_thumbnail('full');
				} 
			?>
		</div>
			
		<?php the_content(); ?>
		
		<?php if(get_field('images')):
 
 
				while(has_sub_field('images')): ?>
							
						  <img class="project_images" src ="<?php echo get_sub_field('image'); ?>"title=""><?php
					
				endwhile;
			 
				 
				endif; ?>
			
		
		<div class="image_attribution">
			
			<p><?php the_field('image_attribution'); ?></p>
			
		</div>
		
		<?php $posts = get_field('related_posts');
 
		if( $posts ): //only displays if field has a value
		 
			  ?><h2>Related Articles</h2>
		 
			  <div id ="relgrid">
		 
					<?php foreach( $posts as $post_object): ?>
					
					<div class="brick">
					<div class="overlay_container">
						<a href="<?php echo get_permalink($post_object->ID); ?>" class="img_hover"><?php echo get_the_post_thumbnail($post_object->ID, 'thumbnail'); ?></a>
					
					<div class="overlay">
						<h4 class="headline overlay_headline"><a href="<?php echo get_permalink($post_object->ID); ?>" title="View the project" ><?php echo get_the_title($post_object->ID); ?></a></h4>
						<div class="post_content post_excerpt overlay_excerpt"><p><?php
						
						// Build the excerpts	
						$current_post = get_post($post_object->ID);
						$current_excerpt = $current_post->post_excerpt; //assigns the manual excerpt for this post to the variable $current_excerpt...
						if ($current_excerpt !="") {
							echo $current_excerpt; // ...if this is not empty, return the value to display the manual excerpt
							}
						else { // if it is empty...
							$content = $current_post->post_content; //...get the content...
							$auto_excerpt = substr($content, 0, 150); //...and create an excerpt by limiting the number of characters
							echo $auto_excerpt; // print out the DIY auto excerpt
							}
						?></p>
						
						</div><!--overlay_excerpt-->
			</div><!--overlay-->
			</div><!--overlay_container-->
				</div>
				
				<?php endforeach; ?>
		 
			<!-- Add a break container-->
			<div class="gridbreak"></div>
			<div class="gridbreak"></div>
		 
			  </div><!--grid-->
 
		<?php endif;
		
		//<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cwblog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
