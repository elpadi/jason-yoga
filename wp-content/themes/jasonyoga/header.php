<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-225604-2', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>

<!-- Header -->
<div class="header">

	<div class="logo">
	
		<a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a>
	
	</div>

	<div class="icons aligncenter">

		<a href="https://twitter.com/jason_crandell" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" /></a>
		<a href="https://www.facebook.com/JasonCrandellYoga" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" /></a>
		<a href="http://instagram.com/jason_crandell" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/instagram.png" /></a>
		<a href="http://www.pinterest.com/jasonyoga/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/pinterest.png" /></a>
	
	</div>

	<nav class="aligncenter">

		<?php

			$defaults = array(
				'theme_location'  => '',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'nav',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);

			wp_nav_menu( $defaults );

			?>

	</nav>

</div>