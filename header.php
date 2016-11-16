<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1;" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> role="document">

  <header id="header" class="site-header <?php ldw_navbar_class(); ?>" role="banner">
    <div id="topbar" class="navbar-inverse">
				<div class="container">
						<nav id="topnav">
							<?php ldw_menu('topbar','list',null,'nav navbar-nav navbar-right'); ?>
						</nav>
				</div>
		</div>
		<div id="middlebar" class="navbar-default">
				<div class="container">
					<div id="header-title">
						<a href="<?php echo home_url(); ?>"><?php ldw_sitetitle(); ?></a>
					</div>
					<div id="header-widgets">
						<?php ldw_header_widgets(); ?>
					</div>
				</div>
		</div>
		<div id="bottombar" class="navbar navbar-default">
			<div class="container">
				<nav id="main-nav" class="navbar-collapse collapse">
					<?php ldw_menu('main','list',null,'nav navbar-nav'); ?>
				</nav>
			</div>
		</div>
  </header>

<div id="main">
  <div class="container" role="main">
