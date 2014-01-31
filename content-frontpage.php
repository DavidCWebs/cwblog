<?php
/**
 * The template used for displaying page content in frontpage.php
 *
 * @package  Cwblog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<!-- .entry-header -->
	<!--<header class="page-header">
		<h1 class="page-title">This is the Custom Title!!</h1>
	</header>-->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cwblog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<!--<?php edit_post_link( __( 'Edit', 'cwblog' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>-->
</article>
<hr><!-- #post-## -->
