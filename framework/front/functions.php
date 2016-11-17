<?php
//affiche le titre du site
function ldw_sitetitle(){
  $logo_id = get_theme_mod( 'logo' );
  if(strlen($logo_id) > 0){
    $ret = wp_get_attachment_image( $logo_id, 'full', false, array(
      'class'    => 'custom-logo',
      'itemprop' => 'logo',
    ) );
  }
  else{
      $ret = get_bloginfo('name');
  }

  echo apply_filters('ldw_sitetitle',$ret);
}


function ldw_navbar_class(){
  if(get_theme_mod('header_position') == 'fixed'){
      echo 'header-fixed';
  }
}

//affiche la zone du widget du header
function ldw_header_widgets(){
  ldw_widgets('header-widgets');
}

//affiche une zone de widgets
function ldw_widgets($id){
  $sidebars_widgets = wp_get_sidebars_widgets();
	if(isset($sidebars_widgets[$id])){
		if(count($sidebars_widgets[$id]) > 0){ ?>
      <div id="<?php echo $id; ?>"><?php dynamic_sidebar($id); ?></div>
    <?php }
  }
}

/* affiche un menu de 3 façons différentes : liste de liens avec séparation, boite de sélection, liste classique */
function ldw_menu($location,$type = 'list',$sep = ' - ', $class = ''){
	global $wp_query;
	$current_id = $wp_query->get_queried_object_id();
	switch($type){
		case 'link':
			$menus = get_nav_menu_locations();
      if(isset($menus[$location])){
  			$elems = wp_get_nav_menu_items($menus[$location]);
  			if($elems && count($elems)>0){
  				foreach($elems as $key=>$elem){
  					if($elem->object_id == $current_id) $class = 'class="current_page_item"'; else $class = '';
  					echo '<a '.$class.' href="'.$elem->url.'">'.$elem->title.'</a>';
  					if($key < count($elems) - 1) echo $sep;
  				}
  			}
			}
		break;
		case 'select':
			$menus = get_nav_menu_locations();
      if(isset($menus[$location])){
  			$elems = wp_get_nav_menu_items($menus[$location]);
  			if($elems && count($elems)>0){
  				echo '<select onchange="window.location.replace(this.value)">';
  				foreach($elems as $key=>$elem){
  					if($elem->object_id == $current_id) $selected = 'selected="selected"'; else $selected = '';
  					echo '<option value="'.$elem->url.'" '.$selected.'>'.$elem->title.'</option>';
  				}
  				echo '</select>';
  			}
			}
		break;
		case 'list':
		default:
      require_once(get_template_directory().'/framework/front/classes/ldw_nav_menu.php');
      $menus = get_nav_menu_locations();
      if(isset($menus[$location])){
        $elems = wp_get_nav_menu_items($menus[$location]);
        if($elems && count($elems)>0){
    			wp_nav_menu(array(
            'theme_location' => $location ,
            'container'	=>	false,
            'menu_class'  =>  $class,
            'walker'  =>  new LDW_Nav_Menu()
          ));
        }
      }
		break;
	}
}

// défini la classe de grid en fonction du nombre de widgets dans la zone
function ldw_widget_class($id){
	$sidebars_widgets = wp_get_sidebars_widgets();
	if(isset($sidebars_widgets[$id])){
		switch(count($sidebars_widgets[$id])){
			case 0:
			case 1:
				return 'col-md-12';
			break;
			case 2:
				return 'col-md-6';
			break;
			case 3:
				return 'col-md-4';
			break;
			case 4:
			default:
				return 'col-md-3';
			break;
      /* Seul un fou aurait plus de 4 widgets ! */
		}
	}
	return 'col-md-12';
}

//affiche les réseaux sociaux
function ldw_social(){
  $socials = get_theme_mod('social_networks');
  $html = '';
  if(is_array($socials)){
      if(count($socials)>0){
        $html = '<ul class="social_networks">';
        foreach($socials as $social){
            $html .= '<li><a href="'.$social['url'].'">'.$social['icon'].'</a></li>';
        }
        $html .= '</ul>';
      }
  }
  echo apply_filters('ldw_social',$html);
}

// récupérer les N premiers mots d'un texte
function ldw_trim_text($text,	$length = 20,	$more = '&hellip;'){
	$text = strip_shortcodes( $text );
	$text = apply_filters( 'the_content', $text );
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = wp_trim_words( $text, $length, $more );
	return $text;
}

