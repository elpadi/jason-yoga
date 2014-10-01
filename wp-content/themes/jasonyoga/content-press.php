<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<div class="mediabox">
	
	<figure class="col">
		<?php the_post_thumbnail('full'); ?> 
	</figure>

	<div class="col">
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>

</div>