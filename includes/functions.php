<?php

function wptrm_plugin_url( $path = '' ) {
	$url = plugins_url( $path, WPTRM_PLUGIN );

	if ( is_ssl()
	and 'http:' == substr( $url, 0, 5 ) ) {
		$url = 'https:' . substr( $url, 5 );
	}

	return $url;
}


// Variable para almacenar el contenido HTML
$mi_modal_html = '';

// Definir la función que muestra el contenido HTML
function mostrar_modal_html() {
    global $mi_modal_html;

    // Lista de archivos PHP a incluir
    $rutas_html = [
        WPTRM_PLUGIN_DIR . '/includes/modal.php',
        WPTRM_PLUGIN_DIR . '/includes/modalTerm.php', 
    ];

    // Recorre cada archivo en la lista
    foreach ($rutas_html as $ruta_html) {
        // Verifica si el archivo existe
        if (file_exists($ruta_html)) {
            // Almacena el contenido en la variable, concatenando los contenidos
            $mi_modal_html .= file_get_contents($ruta_html);
        }
    }

    // Llama a la función directamente dentro del gancho de acción wp_footer
    add_action('wp_footer', 'imprimir_modal_html');
}

// Función para imprimir el contenido HTML
function imprimir_modal_html() {
    global $mi_modal_html;

    // Imprime el contenido almacenado
    echo $mi_modal_html;
}

// Llama a la función que muestra el HTML
mostrar_modal_html();