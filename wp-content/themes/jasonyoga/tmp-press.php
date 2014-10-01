<?php
/**
 * Template Name: Press
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="backgroundwrapper">

<div class="contentwrapper">

	<div class="content">

		<h1>Press</h1>

		<div class="col"></div>

		<div class="col">

		<?php 
		/* Query Press */
		$query_press = new WP_Query('post_type=press&posts_per_page=5&order=ASC&orderby=date&paged='.$paged);
		?>

		<?php if ( have_posts() ) : ?>
			
			<?php
			// Start the Loop.
			while ($query_press->have_posts()) : $query_press->the_post();

				// Include the page content template.
				get_template_part( 'content', 'press' );

			endwhile;
			?>

		<?php endif; ?>

		</div>

		<hr>
		<hr>

		<div class="pag">
			<div class="next">
				<?php previous_posts_link( 'Next' ); ?>
			</div>
			<div class="previous">
				<?php next_posts_link( 'Previous', $query_press->max_num_pages ); ?>
			</div>
    	</div>

	</div>

</div>

</div>

<?php get_footer(); ?>