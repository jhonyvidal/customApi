<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal</title>
</head>
<body>

<!-- <button id="openModalBtn">Abrir Modal</button> -->

<div id="myModal" class="modal" style="z-index: 999;">
  <form id="validateCode">
    <div class="modal-content" style="text-align: center; border-radius: 20px;">
      <span class="close" id="closeModalBtn">&times;</span>
      <br/>
      <div id="countdown" style="margin-bottom:15px"></div>
      <div class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-tel elementor-col-100 elementor-field-required">
        <input size="1" type="number" name="form_fields[tel]" id="form-field-code" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Ingresa el Código" required="required" aria-required="true" pattern="[0-9()#&amp;+*-=.]+" title="Only numbers and phone characters (#, -, *, etc) are accepted." aria-invalid="false">
      </div>
      <div id="myModalErrror" style="color:red; margin-top:15px">

      </div>
      <div id="myModalSuccess" style="color:green; margin-top:15px">

      </div>
      <div class="">
        <button type="submit" class="" id="ValidarCodigo" style="margin-top: 20px;border-radius: 20px;">
          <span><span class="elementor-align-icon-right elementor-button-icon">
                <i aria-hidden="true" class="far fa-arrow-alt-circle-up"></i>																	</span>
              <span class="elementor-button-text">Validar</span>
          </span>
        </button>
      </div>
    </div>
  </form>
</div>



</body>
</html>
