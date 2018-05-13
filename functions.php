<?php
/**
 * LB Init.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package LB Init
 * @since 1.0.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

if ( ! function_exists( 'lb_init_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 1.0.0
	 */
	function lb_init_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'lb-init', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'lb-init' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		add_theme_support( 'post-formats', array(
		    'aside',
		    'gallery',
		    'link',
		    'image',
		    'quote',
		    'status',
		    'video',
		    'audio',
		    'chat'
		) );

		/**
		 * Support The Excerpt on pages.
		 */
		add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since 1.0.0
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );
	}
}

add_action( 'after_setup_theme', 'lb_init_setup_features' );

/**
 * Register widget areas.
 *
 * @since 1.0.0
 */
function lb_init_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'lb-init' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'lb-init' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'lb_init_widgets_init' );

/**
 * Load site scripts.
 *
 * @since 1.0.0
 */
function lb_init_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads LB Init main stylesheet.
	wp_enqueue_style( 'lb-init-style', $template_url . '/css/style.css', array(), null, 'all' );

	// General scripts.
	// Main.
	wp_enqueue_script( 'lb-init-main', $template_url . '/js/main.js', array( 'jquery' ), null, true );
	wp_localize_script( 'lb-init-main', 'js_var', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'lb_init_enqueue_scripts', 1 );
