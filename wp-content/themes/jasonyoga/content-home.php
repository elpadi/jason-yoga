<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php the_content(); ?>

<div class="backgroundwrapper">

	<div class="stageimg carousel">
		<?php echo do_shortcode('[home_slideshow]'); ?>
		<script id="slideshow-template" type="text/x-handlebars-template">
			<ul>
				{{#each slides}}
					<li data-index="{{id}}">
						<img src="{{image}}">
						<div class="overlay">
							<h1>{{headline}}</h1>
							<h2>{{firstSubHeadline}}
							{{#if secondSubHeadline}}
								<br>{{secondSubHeadline}}
							{{/if}}
							</h2>
							<a href="{{href}}">{{buttonText}} &gt;</a>
						</div>
					</li>
				{{/each}}
			</ul>
		</script>
	</div>

</div>