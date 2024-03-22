jQuery(document).ready(function(){
    console.log("All sources are loaded")

    //Adicion de campos al select Tipo de documento
    // jQuery('#wpforms-964-field_17').append(jQuery('<option>', {
    //     value: 1,
    //     text: 'Cédula de ciudadanía'
    // }))

    // jQuery('#wpforms-964-field_17').append(jQuery('<option>', {
    //     value: 2,
    //     text: 'Cédula Extranjera'
    // }))

    // jQuery('#wpforms-964-field_17').append(jQuery('<option>', {
    //     value: 3,
    //     text: 'Pasaporte'
    // }))

    // jQuery('#wpforms-964-field_17').append(jQuery('<option>', {
    //     value: 4,
    //     text: 'Nit'
    // }))

    //Adicion de campos al select Genero
    // jQuery('#wpforms-964-field_21').append(jQuery('<option>', {
    //     value: 'M',
    //     text: 'Masculino'
    // }))

    // jQuery('#wpforms-964-field_21').append(jQuery('<option>', {
    //     value: 'F',
    //     text: 'Femenino'
    // }))

    // Obtener el dominio
    var dominio = window.location.hostname;

    // Obtener el protocolo (http o https)
    var protocolo = window.location.protocol;

    var JobSelect = "E";
    
    jQuery('input[type="radio"][name="wpforms[fields][127]"]').change(function(){
        var valorSeleccionado = jQuery(this).val();
        if(valorSeleccionado === "Empleado"){
            JobSelect = "E"
        }
        else if(valorSeleccionado === "Independiente"){
            JobSelect = "I"
        }
        else if(valorSeleccionado === "Pensionado"){
            JobSelect = "P"
        }
        else{
            JobSelect = "O"
        }

    });

    function getBrands(){
        var datos = new FormData();
            datos.append("brands",true);
        
            const response = jQuery.ajax({
                url: ajaxConsultaApi.url,
                method: "POST",
                data:datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(res){
                    console.log(res);
                    res.forEach((element) => 
                        jQuery('#wpforms-964-field_144').append(jQuery('<option>', {
                            value: element.id,
                            text:  element.brand
                        }))
                    )
                },
                error:function(err){
                    console.log(err);
                },
            })
    }
    getBrands();

    //Adicionar boton del submit
    jQuery(".wpforms-submit-container").html('<div class="wpforms-clear"><button id="submitCustom" type="submit" style="height: var(--wpforms-button-size-height); padding-top: 15px; background-color: #3ECBC3 !important;border-radius: 50px !important;padding-right: 30px !important;padding-left: 30px !important;" data-action="next" data-page="1" data-formid="964" aria-disabled="false" aria-describedby="">Solicitar</button></div>');

    // Manejo del evento de envío del formulario
    jQuery('#wpforms-form-964').on('submit', function(event) {
        // Previene el comportamiento predeterminado de envío del formulario
        event.preventDefault();
        console.log("Start Event");

        jQuery('#submitCustom').prop('disabled', true);
        jQuery('#formError').remove();
        const id = jQuery("#wpforms-964-field_18").val()
        const phoneNumber = jQuery("#wpforms-964-field_1").val()
        const email = jQuery("#wpforms-964-field_2").val()
        
        var datos = new FormData();
        datos.append("phoneNumber",phoneNumber );
        datos.append("customerId",id);
        datos.append("email",email);

        jQuery.ajax({
            url: ajaxConsultaApi.url,
            method: "POST",
            data:datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function(res){
                jQuery('#submitCustom').prop('disabled', false);
                if(res.Completed){
                    abrirModal();
                }else{
                    jQuery('#wpforms-form-964').append('<div id="formError" class="wpforms-clear" style="color:#ff00008a;margin-top: 10px;">Ha ocurrido un error</div>')
                }
                console.log(res);
            },
            error:function(err){
                jQuery('#submitCustom').prop('disabled', false);
                jQuery('#wpforms-form-964').append('<div id="formError" class="wpforms-clear" style="color:#ff00008a;margin-top: 10px;">Ha ocurrido un error</div>')
                console.log(err);
            },
        })

    });

    //Boton del modal
    jQuery('#validateCode').on('submit', function (event) {
        jQuery("#myModalErrror").html('')
        event.preventDefault();
        const id = jQuery("#wpforms-964-field_18").val()
        const Code = jQuery("#form-field-code").val()

        var datos = new FormData();
            datos.append("code",Code);
            datos.append("customerId",id);
        
            jQuery.ajax({
                url: ajaxConsultaApi.url,
                method: "POST",
                data:datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(res){
                    if(res.Completed){
                        sendForm()
                    }else{
                        jQuery("#myModalErrror").html("<p>El Token no es valido</p>")
                    }
                    console.log(res);
                },
                error:function(err){
                    jQuery("#myModalErrror").html("<p>El Token no es valido</p>")
                    console.log(err);
                },
            })

    });

    function convertirFormatoANumero(input) {
        // Elimina las comas
        var sinComas = input.replace(/,/g, '');
        // Convierte a número
        var numero = parseFloat(sinComas);
        return numero;
    }

    function sendForm(){

        const documentDateFormatt = jQuery("#wpforms-964-field_19-year").val() + '-' + jQuery("#wpforms-964-field_19-month").val()  + '-' + jQuery("#wpforms-964-field_19-day").val()  
        const birthdayFormatt = jQuery("#wpforms-964-field_23-year").val() + '-' + jQuery("#wpforms-964-field_23-month").val()  + '-' + jQuery("#wpforms-964-field_23-day").val()
    
        let  DocumentType
        switch(jQuery("#wpforms-964-field_17").val()){
            case "Cédula de ciudadanía" :
                DocumentType = 1
                break 
            case "Cédula Extranjera" :
                DocumentType = 2
                break 
            case "Pasaporte" :
                DocumentType = 3
                break 
            case "Nit" :
                DocumentType = 4
                break 
        }
    
        let  Gender
        switch(jQuery("#wpforms-964-field_21").val() ){
            case "Masculino" :
                Gender = "M"
                break 
            case "Femenino" :
                Gender = "F"
                break 
        }

        const Fields = {
            "ciudad_nacimiento":  jQuery("#wpforms-964-field_40-city").val() ,
            "estado_civil": jQuery("#wpforms-964-field_25").val() ,
            "nivel_estudios":  jQuery("#wpforms-964-field_26").val() ,
            "actividad_economica":  jQuery("#wpforms-964-field_31").val() ,
            "nombre_empresa" : jQuery("#wpforms-964-field_32").val() ,
            "nit_empresa": jQuery("#wpforms-964-field_33").val() ,
            "tiempo_laborado":  jQuery("#wpforms-964-field_56").val() ,
            "tipo_contrato":  jQuery("#wpforms-964-field_67").val() ,
            "nombre_ref_personal": jQuery("#wpforms-964-field_76").val() ,
            "telefono_ref_perso": jQuery("#wpforms-964-field_77").val() ,
            "nombre_ref_fami": jQuery("#wpforms-964-field_92").val() ,
            "tel_ref_famili": jQuery("#wpforms-964-field_93").val() ,
            "ingresos_add":  jQuery("#wpforms-964-field_133").val() ,
            "gastos_familiares": jQuery("#wpforms-964-field_135").val() ,
            "declara_renta": jQuery("#wpforms-964-field_58").val() ,
            "brand":  jQuery("#wpforms-964-field_144").val() ,
            "clase_vehiculo": jQuery("#wpforms-964-field_63").val() , 
            "Version": jQuery("#wpforms-964-field_63").val() ,
            "year": jQuery("#wpforms-964-field_64").val() ,
            "valor_vehiculo": convertirFormatoANumero(jQuery("#wpforms-964-field_131").val()),
            "cuota_inicial":  convertirFormatoANumero(jQuery("#wpforms-964-field_132").val()) 
        }

        const completedData = {
            Type: 14,
            Fields: Fields, 
            Value: convertirFormatoANumero(jQuery("#wpforms-964-field_131").val()) - convertirFormatoANumero(jQuery("#wpforms-964-field_132").val()),
            DocumentType: DocumentType,
            DocumentDate: documentDateFormatt,
            DocumentCityId: jQuery("#wpforms-964-field_40-state").attr('id_data'),
            DocumentStateId: jQuery("#wpforms-964-field_40-city").attr('id_data'),
            Document: jQuery("#wpforms-964-field_18").val(),
            DV: '',
            IsCompany: false,
            Name: jQuery("#wpforms-964-field_14").val(),
            LastName:  jQuery("#wpforms-964-field_15").val() ,
            LastName2: jQuery("#wpforms-964-field_16").val() ,
            Gender: Gender,
            BirthDay: birthdayFormatt,
            Address: jQuery("#wpforms-964-field_40").val(),
            Phone: jQuery("#wpforms-964-field_1").val() ,
            MobilePhone: jQuery("#wpforms-964-field_1").val(),
            Email: jQuery("#wpforms-964-field_2").val(),
            Status: true,
            Job:"E",
            Income: jQuery("#wpforms-964-field_133").val(),
            TipoIdentificacion: jQuery("#wpforms-964-field_17").val(),
            Genero:jQuery("#wpforms-964-field_21").val(),
            Estado:jQuery("#wpforms-964-field_40-city").val(),
            Ciudad:jQuery("#wpforms-964-field_40-state").val(),
        };
   
        const datosJSON = JSON.stringify(completedData);
        localStorage.setItem('formData', datosJSON)

        var datos = new FormData();
            datos.append("Type",completedData.Type);
            datos.append("Fields",JSON.stringify(Fields));
            datos.append("Value",completedData.Value);
            datos.append("DocumentType",completedData.DocumentType);
            datos.append("DocumentDate",completedData.DocumentDate);
            datos.append("DocumentCityId",completedData.DocumentCityId);
            datos.append("DocumentStateId",completedData.DocumentStateId);
            datos.append("Document",completedData.Document);
            datos.append("DV",completedData.DV);
            datos.append("IsCompany",completedData.IsCompany);
            datos.append("Name",completedData.Name);
            datos.append("LastName",completedData.LastName);
            datos.append("LastName2",completedData.LastName2);
            datos.append("Gender",completedData.Gender);
            datos.append("BirthDay",completedData.BirthDay);
            datos.append("Address",completedData.Address);
            datos.append("Phone",completedData.Phone);
            datos.append("MobilePhone",completedData.MobilePhone);
            datos.append("Email",completedData.Email);
            datos.append("Status",completedData.Status);
            datos.append("Job",completedData.Job);
            datos.append("Income",completedData.Income);
        
            jQuery.ajax({
                url: ajaxConsultaApi.url,
                method: "POST",
                data:datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(res){
                    if(res.Completed && res.StatusCode === 200){
                        jQuery("#myModalSuccess").html("<p>Tu solicitud fue enviada con exito</p>")
                        setTimeout(function(){
                            createTable();
                        }, 3000); 
                        window.location.href =  protocolo + "//" + dominio + "/gracias";
                    }else{
                        jQuery("#myModalErrror").html("<p>Ha occurrido un error</p>")
                    }
                    console.log(res);
                },
                error:function(err){
                    console.log(err);
                    jQuery("#myModalErrror").html("<p>Ha occurrido un error</p>")
                },
            })
    }

    function createTable(){
        
        var store =  localStorage.getItem('formData')
        const data = JSON.parse(store);

        var thStyles = "text-align: left; width:200px";

        var tablaHtml = '<table border="1" style="font-size: 15px; border-radius: 20px;">';
            tablaHtml += '<tr><th style="' + thStyles + '">Correo</th><td>' +data.Email+ '</td>';
            tablaHtml += '<th style="' + thStyles + '">Telefono</th><td>'  + data.MobilePhone + '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Nombre</th><td>' + data.Name +'</td>';
            tablaHtml += '<th style="' + thStyles + '">Primer Apellido</th><td>'+ data.LastName + '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Segundo Apellido</th><td>' + data.LastName2 +  '</td>';
            tablaHtml += '<th style="' + thStyles + '">Tipo de Identificación</th><td>' + data.TipoIdentificacion + '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Identificación</th><td>' + data.Document + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Fecha Documento</th><td>' + data.DocumentDate + '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Genero</th><td>' + data.Genero + '</td>';
            tablaHtml += '<th  style="' + thStyles + '">Fecha Nacimiento</th><td>' + data.BirthDay + '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Dirección</th><td>' + data.Address +  '</td>';
            tablaHtml += '<th style="' + thStyles + '">Estado</th><td>' + data.Estado + '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Ciudad</th><td>' + data.Ciudad + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Estado Civil</th><td>' + data.Fields.estado_civil +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Nivel de Estudios</th><td>' + data.Fields.nivel_estudios + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Actividad Economica</th><td>' + data.Fields.actividad_economica +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Nit Empresa</th><td>' + data.Fields.nit_empresa + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Nombre Empresa</th><td>' + data.Fields.nombre_empresa +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Tiempo Laborado</th><td>' + data.Fields.tiempo_laborado + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Tipo Contrato</th><td>' + data.Fields.tipo_contrato +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Referencia Personal</th><td>' + data.Fields.nombre_ref_personal + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Número Referencia</th><td>' + data.Fields.telefono_ref_perso +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Referencia Familiar</th><td>' + data.Fields.nombre_ref_fami + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Número Referencia</th><td>' + data.Fields.tel_ref_famili +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Ingresos</th><td>' + data.Fields.ingresos_add + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Gastos</th><td>' + data.Fields.gastos_familiares +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Declara Renta</th><td>' + data.Fields.declara_renta + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Marca Vehiculo</th><td>' + data.Fields.brand +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Tipo Vehiculo</th><td>' + data.Fields.clase_vehiculo + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Serie Vehiculo</th><td>' + data.Fields.Version +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Modelo Vehiculo</th><td>' + data.Fields.year + '</td>';
            tablaHtml += '<th style="' + thStyles + '">Valor Vehiculo</th><td>' + data.Fields.valor_vehiculo +  '</td></tr>';
            tablaHtml += '<tr><th style="' + thStyles + '">Cuota Inicial</th><td>' + data.Fields.cuota_inicial + '</td>';
            tablaHtml += '<th style="' + thStyles + '"></th><td></td></tr>';
            tablaHtml += '</table>';

        jQuery("#resultTable").html(tablaHtml);
    }

    // INICIO MODAL CODE
    var modal = document.getElementById('myModal');

    // Obtener el botón para cerrar el modal
    var closeModalBtn = document.getElementById('closeModalBtn');
    
    // Asignar un evento de clic al botón para cerrar el modal
    closeModalBtn.onclick = function() {
        modal.style.display = 'none';
    };

    jQuery('#openModalBtn').on('click', function (event) {
        console.log("si se genero el evento")
        abrirModal();
    })
    
    // Función para abrir el modal
    function abrirModal() {
        modal.style.display = 'block';
        // Reiniciar la fecha de finalización a 5 minutos desde ahora cada vez que se abre el modal
        countDownDate = new Date().getTime() + 5 * 60 * 1000;
        
        // Reiniciar el contador si ya estaba corriendo
        clearInterval(x);
        iniciarContador(); 
        jQuery("#myModalErrror").html("")
        jQuery("#myModalSuccess").html("")
        jQuery("#resultModal").hide();
        jQuery("#validateCode").show()
    }  
    // FIN MODAL CODE


    // Actualizar el contador cada segundo
    function iniciarContador() {
        x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
    
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
            document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";
    
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "¡Tiempo agotado!";
                setTimeout(function(){
                    modal.style.display = 'none'; 
                }, 3000);
            }
        }, 1000);
    }

    // Variable para mantener el intervalo
    var x;

    // Establecer la fecha de finalización inicial (esto se reiniciará cuando se abra el modal)
    var countDownDate = new Date().getTime() + 5 * 60 * 1000;

    //INICIO AUTOCOMPLETE CODE
    function autocomplete(inp, type) {
    var a, b, i, val;
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    var timeoutId;

    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        val = this.value;

        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
    
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
    
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
    
    });

    inp.addEventListener("change", function(e) {
        if(jQuery("#wpforms-964-field_63").attr("id_data") === undefined || jQuery("#wpforms-964-field_63").attr("id_data") === ''){
            jQuery("#wpforms-964-field_63").val('');
        }
        if(jQuery("#wpforms-964-field_40-state").attr("id_data") === undefined || jQuery("#wpforms-964-field_40-state").attr("id_data") === ''){
            jQuery("#wpforms-964-field_40-state").val('');
        }
        if(jQuery("#wpforms-964-field_40-city").attr("id_data") === undefined || jQuery("#wpforms-964-field_40-city").attr("id_data") === ''){
            jQuery("#wpforms-964-field_40-city").val('');
        }
        
    });

    inp.addEventListener("keyup", function(e) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(async function(){
            if(type === "states"){
                arr = await getStates(val)
                console.log('arreglo'+arr)
            }
            if(type === "cities"){
                arr = await getCities(val)
                console.log('arreglo'+arr)
            }
            if(type === "models"){
                arr = await getModels(val)
                console.log('arreglo'+arr)
            }
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
    
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
    
                /*Styles for result select*/
                b.style.fontFamily = "Roboto, Sans-serif";
                b.style.fontSize = "16px";
                b.style.fontWeight = "700";
    
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].name.substr(val.length);
        
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' id_data='" + arr[i].id + "' value='" + arr[i].name + "'>";
        
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
        
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;

                    // Obtiene el valor del atributo id_data
                    var idDataValue = this.getElementsByTagName("input")[0].getAttribute("id_data");
                    inp.setAttribute("id_data", idDataValue);

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
                }
            }
        }, 1000);
    });
    
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
    
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
    
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
    
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
    
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
    
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
    
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
            }
        }
    });

    function getStates(name){
        var datos = new FormData();
            datos.append("states",true);
            datos.append("name",name);
        
            const response = jQuery.ajax({
                url: ajaxConsultaApi.url,
                method: "POST",
                data:datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(res){
                    return res.data
                    console.log(res);
                },
                error:function(err){
                    console.log(err);
                },
            })
            return response;
    }

    function getCities(name){
        const state = jQuery("#wpforms-964-field_40-city").attr('id_data');
        var datos = new FormData();
            datos.append("cities",true);
            datos.append("name",name);
            datos.append("id_state",state);
        
            const response = jQuery.ajax({
                url: ajaxConsultaApi.url,
                method: "POST",
                data:datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(res){
                    console.log(res);
                    return res.data
                },
                error:function(err){
                    console.log(err);
                },
            })
            return response;
    }

    function getModels(name){
        const brand = jQuery("#wpforms-964-field_144 option:selected").text();
        var datos = new FormData();
            datos.append("models",true);
            datos.append("name",name);
            datos.append("brand",brand);
        
            const response = jQuery.ajax({
                url: ajaxConsultaApi.url,
                method: "POST",
                data:datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(res){
                    console.log(res);
                    return res.data
                },
                error:function(err){
                    console.log(err);
                },
            })
            return response;
    }
    
    function addActive(x) {
    
        /*a function to classify an item as "active":*/
        if (!x) return false;
    
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
    
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    
    function removeActive(x) {
    
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
        }
    }
    
    function closeAllLists(elmnt) {
    
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
        }
        }
    }
    
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
    }
    
    /*An array containing all the programming class names*/
    var classes = ["Audi","BMW","BYD","Chevrolet","Citroen"];
    
    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("wpforms-964-field_40-state"), 'cities');
    autocomplete(document.getElementById("wpforms-964-field_40-city"), 'states');
    autocomplete(document.getElementById("wpforms-964-field_63"), 'models');
    //FIN AUTOCOMPLETE CODE

    //MODAL TERM AND CONDITIONS
    jQuery('#wpforms-964-field_4_1').change(function() {
        if (jQuery(this).is(':checked')) {
            openTermModal()
        } else {
            console.log('El checkbox no está marcado.');
        }
    });

    var termModal = document.getElementById('TermModal');

    var closeTermModalBtn = document.getElementById('closeTermModalBtn');
    
    closeTermModalBtn.onclick = function() {
        termModal.style.display = 'none';
    };
    
    function openTermModal() {
       
        var url = protocolo + "//" + dominio +"/politica"

        jQuery('#IframeTerm').html('<iframe src="'+url+'" width="600" height="500" style="margin-top:20px"></iframe>')
        termModal.style.display = 'block';
    }  
    //MODAL TERM AND CONDITIONS

});

