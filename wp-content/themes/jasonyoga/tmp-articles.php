<?php
/**
 * Template Name: Articles
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="backgroundwrapper">

<div class="contentwrapper">

	<div class="content">

		<?php 
		/* Query Most Recent */
		$query_mostrecent = new WP_Query('post_type=articles&posts_per_page=-1&order=DESC&orderby=date&articles_category=most-recent');

		/* Query Basics */
		$query_basics = new WP_Query('post_type=articles&posts_per_page=-1&order=DESC&orderby=date&articles_category=basics');

		/* Query Master Class */
		$query_masterclass = new WP_Query('post_type=articles&posts_per_page=-1&order=DESC&orderby=date&articles_category=master-class');

		/* Query Features */
		$query_features = new WP_Query('post_type=articles&posts_per_page=-1&order=DESC&orderby=date&articles_category=features');
		?>

		<?php if ( have_posts() ) : ?>

		<div class="col" data-sticky="sticky">

			<h1>Articles</h1>
			
			<ul class="categories">
				<li><a href="#" data-scroll="scroll" data-scrollto="most-recent">Most Recent</a></li>
				<li><a href="#" data-scroll="scroll" data-scrollto="basics">Basics</a></li>
				<li><a href="#" data-scroll="scroll" data-scrollto="master-class">Master Class</a></li>
				<li><a href="#" data-scroll="scroll" data-scrollto="features">Features</a></li>
			</ul>

		</div>

		<div class="col" data-content="content">

			<h3 data-anchor="most-recent">Most Recent</h3>
			
			<?php
			// Start the Loop.
			while ($query_mostrecent->have_posts()) : $query_mostrecent->the_post();

				// Include the page content template.
				get_template_part( 'content', 'article' );

			endwhile;
			?>

			<h3 data-anchor="basics">Basics</h3>
			
			<?php
			// Start the Loop.
			while ($query_basics->have_posts()) : $query_basics->the_post();

				// Include the page content template.
				get_template_part( 'content', 'article' );

			endwhile;
			?>

			<h3 data-anchor="master-class">Master Class</h3>
			
			<?php
			// Start the Loop.
			while ($query_masterclass->have_posts()) : $query_masterclass->the_post();

				// Include the page content template.
				get_template_part( 'content', 'article' );

			endwhile;
			?>

			<h3 data-anchor="features">Features</h3>
			
			<?php
			// Start the Loop.
			while ($query_features->have_posts()) : $query_features->the_post();

				// Include the page content template.
				get_template_part( 'content', 'article' );

			endwhile;
			?>
			
		</div>

		<?php endif; ?>

	</div>

</div>

</div>

<?php get_footer(); ?>