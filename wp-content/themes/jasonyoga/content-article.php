<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php

$terms = get_the_terms($post->ID, 'articles_category');

foreach ( $terms as $term ) {

	$output .= "" . $term->slug . " ";

}

?>

<div class="mediabox <?php echo $output; ?>">
	
	<figure class="col">
		<?php the_post_thumbnail('full'); ?> 
	</figure>

	<div class="col">
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>

</div>