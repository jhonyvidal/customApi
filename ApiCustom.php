<?php
/*
Plugin Name: Api Custom
Plugin URI: https://portfolio-ca475.web.app/
Description: Plugin Desarrollado para consumo de Api
Version: 1.0
Author: Jhony german Vidal Lopez
Author URI: https://portfolio-ca475.web.app/
License: GPL2
*/
//Evita que un usuario malintencionado ejecute codigo php desde la barra del navegador
defined('ABSPATH') or die( "Bye bye" );

//Aqui se definen las constantes

define( 'REMESA_RUTA',plugin_dir_path(__FILE__));

define( 'WPTRM_PLUGIN', __FILE__ );

define( 'WPTRM_NOMBRE','CustomApi');

define( 'WPTRM_PLUGIN_DIR', untrailingslashit( dirname( WPTRM_PLUGIN ) ) );


// Registra la función para ejecutarse en la activación del plugin
register_activation_hook(__FILE__, 'ApiCustom');

// Función que se ejecutará al activar el plugin
function ApiCustom() {

    $log_file = plugin_dir_path(__FILE__) . 'activation_log.txt';
    $message = "La función mi_plugin_instalar se ejecutó el " . date('Y-m-d H:i:s') . "\n";
    file_put_contents($log_file, $message, FILE_APPEND);

    global $wpdb; // Obtén la instancia global de la clase de la base de datos de WordPress

    $tabla_nombre = $wpdb->prefix . 'auto_config_Api_Custom'; 

    // Verifica si la tabla ya existe
    if ($wpdb->get_var("SHOW TABLES LIKE '$tabla_nombre'") != $tabla_nombre) {

        // Consulta SQL para crear la tabla
        $sql = "CREATE TABLE $tabla_nombre (
            id INT NOT NULL AUTO_INCREMENT,
            tipo VARCHAR(100),
            dato VARCHAR(255),
			estado tinyint,
            PRIMARY KEY (id),
            UNIQUE KEY (tipo)
        )";

		// Inserta datos en la tabla después de crearla
        $wpdb->insert(
            $tabla_nombre,
            array(
                'tipo' => 'VerificationSend',
                'dato' => 'http://devapi.autocredito.com.co/verification/send',
                'estado' => '1',
            )
        );

		// Inserta datos en la tabla después de crearla
        $wpdb->insert(
            $tabla_nombre,
            array(
                'tipo' => 'VerificationValidate',
                'dato' => 'http://devapi.autocredito.com.co/verification/validate',
                'estado' => '1',
            )
        );

		// Inserta datos en la tabla después de crearla
        $wpdb->insert(
            $tabla_nombre,
            array(
                'tipo' => 'LoansRequest',
                'dato' => 'http://devapi.autocredito.com.co/loans/request',
                'estado' => '1',
            )
        );

        // Incluye el archivo que contiene la función dbDelta
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Ejecuta la consulta SQL utilizando dbDelta
        dbDelta($sql);

    }
}

//Archivos externos
include(REMESA_RUTA.'/includes/opciones.php');

require_once WPTRM_PLUGIN_DIR . '/loadRemesa.php';
?>
