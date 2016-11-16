<?php
add_filter('excerpt_more', array('Hooks','excerpt_more'));
add_filter( 'nav_menu_css_class', array('Hooks','nav_menu_css_class'),10,4 );
add_filter( 'nav_menu_link_attributes', array('Hooks','nav_menu_link_attributes'),10,4 );
add_filter( 'nav_menu_item_title', array('Hooks','nav_menu_item_title'),10,4 );
add_filter( 'dynamic_sidebar_params', array('Hooks','dynamic_sidebar_params'),10,1 );
add_filter('upload_mimes', array('Hooks','upload_mimes'),10,1);

class Hooks{

  static function excerpt_more( $more ) {
    return '&hellip;';
  }

  static function nav_menu_css_class( $classes , $item, $args, $depth ) {
    if(in_array('menu-item-has-children', $classes))
      $classes[] = 'dropdown';
    return $classes;
  }

  static function nav_menu_link_attributes( $atts, $item, $args, $depth  ) {
    if(is_object($args->walker)){
      if($args->walker->has_children){
        $atts['data-href'] = '#';
        $atts['data-toggle'] = 'dropdown';
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
        if(!isset($atts['class'])) $atts['class'] = '';
        $atts['class'] .= ' dropdown-toggle';
      }
    }
    return $atts;
  }
  static function nav_menu_item_title( $title, $item, $args, $depth   ) {
    if(is_object($args->walker)){
      if($args->walker->has_children){
        $title .= '<span class="caret"></span>';
      }
    }
    return $title;
  }

  static function dynamic_sidebar_params( $params ) {
    return $params;
  }

  static function upload_mimes($mimes) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
  }

}
