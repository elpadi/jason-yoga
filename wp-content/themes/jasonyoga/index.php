<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="backgroundwrapper">
	<div class="contentwrapper">
		<div class="content">

			<?php if ( have_posts() ) : ?>
				
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

					<header>
						<p class="metadata gray-text"><?php the_date(); ?> by <span class="red-text"><?php the_author(); ?></span></p>
						<h1><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
					</header>

					<?php the_content(); ?>

					<?php the_tags( '<footer class="entry-meta" style="padding: 40px 0 0; color: #cc303a;"><span class="tag-links">', ', ', '</span></footer>' ); ?>

					<?php
						 comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
					?>

					<a class="add-comment" href="<?php the_permalink(); ?>">Add Your Own</a>

					<?php wp_related_posts()?>

					<hr>
					<hr>

				<?php endwhile; ?>

			<?php endif; ?>

			<div class="pag">
				<div class="next">
					<?php previous_posts_link( 'Next' ); ?>
				</div>
				<div class="previous">
					<?php next_posts_link( 'Previous', $query_press->max_num_pages ); ?>
				</div>
			</div>

		</div>
		<aside id="main-sidebar">
			<?php echo 'sidebar';//sidebar ?>
		</aside>
	</div>
</div>

<?php get_footer(); ?>
