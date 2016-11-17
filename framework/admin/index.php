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

		if(isset($_POST['ldwbase-header'])){
      if(wp_verify_nonce($_POST['ldwbase_nonce'], 'ldwbase-nonce')) {

				set_theme_mod('logo',$_POST['logo_id']);
				$ldwbase_notices = array(
					'classes'	=>	'notice-success',
					'html'	=>	"<p>Options enregistrées.</p>"
				);
			}
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
      array($this,'admin_page')
    );
		add_submenu_page(
			'ldw-base',
			'Général',
			'Général',
			'manage_options',
			'ldw-base',
			array($this,'admin_page')
		);
    add_submenu_page(
      'ldw-base',
      'Entête',
      'Entête',
      'manage_options',
      'ldw-base-header',
      array($this,'header_page')
    );
  }

  function admin_page(){
    $page = 'home';
    include('views/index.php');
  }

  function header_page(){

		$logo_id = get_theme_mod('logo');
		if(strlen($logo_id)>0){
			$src = wp_get_attachment_image_src($logo_id, 'full');
			$logo_url = $src[0];
		}

    $page = 'header';
    include('views/index.php');
  }

}
new LDWBaseAdmin();
 ?>
