<?php
/**
 * The Template for displaying all single posts
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
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<hr>

					<hr>

					<div class="pag">

						<?php next_post_link( '%link', '<span class="next">' . _x( 'Next', 'twentytwelve' ) . '</span>' ); ?>

						<?php previous_post_link( '%link', '<span class="previous">' . _x( 'Previous', 'twentytwelve' ) . '</span>' ); ?>

					</div>

					<?php if ( comments_open() || get_comments_number() ) {
						comments_template();
					} ?>

				<?php endwhile; ?>
		</div>
	</div>

</div>

<?php
get_footer();
