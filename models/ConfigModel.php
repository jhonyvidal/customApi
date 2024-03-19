<?php

require_once('../../../../wp-config.php');

class ModeloConfig{

	/*=============================================
	MOSTRAR CONFIGURACIONES
	=============================================*/

	static public function mdlMostrarConfiguraciones($tipo){

		global $wpdb;

		$table = $wpdb->prefix.'auto_config_Api_Custom';

		$resultados = $wpdb->get_var( "SELECT dato FROM $table WHERE tipo = '$tipo' AND estado = 1" );

        if(!$resultados) {
            echo json_encode("Ha ocurrido un error en la Consulta a la DB: ". json_encode($resultados));
        }else{
            return ($resultados);
        }

	}
}