<?php
if($_GET["id"] != null){
    echo "
    <script>
    
    </script>
    ";
}
echo $_GET["id"];
function indexLinkPago() {

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
                    <h1 id="heading">PROCESO DE PAGO</h1>
                     
                    <form id="msform">

                        <!-- DATOS STEP 1 -->
                        <fieldset id="step1">

                               
                            <div class="form-card col-12 ">
                            
                                <fieldsetLogin id="step001">

                                        <div class="row col-12">
                                                
                                            <div class="col-12" style="margin-top:15px;">
                                                <input type="hidden" placeholder="Número de Guia" id="IdRemesa"  name="IdRemesa" required value="<?php echo $_GET["id"] ?>"></input>
                                                <input type="hidden" placeholder="Número de Guia" id="referencia"  name="referencia" required ></input>
                                                <input type="hidden" placeholder="Número de Guia" id="value"  name="value" required ></input>
                                            </div>
                                           
                                            <div class="row col-12"><br>
                                                                                        
                                                <div class="col-12" id="TablaConsulta">
                                                
                                                </div>

                                                <div class="col-12">
                                                    <input  style="margin-top:20px;"  type="button" name="pagarLink" class="pagarLink action-button  btBtn btnFilled btnAccentColor btnExtraSmall btnNormal btnIco" value="Pagar"/>
                                                </div>

                                            </div>
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