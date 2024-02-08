<?php
session_start();
require_once  ('../models/ConsultarModel.php');
require_once  ('../models/ConfigModel.php');
class Cliente
{
    static public function VerificationSend(){

      global $wpdb;
        
            //Datos a Enviar
            $data = array (
                'phoneNumber'=>  $_POST["phoneNumber"],
                'customerId'=> $_POST["customerId"],
                'email'=> $_POST["email"],
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
            $data = array (
                'code'=>  $_POST["code"],
                'customerId'=> $_POST["customerId"]
            );

            $authorization = 'autocredito-token: admin123456789';
            $payload = json_encode($data);

            $url = Cliente::SendConfig("VerificationValidate");
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

    static public function LoansRequest(){

      global $wpdb;
        
            //Datos a Enviar
            $data = array (
                'Type'=>  $_POST["Type"],
                'Fields'=> $_POST["Fields"],
                'Value'=> $_POST["v"],
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

