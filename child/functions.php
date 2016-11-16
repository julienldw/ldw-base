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


add_action( 'after_setup_theme','ldwbasechild_setup',11);
function ldwbasechild_setup(){

  // défini la clé identifiant pour accéder aux API google
  //La clé ci-dessous est pour le développement. Créer un projet dédié pour la production https://console.developers.google.com/apis/
  set_theme_mod('gmap_api', 'AIzaSyCfA_y54n7UkBQQb8lhy1cneHhRmI8HBME');

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

  // Code HTML de la signature
  set_theme_mod('signature','<p>&copy; 2016 - conçu avec <i class="fa fa-heart"></i> par <a href="http://lamourduweb.com">Lamour du Web</a></p>');

  // ordre d'affichage des éléments dans la liste des articles du blog.
  // Supprimer un élément pour ne pas l'afficher
  set_theme_mod('posts_item_order', 'img,title,excerpt,meta');

  // Contenu de l'élément "meta" (voir ci-dessus)
  // variables utilisables : %date% %author% %categories% %tags% %comments%
  // Voir ldw_entry_meta() dans framework/front/functions.php pour voir ce que ces variables affichent
  // L'affichage de chacune de ces variables peut être modifié grâce à des filtres
  set_theme_mod('post_meta','<span class="date">Publié le %date%</span><span class="cat">Dossier : %categories%</span>');

}
