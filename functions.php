<?php

define('DEFAULT_GOOGLEAPI_KEY', 'AIzaSyCfA_y54n7UkBQQb8lhy1cneHhRmI8HBME');
define('DEFAULT_SIGNATURE','<p>&copy; ' . date('Y') . ' - conçu par <a href="https://lamourduweb.com" target="_blank">Lamour du Web</a></p>');
define('DEFAULT_POSTS_ITEM_ORDER', 'img,title,meta,excerpt,more');
define('DEFAULT_POST_META', 'Publié le %date% par %author% dans %categories%');

class LDWBase{

	public function __construct(){
		add_action('init', array($this, 'init'));
		add_action('admin_notices', array($this,'admin_notices') );
		add_action( 'after_setup_theme', array($this,'setup') );
		add_action( 'widgets_init', array($this,'widgets_init') );
		add_action('wp_enqueue_scripts',array($this,'wp_enqueue_scripts') );
		add_action('init',array($this,'add_editor_styles') );
	}

	public function init(){
		if(is_admin())
			include_once( dirname(__FILE__) . '/framework/admin/index.php' );
	}

	public function wp_enqueue_scripts(){

		wp_enqueue_script('bootstrap',get_template_directory_uri().'/framework/vendors/bootstrap/js/bootstrap.min.js',array('jquery'),'', true);

		if(COLORBOX){
			wp_enqueue_script('colorbox',get_template_directory_uri().'/framework/vendors/colorbox/js/jquery.colorbox-min.js',array('jquery'),'', true);
			wp_enqueue_script('colorbox_i18n',get_template_directory_uri().'/framework/vendors/colorbox/i18n/jquery.colorbox-'.substr(get_locale(), 0, 2).'.js',array('colorbox'),'', true);
			wp_enqueue_style('colorbox_css',get_template_directory_uri().'/framework/vendors/colorbox/example1/colorbox.css');
		}
		if(AUTOSIZE){
			wp_enqueue_script('autosize',get_template_directory_uri().'/framework/vendors/autosize/js/autosize.min.js',array('jquery'),'', true);
		}
		if(GMAP3){
			wp_enqueue_script('gmap', '//maps.google.com/maps/api/js?libraries=places&key='.get_theme_mod('gmap_api'));
			wp_enqueue_script('gmap3',get_template_directory_uri().'/framework/vendors/gmap3/js/gmap3.min.js',array('jquery','gmap'),'', true);
		}
		if(SELECT2){
			wp_enqueue_script('select2',get_template_directory_uri().'/framework/vendors/select2/select2.full.min.js',array('jquery'),'', true);
			wp_enqueue_style('select2_css',get_template_directory_uri().'/framework/vendors/select2/select2.min.css');
		}
		if(BT_SLIDER){
			wp_enqueue_script('bt_slider',get_template_directory_uri().'/framework/vendors/bootstrap-slider/js/bootstrap-slider.min.js',array('jquery'),'', true);
			wp_enqueue_style('bt_slider_css',get_template_directory_uri().'/framework/vendors/bootstrap-slider/css/bootstrap-slider.min.css');
		}
		if(LAZYLOAD){
			wp_enqueue_script('lazyload',get_template_directory_uri().'/framework/vendors/jquery-lazyload/jquery.lazyload.js',array('jquery'),'', true);
		}
		if(ANIMATECSS){
			wp_enqueue_style('animate_css',get_template_directory_uri().'/framework/vendors/animate-css/animate.css');
		}

		//intègre le fichier JS du thème de base
		wp_enqueue_script('ldwbase',get_template_directory_uri().'/framework/front/js/front.js',array('jquery'),'', true);

		// intègre le fichier JS du thème enfant s'il existe
		if(file_exists(get_stylesheet_directory().'/site.js')){
			wp_enqueue_script('site',get_stylesheet_directory_uri().'/site.js',array('ldwbase'),'', true);
			if(AJAX){
				wp_localize_script('site', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
			}
		}
	}

	public function admin_notices(){
			$plugin_messages = array();

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if(!is_plugin_active( 'wp-scss/wp-scss.php' ))
			{
				$plugin_messages[] = 'This theme requires you to install the WP SCSS plugin, <a href="https://fr.wordpress.org/plugins/wp-scss/">download it from here</a>.';
			}
			if(count($plugin_messages) > 0)
			{
				echo '<div id="message" class="error">';

					foreach($plugin_messages as $message)
					{
						echo '<p><strong>'.$message.'</strong></p>';
					}

				echo '</div>';
			}
	}


	public function setup(){
			set_theme_mod('header_position','static');
			set_theme_mod('social_networks', array());
			set_theme_mod('post_more', 'Lire la suite');


			include_once( dirname(__FILE__) . '/framework/front/functions.php' );
			include_once( dirname(__FILE__) . '/framework/front/hooks.php' );

			show_admin_bar( false );

			load_theme_textdomain( 'ldwbase', get_template_directory() . '/languages' );

			// support du RSS pour les articles et les commentaires
			add_theme_support( 'automatic-feed-links' );

			//laisse à WP la gestion du TITLE des pages
			add_theme_support( 'title-tag' );


			add_theme_support( 'custom-header',	apply_filters( 'ldwbase_custom_header_args', array(
				'flex-width'	=> true,
				'flex-height'		=>	true,
				'width'	=>	1024,
				'height'	=>	100
			) ) );

			add_theme_support( 'custom-background', apply_filters( 'ldwbase_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 1200, 9999 );

			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			register_nav_menus( apply_filters( 'ldwbase_nav_menu_args', array(
				'main' => __( 'Menu principal', 'ldwbase' ),
				'secondary'  => __( 'Menu footer', 'ldwbase' ),
				'topbar'  => __( 'Menu topbar', 'ldwbase' ),

			) ) );

			add_editor_style( array( 'editor.css' ) );

			add_theme_support( 'customize-selective-refresh-widgets' );
	}


		public function widgets_init() {
	        register_sidebar( array(
				'name' => __( 'Sidebar Widgets', 'ldwbase' ),
				'id' => 'sidebar-widgets',
				'description' => __( 'Sidebar', 'ldwbase' ),
				'before_widget' => '<aside id="%1$s" class="widget widget-container %2$s"><div class="widget_content">',
				'after_widget' => '</div></aside>',
				'before_title' => '<p class="widget-title">',
				'after_title' => '</p>',
			) );
			register_sidebar( array(
				'name' => __( 'Header Widgets', 'ldwbase' ),
				'id' => 'header-widgets',
				'description' => __( 'Header', 'ldwbase' ),
				'before_widget' => '<aside id="%1$s" class="widget widget-container %2$s"><div class="widget_content">',
				'after_widget' => '</div></aside>',
				'before_title' => '<p class="widget-title">',
				'after_title' => '</p>',
			) );
			register_sidebar( array(
				'name' => __( 'Footer Widgets', 'ldwbase' ),
				'id' => 'footer-widgets',
				'description' => __( 'Footer', 'ldwbase' ),
				'before_widget' => '<aside id="%1$s" class="col-xs-12 '.ldw_widget_class('footer-widgets').' widget widget-container %2$s"><div class="widget_content">',
				'after_widget' => '</div></aside>',
				'before_title' => '<p class="widget-title">',
				'after_title' => '</p>',
			) );

	        //register_widget('Widget_Contact');
	        //register_widget('Widget_Map');
		}

	public function add_editor_styles() {
		add_editor_style( 'style.css' );
	}
}
new LDWBase();
