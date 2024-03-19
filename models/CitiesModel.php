<?php

require_once('../../../../wp-config.php');

class ModeloCities{

	/*=============================================
	MOSTRAR CITIES
	=============================================*/

	static public function mdlMostrarCities($name, $state){

		try{

			global $wpdb;

			$table = $wpdb->prefix.'auto_cities';

			$resultados = $wpdb->get_results( "SELECT id,name FROM $table WHERE name LIKE '%$name%' AND id_state = '$state'" );

			if(!$resultados) {
				echo json_encode("Ha ocurrido un error en la Consulta a la DB: ". json_encode($resultados));
			}else{
				return ($resultados);
			}

		} catch (Exception $e) {
			echo "Error: " . $e -> getMessage() . "\n";
		}

	}
	/*=============================================
	MOSTRAR CITIES
	=============================================*/

	static public function mdlMostrarStates($name){

		try{

			global $wpdb;

			$table = $wpdb->prefix.'auto_states';

			$resultados = $wpdb->get_results( "SELECT id,name FROM $table WHERE name LIKE '%$name%'" );

			if(!$resultados) {
				echo json_encode("Ha ocurrido un error en la Consulta a la DB: ". json_encode($resultados));
			}else{
				return ($resultados);
			}

		} catch (Exception $e) {
			echo "Error: " . $e -> getMessage() . "\n";
		}

	}

	/*=============================================
	MOSTRAR CITIES
	=============================================*/

	static public function mdlMostrarMarcas(){

		try{

			global $wpdb;

			$table = $wpdb->prefix.'auto_vehicle';

			$resultados = $wpdb->get_results( "SELECT id, brand FROM $table GROUP BY brand" );

			if(!$resultados) {
				echo json_encode("Ha ocurrido un error en la Consulta a la DB: ". json_encode($resultados));
			}else{
				return ($resultados);
			}

		} catch (Exception $e) {
			echo "Error: " . $e -> getMessage() . "\n";
		}

	}

	/*=============================================
	MOSTRAR CITIES
	=============================================*/

	static public function mdlMostrarModelos($name, $brand){

		try{

			global $wpdb;

			$table = $wpdb->prefix.'auto_vehicle';

			$resultados = $wpdb->get_results( "SELECT id,model name FROM $table WHERE model LIKE '%$name%' AND brand = '$brand' " );

			if(!$resultados) {
				echo json_encode("Ha ocurrido un error en la Consulta a la DB: ". json_encode($resultados));
			}else{
				return ($resultados);
			}

		} catch (Exception $e) {
			echo "Error: " . $e -> getMessage() . "\n";
		}

	}

	
}