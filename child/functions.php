<?php

// Le thème intègre automatiquement les styles et les composents Javascript de Boostrap


// les deux éléments ci-dessous sont en garder en développement puis à commenter une fois en production.
// ils servent à forcer la recompilation du style et désactive le cache de wp rocket.
define('WP_SCSS_ALWAYS_RECOMPILE',true);
add_filter( 'do_rocket_generate_caching_files', '__return_false' );

// active ou non les scripts fournis avec le thème
define('SELECT2', false); // https://select2.github.io/examples.html
define('AUTOSIZE', false); // http://www.jacklmoore.com/autosize/
define('GMAP3', false); // http://gmap3.net/
define('COLORBOX', false); // http://www.jacklmoore.com/colorbox/
define('BT_SLIDER', false); // http://seiyria.com/bootstrap-slider/
define('AJAX',true);


add_action( 'after_setup_theme','ldwbasechild_setup',11);
function ldwbasechild_setup(){

  // défini si le header est static ou fixed
  set_theme_mod('header_position','static');

  // renseigne les réseaux sociaux qui s'afficheront avec la fonction ldw_social()
  //1er paramètre : l'URL vers la page sociale du client, 2e paramètre : le code HTML pour afficher l'icone du réseau social
  set_theme_mod('social_networks', array(
    array(
      'url'	=>	'http://googleplus.com',
      'icon'	=>	'<i class="fa fa-google-plus" aria-hidden="true"></i>'
    ),
    array(
      'url'	=>	'http://linkedin.com',
      'icon'	=>	'<i class="fa fa-linkedin" aria-hidden="true"></i>'
    )
  ));


}
