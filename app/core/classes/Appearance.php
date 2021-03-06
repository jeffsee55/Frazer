<?php
/**
 * Theme Appearance Class.
 *
 * Manages JS & CSS enqueuing of the theme.
 *
 * @package Classy
 */

namespace Classy;

/**
 * Class Appearance.
 */
class Appearance {

	/**
	 * Appearance constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		add_action( 'wp_print_scripts', array( $this, 'init_js_vars' ) );

		add_filter( 'post_gallery', array($this, 'add_gallery_classes'), 10, 3 );

		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );

	}

	/**
	 * Enqueues styles
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'main', CLASSY_THEME_DIR . 'dist/css/main.css', array(), CLASSY_THEME_VERSION, 'all' );

	}

	/**
	 * Enqueues scripts
	 */
	public function enqueue_scripts() {

		if ( 'production' === Classy::get_config_var( 'environment' ) ) {

			wp_enqueue_script( 'theme_scripts', CLASSY_THEME_DIR . 'dist/js/production.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );

		} else {

			// wp_enqueue_script( 'theme_scripts', CLASSY_THEME_DIR . 'dist/js/all.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );

			wp_enqueue_script( 'theme_scripts', CLASSY_THEME_DIR . 'assets/js/scripts.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );
			wp_enqueue_script( 'header_script', CLASSY_THEME_DIR . 'assets/js/header.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );
			wp_enqueue_script( 'modal_script', CLASSY_THEME_DIR . 'assets/js/modal.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );
			wp_enqueue_script( 'list_panel_script', CLASSY_THEME_DIR . 'assets/js/list-panel.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );
			wp_enqueue_script( 'slider_script', CLASSY_THEME_DIR . 'assets/js/slider.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );
			wp_enqueue_script( 'scrollreveal_script', CLASSY_THEME_DIR . 'assets/js/scrollreveal.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );

			$options = array(
				'base_url'          => home_url( '' ),
				'blog_url'          => home_url( 'archives/' ),
				'template_dir'      => CLASSY_THEME_DIR,
				'ajax_load_url'     => admin_url( 'admin-ajax.php' ),
				'is_mobile'         => (int) wp_is_mobile(),
			);

			wp_localize_script(
				'modal_script',
				'options',
				$options
			);

		}

	}

	/**
	 * Enqueues admin scripts
	 */
	public function admin_enqueue_scripts() {

		wp_enqueue_script( 'media_script', CLASSY_THEME_DIR . 'assets/js/media.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );
		wp_enqueue_script( 'options_table_script', CLASSY_THEME_DIR . 'assets/js/options_table.js', array( 'jquery' ), CLASSY_THEME_VERSION, true );

	}

	public function add_gallery_classes($output = '', $atts, $instance) {
		$gallery = new Gallery($output = '', $atts, $instance);
		return $gallery->display();
	}

	/**
	 * Load needed options & translations into template.
	 */
	public function init_js_vars() {

		$options = array(
			'base_url'          => home_url( '' ),
			'blog_url'          => home_url( 'archives/' ),
			'template_dir'      => CLASSY_THEME_DIR,
			'ajax_load_url'     => admin_url( 'admin-ajax.php' ),
			'is_mobile'         => (int) wp_is_mobile(),
		);

		wp_localize_script(
			'theme_plugins',
			'theme',
			$options
		);

	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function setup_theme() {
		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'header-menu' => __( 'Header Menu', Classy::textdomain() ),
			'footer-menu' => __( 'Footer Menu', Classy::textdomain() ),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */

		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		add_image_size('wide', 1500 );

		add_theme_support( 'custom-logo', array(
		    'height'      => 100,
		    'width'       => 400,
		    'flex-height' => true,
		    'flex-width'  => true,
		    'header-text' => array( 'Heid & Seek', 'FOOD, FITNESS, FASHION, FELINES' ),
		) );
	}
}
