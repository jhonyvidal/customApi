<?php
function indexRemesas() {

        // $url = wpept_plugin_url('includes/ConsultaController.php');

?>
    <!-- =============================================
       BOOTSTRAP
    ============================================= -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
   
    <!-- =============================================
       SELECT 2
    ============================================= -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- =============================================
        WOMPI
    ============================================= -->
    <script type="text/javascript" src="https://checkout.wompi.co/widget.js"></script>

    <!-- =============================================
        SWEET ALERT 2
    ============================================= -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<body class="container">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2" style="margin-top:80px !important;">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h1 id="heading">CONSULTA TU GUIA</h1>
                    <p style="font-size:15px;">Llenar todos los campos obligatorios</p></br></br>
                     
                    <form id="msform">

                        <!-- DATOS STEP 1 -->
                        <fieldset id="step1">

                                <fieldsetLogin >
                                    <div class="form-card col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <h1 id="titleStep1">Bienvenido al Servicio Pago de Guia</h1><br><br>
                                        <h3 id="contentStep1">Ahora Puedes realizar tus pagos en línea</h3><br>
                                        <div class="col-12"> <img  style="height:300px" src="../wp-content/plugins/TPRemesas/src/Ecommerce.jpg" class="fit-image"> </div>
                                    </div>    
                                </fieldsetLogin>

                            <div class="form-card col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            
                                <fieldsetLogin id="step001">
                                        <h1>CONSULTA TU GUIA</h1>
                                        <div class="row col-12">
                                                
                                            <div class="col-12" style="margin-top:15px;">
                                                <input type="text" placeholder="Número de Guia" id="Guia"  name="Guia" maxlength="15" required style="text-transform: uppercase;"></input>
                                            </div>
                                           

                                            <div class="col-12 "><br>
                                                <div style="text-align:center;" id="loading" name="loading" class="col-lg-12">
                                                </div>
                                            </div>

                                            <div class="col-12 hidden" id="Error" style="font-size: 16px;color: red;">
                                            
                                            </div>
                                            <div class="col-12">
                                                <input  style="margin-top:20px;"  type="button" name="consultarGuia" class="consultarGuia action-button  btBtn btnFilled btnAccentColor btnExtraSmall btnNormal btnIco" value="Crear Link de Pago"/>
                                            </div>
                                        </div>

                                </fieldsetLogin>

                                <fieldsetLogin id="step002">
                                        <h1>GUIAS PENDIENTES POR PAGAR</h1>
                                        <div class="row col-12"><br>
                                                                                       
                                            <div class="col-12" id="TablaConsulta">
                                            
                                            </div>

                                            <div class="col-4">
                                                <input  style="margin-top:20px;"  type="button"  class="atras action-button  btBtn btnFilled  btnExtraSmall btnNormal btnIco" value="Atras"/>
                                            </div>
                                            <div class="col-4">
                                                <input  style="margin-top:20px;"  type="button" name="link" class="link action-button  btBtn btnFilled btnAccentColor btnExtraSmall btnNormal btnIco" value="Copiar Link"/>
                                            </div>

                                            <!-- <div class="col-4">
                                                <input  style="margin-top:20px;"  type="button" name="pagar" class="pagar action-button  btBtn btnFilled btnAccentColor btnExtraSmall btnNormal btnIco" value="Pagar"/>
                                            </div> -->

                                        </div>
                                </fieldsetLogin>

                                <fieldsetLogin id="step003">
                                    <h1>RESULTADOS TRANSACCIÓN</h1>
                                        <div class="row col-12">
                                            <div class="col-12 hidden" id="result">
                                                
                                            </div>
                                            <div class="col-12 "><br>
                                                <div style="text-align:center;" id="loading3" name="loading3" class="col-lg-12">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input  style="margin-top:20px;"  type="button" name="consultar" class="Menu action-button  btBtn btnFilled btnAccentColor btnExtraSmall btnNormal btnIco" value="Pagar otra Factura"/>
                                            </div>
                                        </div>
                                </fieldsetLogin>

                            </div>
                        </fieldset>

                        <input type="hidden" id="session" value="<?php echo $sesion; ?>"></input>
                        <input type="hidden" id="codigoCliente" value="<?php echo $codigoCliente; ?>"></input>
                        <input type="hidden" id="IdCliente"  name="IdCliente" value="<?php echo $sesion ?>" required></input>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<?php

}
?>