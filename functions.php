<?php 
function register_menus() {
  register_nav_menus( array(
    'main-menu' => 'Meniu Principal'
  ) );
}

add_action( 'init', 'register_menus' );

?>
