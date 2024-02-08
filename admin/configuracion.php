<?php

defined('ABSPATH') or die( "Bye bye" );

//Comprueba que tienes permisos para acceder a esta pagina
if (! current_user_can ('manage_options')) wp_die (__ ('No tienes suficientes permisos para acceder a esta página.'));


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    global $wpdb;

    $tabla_nombre = $wpdb->prefix . 'config_api_custom';

    foreach ($_POST['datos'] as $id => $valor) {
        // Realiza alguna validación y sanitización de los datos antes de actualizar la base de datos
        $valor = sanitize_text_field($valor);

        // Actualiza la fila en la base de datos
        $wpdb->update(
            $tabla_nombre,
            array('dato' => $valor),
            array('id' => $id)
        );
    }

    echo '<div class="notice notice-success is-dismissible"><p>¡Cambios guardados correctamente!</p></div>';
}
function obtener_datos_de_la_tabla() {
    global $wpdb;

    $tabla_nombre = $wpdb->prefix . 'config_api_custom';

    // Realiza una consulta para obtener todos los datos de la tabla
    $resultados = $wpdb->get_results("SELECT * FROM $tabla_nombre", ARRAY_A);

    // $resultados contendrá un array de filas de la tabla
    return $resultados;
}

// Ejemplo de uso:
$datos = obtener_datos_de_la_tabla();


 ?>

<div class="wrap">
		<h2><?php _e( 'Custom Api', 'tpremesas' ) ?></h2>
		Bienvenido a la configuración de customApi<br>
		Click en Guardar cambios para actualizar las url de las Apis
</div></br>

<form method="post" action="">
 <table>
	<tbody>
	<?php foreach ($datos as $fila) : ?>
                <tr>
                    <th scope='row'><label for='dato_<?php echo $fila['id']; ?>'><?php echo esc_html($fila['tipo']); ?></label></th>
                    <td><input name='datos[<?php echo $fila['id']; ?>]' type='text' id='dato_<?php echo $fila['id']; ?>' value="<?php echo esc_attr($fila['dato']); ?>" class='regular-text'></td>
                </tr>
            <?php endforeach; ?>
	</tbody>
 </table>

 <p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
 </p>
</form>
