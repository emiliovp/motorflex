$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "¿Llenaste bien tus datos?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});






function submitForm(){
    // Initiate Variables With Form Content
     var reporte=$('#nreporte').val();
     var feci  = $('#fecingreso').val();
     var estatus  = $('#estatus').val();
     var caracteristicas  = $('#caracteristicas').val();
     var serie  = $('#serie').val();
     var motor  = $('#motor').val();
     var placas  = $('#placas').val();
     var nombre  = $('#nombre').val();
     var papellido  = $('#papellido').val();
     var sapellido  = $('#sapellido').val();
     var tel  = $('#tel').val();
     var correo  = $('#correo').val();
     var rfc  = $('#rfc').val();
     var estado  = $('#estado').val();
     var ciudad  = $('#ciudad').val();
     var alcmun  = $('#alcmun').val();
     var cp  = $('#cp').val();
     var colonia  = $('#colonia').val();
     var calle  = $('#calle').val();
     var numero  = $('#numero').val();
     var marca = document.getElementById("marca").value;  
       
     //alert(marca);
     //alert(feci + estatus + caracteristicas + serie + motor + placas + nombre + papellido + sapellido + tel + correo + rfc + estado + ciudad + alcmun + cp + colonia + calle + numero);
     
     $.ajax({
            url:'inc/getOrden.php',
            type:'POST',
            dataType:'html',    
             data:{reporte:reporte,fechaingreso: feci, estatus: estatus, caracteristicas:caracteristicas,serie:serie,motor:motor,
                placas:placas,nombre:nombre,papellido:papellido,sapellido:sapellido, tel:tel, correo:correo, rfc:rfc
                ,estado:estado,ciudad:ciudad,alcmun:alcmun,cp:cp,colonia:colonia,calle:calle,numero:numero,marca:marca},            
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}







function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
