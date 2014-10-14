<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div id="secondary">
	<header>
		<img src="/wp-content/uploads/img-jason.jpg" alt="">
		<h3>About Jason</h3>
		<?php echo get_bloginfo( 'description', 'display' ); ?>
	</header>
	<hr>
	<hr>
	<section><?php get_search_form(); ?></section>
	<section>
		<h3>Categories</h3>
		<?php wp_list_cats(); ?>
	</section>
	<section>
		<h3>Archive</h3>
		<?php wp_get_archives('type=monthly'); ?>
	</section>
	<hr>
	<hr>
</div><!-- #secondary -->
