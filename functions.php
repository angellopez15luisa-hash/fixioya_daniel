<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the theme framework.
require_once __DIR__ . '/vendor/hivepress/hivetheme/hivetheme.php';



function limpiar_estructura_menu_a( $item_output, $item, $depth, $args ) {
    // Aplicar solo al menú llamado 'header'
    if ( isset($args->menu) && $args->menu == 'header' ) {
        
        // Clases que comparten absolutamente todos los enlaces
        $clases = 'nav-item flex items-center justify-center';
        
        // Comprobamos si es la página activa actual
        if ( in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes) ) {
            // Estilos para el enlace activo
            $clases .= ' active-tab px-8 shadow-lg';
        } else {
            // Estilos para los enlaces inactivos
            $clases .= ' px-6';
        }

        // Construcción limpia del enlace <a>
        $item_output = '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $clases ) . '">';
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= '</a>';
    }
    
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'limpiar_estructura_menu_a', 10, 4 );
