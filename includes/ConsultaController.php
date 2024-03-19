<?php
session_start();
require_once  ('../models/ConsultarModel.php');
require_once  ('../models/ConfigModel.php');
require_once  ('../models/CitiesModel.php');
class Cliente
{
    static public function VerificationSend(){

      global $wpdb;
        
            //Datos a Enviar
            $data = array (
                'PhoneNumber'=>  $_POST["phoneNumber"],
                'Id'=> $_POST["customerId"],
                'Email'=> $_POST["email"],
            );

            $authorization = 'autocredito-token: admin123456789';
            $payload = json_encode($data);

            $url = Cliente::SendConfig("VerificationSend");
            $ch = curl_init("$url");
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            $response = curl_exec($ch);
            json_decode($response);

            echo $response;
    }

    static public function VerificationValidate(){

      global $wpdb;
        
            //Datos a Enviar
            // $data = array (
            //     'code'=>  $_POST["code"],
            //     'customerId'=> $_POST["customerId"]
            // );

            $authorization = 'autocredito-token: admin123456789';
            // $payload = json_encode($data);

            $url = Cliente::SendConfig("VerificationValidate");
            $ch = curl_init("$url".$_POST["customerId"]."/".$_POST["code"]);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            $response = curl_exec($ch);
            json_decode($response);

            curl_close($ch);
            
            echo $response;
    }

    static public function LoansRequest(){

      global $wpdb;
            $fields = json_decode(stripslashes($_POST["Fields"]), true);
            //Datos a Enviar
            $data = array (
                'Type'=>  $_POST["Type"],
                'Fields'=>  $fields,
                'Value'=> $_POST["Value"],
                'DocumentType'=> $_POST["DocumentType"],
                'DocumentDate'=> $_POST["DocumentDate"],
                'DocumentCityId'=> $_POST["DocumentCityId"],
                'DocumentStateId'=> $_POST["DocumentStateId"],
                'Document'=> $_POST["Document"],
                'DV'=> $_POST["DV"],
                'IsCompany'=> $_POST["IsCompany"],
                'Name'=> $_POST["Name"],
                'LastName'=> $_POST["LastName"],
                'LastName2'=> $_POST["LastName2"],
                'Gender'=> $_POST["Gender"],
                'BirthDay'=> $_POST["BirthDay"],
                'Address'=> $_POST["Address"],
                'Phone'=> $_POST["Phone"],
                'MobilePhone'=> $_POST["MobilePhone"],
                'Email'=> $_POST["Email"],
                'Status'=> $_POST["Status"],
                'Job'=> $_POST["Job"],
                'Income'=> $_POST["Income"]
            );
            // Convertir el arreglo $data a JSON para el log
            $jsonData = json_encode($data, JSON_PRETTY_PRINT);

            // Especificar la ruta del archivo de log
            $logFile = "payloads.log";

            // Registrar la solicitud
            $logEntry = date("Y-m-d H:i:s") . " - Request: " . $jsonData . "\n";
            file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

            $authorization = 'autocredito-token: admin123456789';
            $payload = json_encode($data);

            $url = Cliente::SendConfig("LoansRequest");
            $ch = curl_init("$url");
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            $response = curl_exec($ch);
            json_decode($response);

            curl_close($ch);
            
            echo $response;
    }

    /*=============================================
    CONSULTA CONFIG
    =============================================*/
    static public function SendConfig($dato){

        $response = ModeloConfig::mdlMostrarConfiguraciones($dato);

        if(!$response) {
            //return false;
            return $response;
        }else{
            //return $response;
            return $response;
        }

    }

    /*=============================================
    CONSULTA STATES
    =============================================*/
    static public function GetStates(){

      $response = ModeloCities::mdlMostrarStates($_POST["name"]);

      if(!$response) {
          //return false;
          return $response;
      }else{
          //return $response;
          echo json_encode($response);
      }

    }

    /*=============================================
    CONSULTA CITIES
    =============================================*/
    static public function GetCities(){

      $response = ModeloCities::mdlMostrarCities($_POST["name"], $_POST["id_state"]);

      if(!$response) {
          //return false;
          return $response;
      }else{
          //return $response;
          echo json_encode($response);
      }

    }

    /*=============================================
    CONSULTA CITIES
    =============================================*/
    static public function GetBrands(){

      $response = ModeloCities::mdlMostrarMarcas();

      if(!$response) {
          //return false;
          return $response;
      }else{
          //return $response;
          echo json_encode($response);
      }

    }

     /*=============================================
    CONSULTA CITIES
    =============================================*/
    static public function GetModel(){

      $response = ModeloCities::mdlMostrarModelos($_POST["name"], $_POST["brand"]);

      if(!$response) {
          //return false;
          return $response;
      }else{
          //return $response;
          echo json_encode($response);
      }

    }
    

}



/*=============================================
RECIBIR DATOS
=============================================*/	
if(isset($_POST["code"])){
  Cliente::VerificationValidate();
}
if(isset($_POST["phoneNumber"])){
  Cliente::VerificationSend();
}
if(isset($_POST["DocumentType"])){
  Cliente::LoansRequest();
}
if(isset($_POST["states"])){
  Cliente::GetStates();
}
if(isset($_POST["cities"])){
  Cliente::GetCities();
}
if(isset($_POST["brands"])){
  Cliente::GetBrands();
}
if(isset($_POST["models"])){
  Cliente::GetModel();
}

