<?php

require_once('../../../../wp-config.php');

class ModeloPago{

	/*=============================================
	CONSULTAR 
	=============================================*/
	static public function mdlConsultaCliente($id){

		global $wpdb;

        $resultados = $wpdb->get_results( "SELECT * FROM wp_tpc_cliente A INNER JOIN wp_ciudad B ON A.CodCiudad = B.codigo_ciudad
		WHERE A.IdCliente = $id" );

        if(!$resultados) {
			$response = array('Documento no existe' => $resultados, 'succes' => false);
			echo json_encode($response);
        }else{
			$response = array('data' => $resultados, 'succes' => true);
			echo json_encode($response);
        }
	}

	/*=============================================
	CREAR PAGO
	=============================================*/	
	static public function mdlCrearPago($referencia){

		global $wpdb;

		$resultados = $wpdb->insert( 'wp_tpf_pago', 
		
			array( 
				'referencia' => $referencia, 
				'estado' => 'ACTIVO', 
			)
			
		);

		if(!$resultados) {
			$response = array('data' => "El Usuario ya existe", 'succes' => false);
			echo json_encode($response);
        }else{
			$response = array('data' => $wpdb->insert_id, 'succes' => true);
			echo json_encode($response);
        }
	}
	/*=============================================
	CREAR FACTURA
	=============================================*/	
	static public function mdlCrearRemesa($model){

		global $wpdb;

		$resultados = $wpdb->insert( 'wp_tpf_remesa', 
		
			array( 
				'id_Pago' => $model["IdPago"],
				'CO' => $model["CO"],
				'expirationDate' => $model["expirationDate"],
        		'paymentLink' => $model["paymentLink"],
				'Date' => $model["Date"],
				'CustomerId' => $model["CustomerId"],
				'CustomerName' => $model["CustomerName"],
				'Value' => $model["Value"],
				'Seller' => $model["Seller"],
				'Type' => $model["Type"],
				'DocumentNumber' => $model["DocumentNumber"]
			)
			
		);

		if(!$resultados) {
			$response = array('data' => $resultados, 'succes' => false);
			echo json_encode($response);
        }else{
			$response = array('data' => $wpdb->insert_id, 'succes' => true);
			echo json_encode($response);
        }
	}
	/*=============================================
	CONSULTAR REMESA LOCAL
	=============================================*/	
	static public function mdlConsultarRemesa($id){

		global $wpdb;

		$resultados = $wpdb->get_results( "SELECT * FROM wp_tpf_remesa A 
		INNER JOIN wp_tpf_pago B
		ON A.id_pago = B.id
		WHERE A.id_pago = $id" );

        if(!$resultados) {
			$response = array('Documento no existe' => $resultados, 'succes' => false);
			echo json_encode($response);
        }else{
			$response = array('data' => $resultados, 'succes' => true);
			echo json_encode($response);
        }
	}

	

}