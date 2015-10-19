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
	<?php extract(JY::instance()->testimonials()); ?>
	<div class="contentwrapper">
		<h1>Testimonials</h1>
		<section id="featured-quote" class="quote-box">
			<ul class="quotes">
				<li><?php $quote = $featured[0]; include(__DIR__.'/inc/templates/quote.php'); ?></li>
			</ul>
		</section>
		<p class="jasons-quote"><?php echo $jason[0]->testimonial_quote; ?></p>
		<section id="main-quotes" class="content">
			<ul class="quotes">
				<?php foreach ($long as $quote): ?><li><?php include(__DIR__.'/inc/templates/quote.php'); ?></li><?php endforeach; ?>
			</ul>
		</section>
	</div>
	<section id="short-quotes" class="quote-box">
		<ul class="quotes">
			<?php foreach ($short as $quote): ?><li><?php include(__DIR__.'/inc/templates/quote.php'); ?></li><?php endforeach; ?>
		</ul>
	</section>
</div>

<?php get_footer(); ?>
