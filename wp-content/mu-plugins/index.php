<?php
/*
Plugin Name: Site Base Code
Plugin URI: https://github.com/elpadi/wordpress-library
Description: Base code for the website.
Version: 3.1.1
Author: Version Industries (v)
Author URI: http://versionindustries.com
License: MIT
*/

// Make sure we don't expose any info if called directly
if (!function_exists( 'add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

/**
 * Load dependencies
 * https://github.com/lstrojny/functional-php
 * https://github.com/matteosister/php-curry
 */
require(__DIR__.'/vendor/Functional/_import.php');
require(__DIR__.'/vendor/Curry/functions.php');

/**
 * Stop Contact Form 7 from printing useless assets
 */
define('WPCF7_LOAD_JS', false);
define('WPCF7_LOAD_CSS', false);

define('MU_PLUGIN_BASE_DIR', __DIR__);
spl_autoload_register(function($class) {
	is_file($path = __DIR__."/src/$class.php") && include($path);
});

add_action('init', array('JY', 'instance'));
add_action('wp_ajax_nopriv_content', array('PDL', 'ajaxContentResponse'));
add_action('wp_ajax_content', array('PDL', 'ajaxContentResponse'));
