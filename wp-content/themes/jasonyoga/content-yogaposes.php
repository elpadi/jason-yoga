<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<h1><?php the_title(); ?></h1>
<?php the_content(); ?>

<?php wp_related_posts()?>

