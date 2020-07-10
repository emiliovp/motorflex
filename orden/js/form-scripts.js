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
    var nom = $('#nombre').val();
     var ap  = $('#apellido').val();
     var mail = $('#email').val();
     var tele = $('#tel').val();
     var mar = $('#marca').val();
     var mod = $('#modelo').val();
     var mat = $('#placas').val();
     var fec = $('#usr1').val();
     var observaciones = $('#observ').val();
     //alert('zokete');
     //alert(nom + ap +mail + tele +mar +mod + mat + fec + observaciones);
     
     $.ajax({
            url:'inc/cita.php',
            type:'POST',
            dataType:'html',    
            data:{nombre: nom, apellido: ap, correo:mail, telefono:tele, marca:mar, modelo:mod, matricula:mat, fecha:fec, observa:observaciones},
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
