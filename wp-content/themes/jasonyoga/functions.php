<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	add_post_type_support( 'attachment', 'page-attributes' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri(), array( 'genericons' ) );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style', 'genericons' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'twentyfourteen' ),
			'nextText' => __( 'Next', 'twentyfourteen' )
		) );
	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}


add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link($link) {
	return preg_replace('/(<a.*>)(.*)(<\/a>)/', '$1Read More &gt; &gt;$3', $link);
}

/*
 * JSG SHORTCODES ------------------
 */



/**
 * JSG
 *
 * Creates a list of CSS files to only display on the pages needed.
 */
function page_specific_css() {
    
    /* Homepage CSS */
    if ( is_page( 'home' ) ) {

        wp_register_style( 'home_css', get_template_directory_uri().'/css/home.css' );
        wp_enqueue_style( 'home_css' );

    } else {

    	wp_register_style( 'content_css', get_template_directory_uri().'/css/content.css' );
        wp_enqueue_style( 'content_css' );

    }

    wp_register_style( 'responsive_css', get_template_directory_uri().'/css/responsive.css' );
        wp_enqueue_style( 'responsive_css' );

}
add_action( 'wp_enqueue_scripts', 'page_specific_css' );


/**
 * JSG
 *
 * Adds JS only to pages that need it.
 */
