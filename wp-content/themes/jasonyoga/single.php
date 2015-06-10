<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="backgroundwrapper two-column">
	<div class="contentwrapper">
		<div class="content">

			<?php if ( have_posts() ) : ?>
				
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>
					<hr>
					<hr>
					<?php if (comments_open() || get_comments_number()) comments_template(); ?>
				<?php endwhile; ?>

			<?php endif; ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
