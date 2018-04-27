<?php
class LDWBaseAdmin{

	public function __construct(){
		add_action('admin_init',array($this,'admin_init'));
		add_action('admin_menu',array($this,'admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
		add_action( 'admin_notices', array($this, 'admin_notices'));

	}

	public function wp_enqueue_scripts(){
		wp_enqueue_media();
		wp_enqueue_script('ldwbase-admin', get_template_directory_uri().'/framework/admin/js/admin.js',array('jquery'),'', true);
		wp_enqueue_style('ldwbase-admin-css', get_template_directory_uri().'/framework/admin/css/admin.css');
	}

	function admin_init(){
		global $ldwbase_notices;

		$saved = false;

		// page général
		if(isset($_POST['ldwbase-general'])){
      if(wp_verify_nonce($_POST['ldwbase_nonce'], 'ldwbase-nonce')) {
				set_theme_mod('gmap_api',$_POST['gmap_api']);
				$saved = true;
			}
		}

		// page header
		if(isset($_POST['ldwbase-header'])){
      if(wp_verify_nonce($_POST['ldwbase_nonce'], 'ldwbase-nonce')) {
				set_theme_mod('logo',$_POST['logo_id']);
				set_theme_mod('header_position',$_POST['position']);
				$saved = true;
			}
		}

		// page blog
		if(isset($_POST['ldwbase-blog'])){
			if(wp_verify_nonce($_POST['ldwbase_nonce'], 'ldwbase-nonce')) {
				set_theme_mod('posts_item_order',$_POST['posts_item_order']);
				set_theme_mod('post_meta',$_POST['post_meta']);
				$saved = true;
			}
		}

		// page réseaux sociaux
		if(isset($_POST['ldwbase-social-networks'])){
      if(wp_verify_nonce($_POST['ldwbase_nonce'], 'ldwbase-nonce')) {
				set_theme_mod(
					'social_networks',
					[
						'facebook'   => stripslashes($_POST['facebook']),
						'twitter'    => stripslashes($_POST['twitter']),
						'googleplus' => stripslashes($_POST['googleplus']),
						'linkedin'   => stripslashes($_POST['linkedin']),
						'youtube'    => stripslashes($_POST['youtube'])
					]
				);
				$saved = true;
			}
		}

		// page footer
		if(isset($_POST['ldwbase-footer'])){
      if(wp_verify_nonce($_POST['ldwbase_nonce'], 'ldwbase-nonce')) {
				set_theme_mod('signature',stripslashes($_POST['signature']));
				$saved = true;
			}
		}

		if($saved){
			$ldwbase_notices = array(
				'classes'	=>	'notice-success',
				'html'	=>	"<p>Options enregistrées.</p>"
			);
		}
	}

	function admin_notices() {
		global $ldwbase_notices;
			if(is_array($ldwbase_notices)){
	    ?>
	    <div class="notice <?php echo $ldwbase_notices['classes']; ?>"><?php echo $ldwbase_notices['html']; ?></div>
	    <?php
			}
	}

  function admin_menu(){
    add_menu_page(
      'LDW Base',
      'LDW Base',
      'manage_options',
      'ldw-base',
      array($this,'general_page')
    );
		add_submenu_page(
			'ldw-base',
			'Général',
			'Général',
			'manage_options',
			'ldw-base',
			array($this,'general_page')
		);
    add_submenu_page(
      'ldw-base',
      'Header',
      'Header',
      'manage_options',
      'ldw-base-header',
      array($this,'header_page')
    );
		add_submenu_page(
			'ldw-base',
			'Blog',
			'Blog',
			'manage_options',
			'ldw-base-blog',
			array($this,'blog_page')
		);
		add_submenu_page(
			'ldw-base',
			'Réseaux sociaux',
			'Réseaux sociaux',
			'manage_options',
			'ldw-base-social-networks',
			array($this,'social_networks_page')
		);
		add_submenu_page(
			'ldw-base',
			'Footer',
			'Footer',
			'manage_options',
			'ldw-base-footer',
			array($this,'footer_page')
		);
		add_submenu_page(
			'ldw-base',
			'A propos',
			'A propos',
			'manage_options',
			'ldw-base-about',
			array($this,'about_page')
		);
  }

  function general_page(){

		$gmap_api = get_theme_mod('gmap_api', DEFAULT_GOOGLEAPI_KEY);

    $page = 'home';
    include('views/index.php');
  }

	function blog_page(){

		$posts_item_order = get_theme_mod('posts_item_order', DEFAULT_POSTS_ITEM_ORDER);
		$post_meta = get_theme_mod('post_meta', DEFAULT_POST_META);

    $page = 'blog';
    include('views/index.php');
  }

	function social_networks_page(){

		$facebook   = "";
		$twitter    = "";
		$googleplus = "";
		$linkedin   = "";
		$youtube    = "";

		$social_networks = get_theme_mod('social_networks');
		if (isset($social_networks['facebook'])) {
			$facebook = $social_networks['facebook'];
		}
		if (isset($social_networks['twitter'])) {
			$twitter = $social_networks['twitter'];
		}
		if (isset($social_networks['googleplus'])) {
			$googleplus = $social_networks['googleplus'];
		}
		if (isset($social_networks['linkedin'])) {
			$linkedin = $social_networks['linkedin'];
		}
		if (isset($social_networks['youtube'])) {
			$youtube = $social_networks['youtube'];
		}

    $page = 'social_networks';
    include('views/index.php');
  }

	function footer_page(){

		$signature = get_theme_mod('signature', DEFAULT_SIGNATURE);

    $page = 'footer';
    include('views/index.php');
  }

  function header_page(){

		$logo_id = get_theme_mod('logo');
		if(strlen($logo_id)>0){
			$src = wp_get_attachment_image_src($logo_id, 'full');
			$logo_url = $src[0];
		}

		$position = get_theme_mod('header_position', DEFAULT_POSITION);

    $page = 'header';
    include('views/index.php');
  }

	function about_page(){
    $page = 'about';
    include('views/index.php');
  }

}
new LDWBaseAdmin();
 ?>
