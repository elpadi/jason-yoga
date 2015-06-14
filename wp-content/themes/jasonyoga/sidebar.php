<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<aside id="main-sidebar">
	<header>
		<img src="<?php echo WP_CONTENT_URL; ?>/uploads/img-jason-closeup.jpg" alt="">
		<h2>About Jason</h2>
		<?php echo get_bloginfo( 'description', 'display' ); ?>
	</header>
	<hr>
	<hr>
	<section><?php get_search_form(); ?></section>
	<section>
		<h2>Categories</h2>
		<ul><?php wp_list_cats(); ?></ul>
	</section>
	<section>
		<h2>Most Popular</h2>
		<ul>
			<?php foreach (get_posts('orderby=comment_count&order=DESC') as $post): ?>
			<li><a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</section>
	<hr>
	<hr>
</aside>
