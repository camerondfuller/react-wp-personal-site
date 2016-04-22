<?php
/**
 * Including theme requried actions hooks
 *
 * @package lychee
 * @since 1.0.0
 *
 */

define( 'CS_ACTIVE_FRAMEWORK',  true  );
define( 'CS_ACTIVE_METABOX',    true );
define( 'CS_ACTIVE_SHORTCODE',  false );
define( 'CS_ACTIVE_CUSTOMIZE',  false );

defined( 'T_NRG' )			or 	define(	'T_NRG',	'http://demo.nrgthemes.com' );

/**
 * Loads all the js and css script to frontend
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_enqueue_scripts' ) ) {
	function lychee_enqueue_scripts() {

		// register styles
		wp_enqueue_style( 'bootstrap',			T_URI . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'fontawesome',		'//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'font',				T_URI . '/assets/css/font.css' );
		wp_enqueue_style( 'animsition',			T_URI . '/assets/css/animsition.min.css' );
		wp_enqueue_style( 'textrotator',		T_URI . '/assets/css/simpletextrotator.css' );
		wp_enqueue_style( 'magnific-popup',		T_URI . '/assets/css/magnific-popup.css' );
		wp_enqueue_style( 'multiscroll',		T_URI . '/assets/css/jquery.multiscroll.css' );
		wp_enqueue_style( 'style',				T_URI . '/assets/css/style.css' );
		wp_enqueue_style( 'theme-style',		T_URI . '/style.css' );


		wp_enqueue_script( 'bootstrap',			T_URI . '/assets/js/bootstrap.min.js',								array('jquery'), false, true );
		wp_enqueue_script( 'isotope',			T_URI . '/assets/js/isotope.pkgd.min.js',							array('jquery'), false, true );
		wp_enqueue_script( 'countto',			T_URI . '/assets/js/jquery.countTo.js',								array('jquery'), false, true );
		wp_enqueue_script( 'animsition',		T_URI . '/assets/js/jquery.animsition.min.js',						array('jquery'), false, true );
		wp_enqueue_script( 'popup',				T_URI . '/assets/js/jquery.magnific-popup.min.js',					array('jquery'), false, true );
		wp_enqueue_script( 'text-rotator',		T_URI . '/assets/js/jquery.simple-text-rotator.min.js',				array('jquery'), false, true );
		wp_enqueue_script( 'swiper',			T_URI . '/assets/js/idangerous.swiper.min.js',						array('jquery'), false, true );
		wp_enqueue_script( 'multiscroll',		T_URI . '/assets/js/jquery.multiscroll.min.js',						array('jquery'), false, true );
		wp_enqueue_script( 'easings',			T_URI . '/assets/js/jquery.easings.min.js',							array('jquery'), false, true );
		wp_enqueue_script( 'all',				T_URI . '/assets/js/all.js',										array('jquery'), false, true );


		// include comment-reply script
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );

	}
	add_action( 'wp_enqueue_scripts', 'lychee_enqueue_scripts');
}

/**
 * Include required plugins
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_include_required_plugins' ) ) {
	function lychee_include_required_plugins() {

		$plugins = array(

			array(
				'name'					=> __( 'Lychee plugin', 'lychee' ), // The plugin name
				'slug'					=> 'lychee-plugin', // The plugin slug (typically the folder name)
				'required'				=> true, // If false, the plugin is only 'recommended' instead of required
				'version'				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'source'				=> T_NRG .'/projects/plugins/lychee-plugin.zip', // The plugin source
			),

			array(
				'name'					=> __( 'Visual Composer', 'lychee' ),
				'slug'					=> 'js_composer',
				'required'				=> true,
				'version'				=> '',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'source'				=> T_NRG .'/projects/plugins/js_composer.zip',
			),

			array(
				'name'					=> __( 'Contact Form 7', 'lychee' ),
				'slug'					=> 'contact-form-7',
				'required'				=> true,
				'version'				=> '',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> __( 'WooCommerce', 'lychee' ),
				'slug'					=> 'woocommerce',
				'required'				=> false,
				'version'				=> '',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

		);


		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
		'domain'       		=> 'tgmpa',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'tgmpa' ),
			'menu_title'                       			=> __( 'Install Plugins', 'tgmpa' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'tgmpa' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'tgmpa' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'tgmpa' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'tgmpa' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'tgmpa' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'lychee_include_required_plugins' );
}



/**
 * Add required theme elements
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_after_setup' ) ) {
	function lychee_after_setup() {

		// register nav
		register_nav_menus( array( 'pri-menu' => __( 'Primary Menu', 'lychee' ) ) );

		//add elements theme support
		add_image_size('sidebar_thumbnail',	120, 80, true );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'automatic-feed-links' );
		#delete
		add_theme_support( 'post-formats',	array( /*'aside',*/ 'quote', 'audio', 'video', 'gallery' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		if ( 0 ) posts_nav_link();
		if ( !isset( $content_width ) ) $content_width = 1200;

		add_theme_support('woocommerce');
	}
	add_action('after_setup_theme', 'lychee_after_setup');
}

/**
 * Add editor styles
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_add_editor_styles' ) ) {
	function lychee_add_editor_styles () {
		add_editor_style( 'assets/css/style.css' );
	}
	add_action( 'admin_init', 'lychee_add_editor_styles' );
}

/**
 * Print in header needed technical information
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_header_tech_info' ) ) {
	function lychee_header_tech_info() {
		$output = '<meta charset="' . sanitize_text_field( get_bloginfo('charset') ) . '" />' . "\n";

		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$favicon = cs_get_option( 'site-favicon' );
			if ( !empty( $favicon ) ) {
				$output .= '<link rel="shortcut icon" href="' . esc_url( $favicon ) . '"/>' . "\n";
			}
		}
		$output .= '<meta name="format-detection" content="telephone=no" />' . "\n";
		$output .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">' . "\n";
		

		$logo_color = cs_get_option('text_logo_color');
		if($logo_color){
			$output .= '<style>body .logo a{color:'.$logo_color.'}</style>';
		}


		print $output;
	}
	add_action( 'wp_head', 'lychee_header_tech_info', 1 );
}



/**
 * Register sidebars for theme
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if( !function_exists('lychee_register_sidebars') ) {
	function lychee_register_sidebars() {

		// register main sidebar
		register_sidebar( array(
			'id'			=> 'sidebar_blog',
			'name'			=> __( 'Sidebar', 'lychee' ),
			'before_widget'	=> '<div id="%1$s" class="sidebar-block widget main-widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widgettitle">',
			'after_title'	=> '</h4>',
			'description'	=> __( 'Drag the widgets for sidebar.', 'lychee' ),
		));

		// register shop sidebar
		register_sidebar( array(
			'id'			=> 'sidebar_shop',
			'name'			=> __( 'Sidebar Shop', 'lychee' ),
			'before_widget'	=> '<div id="%1$s" class="shop-bar-el-wrap %2$s"><div class="hop-bar-el-inner">',
			'after_widget'	=> '</div></div>',
			'before_title'	=> '<span class="woocommerce-widget-title">',
			'after_title'	=> '</span>',
			'description'	=> __( 'Drag the widgets for sidebar.', 'lychee' ),
		));

	}
	add_action( 'widgets_init', 'lychee_register_sidebars' );
}