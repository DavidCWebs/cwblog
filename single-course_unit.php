<?php
/*
* Template Name: Custom Blogpost Template
* Description: This part is optional, but helpful for describing the Post Template
*/


get_header(); ?>

<div class="main-content">	
	<div class="container">
		<div class="row">
			<div class="main-content-inner col-12">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'course_unit' ); ?>

		<?php cwblog_content_nav( 'nav-below' ); ?>

	<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