function page_specific_js() {

	/* Global Scripts */
	wp_register_script( 'scripts_js', get_template_directory_uri().'/js/scripts.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'scripts_js' );

	/* Home Page */
	if ( is_page( 'home' ) ) {

		/* Local Script */
		wp_register_script( 'homeconfig_js', get_template_directory_uri().'/js/home.config.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'homeconfig_js' );

		/* Local Script */
		wp_register_script( 'handlebars_js', get_template_directory_uri().'/js/handlebars.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'handlebars_js' );

		/* Local Script */
		wp_register_script( 'carousel_js', get_template_directory_uri().'/js/carousel.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'carousel_js' );

	}

	/* Article Listing */
	if ( is_page( 'article-listing' ) ) {

		/* Local Script */
		wp_register_script( 'scrollto_js', get_template_directory_uri().'/js/scrollto.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'scrollto_js' );

		/* Local Script */
		wp_register_script( 'sticky_js', get_template_directory_uri().'/js/sticky.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'sticky_js' );

	}

}

add_action( 'wp_enqueue_scripts', 'page_specific_js' );



/* JSG Gallery Shortcode */

add_shortcode('jsg_gallery', 'jsg_gallery_shortcode');

function jsg_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		if ( ! empty( $link ) && 'file' === $link )
			$image_output = wp_get_attachment_link( $id, $size, false, false );
		elseif ( ! empty( $link ) && 'none' === $link )
			$image_output = wp_get_attachment_image( $id, $size, false );
		else
			$image_output = wp_get_attachment_link( $id, $size, true, false );

		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) )
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}

/**
 * The Home Slideshow shortcode by JSG
 *
 * Overrides the default gallery.
 *
 */

add_shortcode('home_slideshow', 'home_slideshow_shortcode');

function home_slideshow_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'li',
		'size'       => 'full',
		'include'    => '',
		'exclude'    => '',
		'captiontag' => 'p'
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_image($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'li';

	$script_tag = "<script type='text/javascript'>var gallery = { 'slides': [";
	$output = $script_tag;

	$i = 0;
	$k = 0;

	foreach ( $attachments as $id => $attachment ) {
		$k++;
	}

	foreach ( $attachments as $id => $attachment ) {
		$i++;
		$link = wp_get_attachment_image_src($id, $size, false, false);

		if($i != $k) {
		
			$output .= "{ 'image':'$link[0]' },";
		
		} else {

			$output .= "{ 'image':'$link[0]' }";
		
		}
		
	}

	$output .= "]};</script>\n";

	return $output;
}



/* JSG Column Shortcode */

add_shortcode( 'column', 'column_shortcode' );

function column_shortcode( $atts, $content = null ) {

	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	return '<div class="col">' . do_shortcode($content) . '</div>';
}

/*
 * Usage:
 *
 * [column]
 * Content inside of first column
 * [/column]
 *
 * [column]
 * Content inside of second column
 * [/column]
 * 
 */



/* JSG Blue Box Shortcode */

add_shortcode( 'bluebox', 'bluebox_shortcode' );

function bluebox_shortcode( $atts, $content = null ) {

	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	return '<div class="bluebox">' . do_shortcode($content) . '</div>';

}

/*
 * Usage: [bluebox]Content inside of a blue box[/bluebox]
 */



/* JSG Media Box Shortcode */

add_shortcode( 'mediabox', 'mediabox_shortcode' );

function mediabox_shortcode( $atts, $content = null ) {

	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	return '<div class="mediabox">' . do_shortcode($content) . '</div>';
}



/* JSG Media Column Shortcode */

add_shortcode( 'mediacol', 'mediacol_shortcode' );

function mediacol_shortcode( $atts, $content = null ) {

	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	return '<div class="col">' . do_shortcode($content) . '</div>';

}

/*
 * Usage:
 * [mediabox]
 *
 * [mediacol]
 * <img src="poster.jpg" />
 * [/mediacol]
 *
 * [mediacol]
 * Some text about things and a button [button_register]
 * [/mediacol]
 * 
 * [/mediabox]
 */



/* JSG Register Button Shortcode */

add_shortcode( 'button_register', 'btn_register_shortcode' );

function btn_register_shortcode( $atts ) {
    
    extract(shortcode_atts(array(
		'href' => '/contact-us'
	), $atts));

    return '<a class="register ir" href="' . $href . '" target="_blank">Register Now</a>';
}

/*
 * Usage: [button_register href="http://google.com"]
 */



/* JSG Email Button Shortcode */

add_shortcode( 'button_email', 'btn_email_shortcode' );

function btn_email_shortcode( $atts ) {
    
    extract(shortcode_atts(array(
		'href' => '/contact-us'
	), $atts));

    return '<a class="email ir" href="' . $href . '" target="_blank">Email Jason</a>';
}

/*
 * Usage: [button_email href="mailto:jasonyoga@email.com"]
 */



/* JSG Find Workshop Button Shortcode */

add_shortcode( 'button_workshop', 'btn_workshop_shortcode' );

function btn_workshop_shortcode( $atts ) {
    
    extract(shortcode_atts(array(
		'href' => '/contact-us'
	), $atts));

    return '<a class="workshop ir" href="' . $href . '" target="_blank">Find a Workshop</a>';
}

/*
 * Usage: [button_workshop href="http://google.com"]
 */



/* JSG Download PDF Button Shortcode */

add_shortcode( 'button_download', 'btn_download_shortcode' );

function btn_download_shortcode( $atts ) {
    
    extract(shortcode_atts(array(
		'href' => '/contact-us'
	), $atts));

    return '<a class="download ir" href="' . $href . '" target="_blank">Download PDF</a>';
}

/*
 * Usage: [button_workshop href="http://google.com"]
 */



/* JSG Download PDF Button Shortcode */

add_shortcode( 'button_article', 'btn_article_shortcode' );

function btn_article_shortcode( $atts ) {
    
    extract(shortcode_atts(array(
		'href' => '/contact-us'
	), $atts));

    return '<a class="readArticle ir" href="' . $href . '" target="_blank">Read Article</a>';
}

/*
 * Usage: [button_article href="http://google.com"]
 */



/*
 * Custom Post Type Articles
 */

function my_custom_post_articles() {
	$labels = array(
		'name'               => _x( 'Articles', 'post type general name' ),
		'singular_name'      => _x( 'Article', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Article' ),
		'add_new_item'       => __( 'Add New Article' ),
		'edit_item'          => __( 'Edit Article' ),
		'new_item'           => __( 'New Article' ),
		'all_items'          => __( 'All Articles' ),
		'view_item'          => __( 'View Article' ),
		'search_items'       => __( 'Search Articles' ),
		'not_found'          => __( 'No Articles found' ),
		'not_found_in_trash' => __( 'No Articles found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Article'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our articles and article specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'articles', $args );	
}
add_action( 'init', 'my_custom_post_articles' );

function my_taxonomies_articles() {
	$labels = array(
		'name'              => _x( 'Article Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Article Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Article Categories' ),
		'all_items'         => __( 'All Article Categories' ),
		'parent_item'       => __( 'Parent Article Category' ),
		'parent_item_colon' => __( 'Parent Article Category:' ),
		'edit_item'         => __( 'Edit Article Category' ), 
		'update_item'       => __( 'Update Article Category' ),
		'add_new_item'      => __( 'Add New Article Category' ),
		'new_item_name'     => __( 'New Article Category' ),
		'menu_name'         => __( 'Article Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'articles_category', 'articles', $args );
}
add_action( 'init', 'my_taxonomies_articles', 0 );



/*
 * Custom Post Press
 */

function my_custom_post_press() {
	$labels = array(
		'name'               => _x( 'Press', 'post type general name' ),
		'singular_name'      => _x( 'Press', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Press' ),
		'add_new_item'       => __( 'Add New Press' ),
		'edit_item'          => __( 'Edit Press' ),
		'new_item'           => __( 'New Press' ),
		'all_items'          => __( 'All Press' ),
		'view_item'          => __( 'View Press' ),
		'search_items'       => __( 'Search Press' ),
		'not_found'          => __( 'No Press found' ),
		'not_found_in_trash' => __( 'No Press found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Press'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our press and press specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'press', $args );	
}
add_action( 'init', 'my_custom_post_press' );

function my_taxonomies_press() {
	$labels = array(
		'name'              => _x( 'Press Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Press Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Press Categories' ),
		'all_items'         => __( 'All Press Categories' ),
		'parent_item'       => __( 'Parent Press Category' ),
		'parent_item_colon' => __( 'Parent Press Category:' ),
		'edit_item'         => __( 'Edit Press Category' ), 
		'update_item'       => __( 'Update Press Category' ),
		'add_new_item'      => __( 'Add New Press Category' ),
		'new_item_name'     => __( 'New Press Category' ),
		'menu_name'         => __( 'Press Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'press_category', 'press', $args );
}
add_action( 'init', 'my_taxonomies_press', 0 );



function wpsites_modify_comment_form_fields($fields){
    
	$fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( '', 'jasonyoga.com' ) . '</label> ' . 
	
	( $req ? '<span class="required">*</span>' : '' ) .
                    
	'<input id="author" name="author" type="text" placeholder="Name" value="' . 
					
	esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
					
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __( '', 'jasonyoga.com' ) . '</label> ' .
    
	( $req ? '<span class="required">*</span>' : '' ) .
    
	'<input id="email" name="email" type="text" placeholder="Email Address" value="' . 
	
	esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
	
	$fields['url'] = '<p class="comment-form-url"><label for="url">' . __( '', 'jasonyoga.com' ) . '</label>' .
    
	'<input id="url" name="url" type="text" placeholder="Website" value="' . 
	
	esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
	
    return $fields;
}
 
add_filter('comment_form_default_fields','wpsites_modify_comment_form_fields');

function my_update_comment_field($comment_field) {
 
    $comment_field = 
        '<p class="comment-form-comment">
            <textarea required placeholder="Your Message…" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';
 
    return $comment_field;
}
add_filter('comment_form_field_comment','my_update_comment_field');


/**
 * Overrides the default excerpt length.
 *
 */
function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Overrides the default excerpt more.
 *
 */
function new_excerpt_more( $more ) {
	return '... <a href="'. get_permalink( get_the_ID() ) . '">Continue Reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
