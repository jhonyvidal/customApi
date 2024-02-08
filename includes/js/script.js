jQuery(document).ready(function(){

    // Manejo del evento de envío del formulario
    jQuery('.elementor-form').on('submit', function (event) {
        // Previene el comportamiento predeterminado de envío del formulario
        event.preventDefault();

        const id = jQuery("#form-field-identifacion").val()
        const phoneNumber = jQuery("#form-field-tel").val()
        const email = jQuery("#form-field-email").val()
        
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
                if(res.Completed){
                    abrirModal();
                }
                console.log(res);
            },
            error:function(err){
                console.log(err);
            },
        })

    });

    jQuery('#validateCode').on('submit', function (event) {
        jQuery("#myModalErrror").html('')
        event.preventDefault();
        const id = jQuery("#form-field-identifacion").val()
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

    function sendForm(){

        const Type = 14 //pending ask (Dont exist)
        const Fields = {} //pending ask (Dont exist)
        const Value = 2.0 //peding ask  (Dont exist)
        const DocumentType = 3 //peding ask  (Dont exist)
        const DocumentDate = jQuery("#form-field-fechaexp").val()
        const DocumentCityId = 5 //peding ask (form is string)
        const DocumentStateId = 6  //peding ask (Dont exist)
        const Document = jQuery("#form-field-identifacion").val()
        const DV = ''  //peding ask (Dont exist)
        const IsCompany = true  //peding ask (Dont exist)
        const Name = jQuery("#form-field-nombre").val() 
        const LastName = jQuery("#form-field-prapellido").val() 
        const LastName2 = jQuery("#form-field-segapellido").val() 
        const Gender = 'H' //jQuery("#form-field-genero").val() (this field is long string dont merge)
        const BirthDay = jQuery("#form-field-fechanacimiento").val() 
        const Address = ''  //peding ask (Dont exist)
        const Phone = ''  //peding ask (Dont exist)
        const MobilePhone = jQuery("#form-field-tel").val() 
        const Email = jQuery("#form-field-email").val() 
        const Status = true //peding ask (Dont exist)
        const Job = 'E'//jQuery("#form-field-actividad").val() 
        const Income = jQuery("#form-field-ingresos").val() 

        // form-field-estadocivil
        // form-field-tipodevivienda         

        var datos = new FormData();
            datos.append("Type",Type);
            datos.append("Fields",Fields);
            datos.append("Value",Value);
            datos.append("DocumentType",DocumentType);
            datos.append("DocumentDate",DocumentDate);
            datos.append("DocumentCityId",DocumentCityId);
            datos.append("DocumentStateId",DocumentStateId);
            datos.append("Document",Document);
            datos.append("DV",DV);
            datos.append("IsCompany",IsCompany);
            datos.append("Name",Name);
            datos.append("LastName",LastName);
            datos.append("LastName2",LastName2);
            datos.append("Gender",Gender);
            datos.append("BirthDay",BirthDay);
            datos.append("Address",Address);
            datos.append("Phone",Phone);
            datos.append("MobilePhone",MobilePhone);
            datos.append("Email",Email);
            datos.append("Status",Status);
            datos.append("Job",Job);
            datos.append("Income",Income);
        
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
                        jQuery("#myModalSuccess").html("<p>Tu solicitud fue enviada con exito</p>")
                        setTimeout(function(){
                            modal.style.display = 'none';  
                        }, 3000);
                        
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

    // INICIO MODAL CODE
    var modal = document.getElementById('myModal');

    // Obtener el botón para cerrar el modal
    var closeModalBtn = document.getElementById('closeModalBtn');
    
    // Asignar un evento de clic al botón para cerrar el modal
    closeModalBtn.onclick = function() {
        modal.style.display = 'none';
    };

    // Función para abrir el modal
    function abrirModal() {
        modal.style.display = 'block';
    }  

    
    // FIN MODAL CODE
    
    // Establecer la fecha de finalización (5 minutos desde ahora)
    var countDownDate = new Date().getTime() + 5 * 60 * 1000;

    // Actualizar el contador cada segundo
    var x = setInterval(function() {
        // Obtener la fecha y hora actuales
        var now = new Date().getTime();

        // Calcular la diferencia entre la fecha de finalización y la fecha actual
        var distance = countDownDate - now;

        // Calcular minutos y segundos restantes
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Mostrar el contador en un elemento HTML
        document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";

        // Si el contador llega a cero, mostrar un mensaje
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "¡Tiempo agotado!";
        }
    }, 1000); // Intervalo de actualización cada segundo

});