/* Génère les données de l'article */
function ldw_entry_meta(){

    $in = array(
            '%date%',
            '%author%',
            '%categories%',
            '%tags%',
            '%comments%'
        );
    $out = array(
            ldw_post_date(),
            ldw_post_author(),
            ldw_post_cats(),
            ldw_post_tags(),
            ldw_post_comments()
        );


    return str_replace($in,$out,get_theme_mod('post_meta'));
}

/* retourne la liste des tags de l'article courant */
function ldw_post_tags($sep = ', '){
    $post_tags = get_the_tags();
    $tag_list = '';
    if($post_tags) {
        foreach ($post_tags as $tag){
			if(strlen($tag_list)>0) $tag_list .= $sep;
            $tag_list .= '<a rel="tag" itemprop="keywords" href="'.esc_url(get_tag_link($tag->term_id)).'">'.$tag->name.'</a>';
		}
    }
    return apply_filters('ldw_post_tags',$tag_list,$post_tags);
}

/* retourne la liste des catégories de l'article courant */
function ldw_post_cats($sep = ', '){
    $post_cats = get_the_category();
    $categories_list = '';
    foreach ($post_cats as $cat){
		if(strlen($categories_list)>0) $categories_list .= $sep;
        $categories_list .= '<a itemprop="about" href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>';
	}
    return apply_filters('ldw_post_cats',$categories_list,$post_cats);
}

/* Génère la date de l'article */
function ldw_post_date(){
    $time_c = get_the_time('c');
    $date = get_the_date();
    $time = get_the_time();
	$post_date = sprintf(__('<time datetime="%1$s" pubdate="pubdate" itemprop="datePublished"> %2$s</time> ','ldwbase'),
		$time_c,
		$date,
		$time
	);
    return apply_filters('ldw_post_date',$post_date,$time_c,$date,$time);
}

/* Génère le nom de l'auteur de l'article */
function ldw_post_author(){
    $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $author_name = get_the_author();
	$post_author = sprintf(
        '<cite class="author vcard" itemdrop="author"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></cite> ',
		$author_url,
		sprintf( esc_attr__( 'Voir tous les articles de %s', 'ldwbase' ), $author_name ),
		$author_name
	);
    return apply_filters('ldw_post_author',$post_author,$author_url,$author_name);
}

/* Génère le lien vers les commentaires de l'article */
function ldw_post_comments(){
	$post_comments = '<a href="'.get_permalink().'#comments" itemprop="discussionUrl">';
	$post_comments .= get_comments_number_text(__('aucun commentaire','ldwbase').'<meta itemprop="interactionCount" content="0 UserComments">', __('Un commentaire','ldwbase').'<meta itemprop="interactionCount" content="1 UserComments">', __('% commentaires','ldwbase').'<meta itemprop="interactionCount" content="% UserComments">');
	$post_comments .= '</a>';
	return apply_filters('ldw_post_comments',$post_comments);
}

/* Affiche le titre des différentes pages d'archive du blog */
function ldw_archive_title(){
	if(is_home()){
		$front = get_option('show_on_front');
		if($front == 'posts'){
			$title = get_bloginfo('title');
		}
		else{
			$page = get_post(get_option('page_for_posts'));
			$title = $page->post_title;
		}
	}
	elseif(is_category()){
		$title = single_cat_title('',false);
	}
	elseif(is_tag()){
		$title = single_tag_title('',false);
	}
    elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
	elseif ( is_author() ){
		$title = sprintf( __( 'Auteur : %s', 'ldwbase' ), '<span class="vcard">' . get_the_author() . '</span>' );

	}
	elseif ( is_day() ){
		$title = sprintf( __( 'Jour : %s', 'ldwbase' ), '<span>' . get_the_date() . '</span>' );

	}
	elseif ( is_month() ){
		$title = sprintf( __( 'Mois : %s', 'ldwbase' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
	}
	elseif ( is_year() ){
		$title = sprintf( __( 'Année : %s', 'ldwbase' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
	}
    elseif(is_search()){
        $title = __('Recherche','ldwbase');
    }
	else{
		$title = __('Archives','ldwbase');
	}


    echo apply_filters('ldw_archive_title',$title);

}

function ldw_paginate($query = NULL){
  global $wp_query;

  $old_query = $wp_query;
  if(!is_null($query)){
    $wp_query = $query;
  }

	$paginate =  paginate_links();

  $wp_query = $old_query;

  return $paginate;
}
