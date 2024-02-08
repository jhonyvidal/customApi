<?php

defined('ABSPATH') or die( "Bye bye" );

/*
 * Nuevo menu de administrador
 */
 
// El hook admin_menu ejecuta la funcion TpFacturas_menu_administrador
add_action( 'admin_menu', 'TpRemesas_menu_administrador' );
 
// Top level menu del plugin
function TpRemesas_menu_administrador()
{
	add_menu_page(WPTRM_NOMBRE,WPTRM_NOMBRE,'manage_options',REMESA_RUTA . '/admin/configuracion.php'); //Crea el menu
    add_options_page(WPTRM_NOMBRE,WPTRM_NOMBRE, 'manage_options', 'TpFacturas', 'TpFacturas_options'); //Crea la pagina de opciones
}
 ?>
