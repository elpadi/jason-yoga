<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<article>

		<?php if ( have_posts() ) : ?>

			<h1>Projects</h1>

			<div>
				
				<form data-url="<?php bloginfo('url'); ?>">
					<fieldset>
						<span>Search By: <a href="/projects-listing">All</a></span>
						<?php wp_dropdown_categories('orderby=title&order=ASC&child_of=3&taxonomy=projects_category&name=project-type'); ?>
						<?php wp_dropdown_categories('orderby=title&order=ASC&child_of=4&taxonomy=projects_category&name=state'); ?>
						<?php wp_dropdown_categories('orderby=title&order=ASC&child_of=5&taxonomy=projects_category&name=general-contractor'); ?>
					</fieldset>
				</form>
	    	</div>
			
			<ul>

			<?php while ( have_posts() ) : the_post();

			/* Get the Custom Fields of the Post */
			$custom_fields = get_post_custom();

			/* Set Location to a 'location' variable */
			if(count($custom_fields['location']) > 0){
				$location = $custom_fields['location'][0];
			} else {
				$location = "&nbsp;";
			}
			?>

				<li>
					<figure>
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail('thumbnail'); ?>
					<?php } ?>
					</figure>
					<div>
						<h2><?php the_title(); ?></h2>
						<span><?php echo $location; ?></span>
						<?php the_excerpt(); ?>
						<a class="viewProject" href="<?php the_permalink(); ?>">View Project File</a>
					</div>

			<?php endwhile; ?>

			</ul>

		<?php endif; ?>
		<?php
		/* Reset the Query */
		wp_reset_query();
		?>

		</article>
	</section><!-- #primary -->

<?php get_footer(); ?>