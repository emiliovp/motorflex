<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar cita</title>
<meta name="description" content="#"/>
<meta name="author" content="#">
<link rel="shortcut icon" href="#" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
    
    <script>
function myFunction() {
  document.getElementById("#contact-form").submit();
    
    var nom = $('#nombre').val();
     var ap  = $('#apellido').val();
     var mail = $('#email').val();
     var tele = $('#tel').val();
     var mar = $('#marca').val();
     var mod = $('#modelo').val();
     var mat = $('#placas').val();
     var fec = $('#usr1').val();
     var observaciones = $('#observ').val();
    
}
</script>
    
    
<script type="text/javascript">
    
    
    
    
    
    
    
$(document).ready(function(){
    

    $("#contact-form").validate({
        event: "blur",rules: {'name': "required",'email': "required email",'message': "required", 'placas': "required", 'marca': "required" },
        messages: {'name': "Por favor indica tu nombre",'email': "Por favor, indica una direcci&oacute;n de e-mail v&aacute;lida",'message': "Por favor, dime algo!", 'placas': "Por favor, ingresa tus placas", 'marca': "Por favor, proporciona la marca" },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            $("#alert").show();
            $("#alert").html("<img src='images/ajax-loader.gif' style='vertical-align:middle;margin:0 10px 0 0' /><strong>Enviando mensaje...</strong>");
            setTimeout(function() {
                $('#alert').fadeOut('slow');
            }, 5000);
            $.ajax({
                type: "POST",
                url:"inc/cita.php",
                  data:{nombre: nom, apellido: ap, correo:mail, telefono:tele, marca:mar, modelo:mod, matricula:mat, fecha:fec, observa:observaciones},           
                     success: function(msg){
                    $("#alert").html(msg);
                    document.getElementById("nombre").val();
                    document.getElementById("email").val();
                    document.getElementById("observ").val();
                    document.getElementById("placas").val();
                     document.getElementById("marca").val();
                    setTimeout(function() {
                        $('#alert').fadeOut('slow');
                    }, 5000);

                }
            });
        }
    });
});
    
    
    
    
    
</script>
</head>
<body>

    
    
    
<div class="container">
    <h1>Registra tu cita</h1>
    <h2 class="lead">Escoge el dia de tu cita</h2>
    
    
    
    <div class="row">
        <div id="content" class="col-lg-12">
            <div class="alert alert-success" id="alert" style="display: none;">&nbsp;</div>
            <form id="contact-form" method="post" onsubmit="myFunction()">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="name" placeholder="Introduce tu nombre">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Introduce tu email">
                    <small id="emailHelp" class="form-text text-muted">Este email no sera utilizado para promociones ni envío de newsletter. La información no queda registrada.</small>
                </div>
                
                
                <div class="form-group">
                    <label for="name">Placas</label>
                    <input type="text" class="form-control" id="placas" name="placas" placeholder="Introduce tus placas">
                </div>
                
                
                 <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Escribe la marca de tu moto">
                </div>
                
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea class="form-control" id="observa" name="message" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <input class="btn btn-primary submit" type="submit" value="Enviar" onclick="myFunction()"/>
                    
                    
                    
               
                    
                </div>
            </form>
        </div>
    </div>
    
    
    
    

    
    
</div>
<footer class="footer bg-dark">
    <div class="container">
        <span class="text-muted"><a href="#">&copy; Motorflex/Sistema de Citas</a></span>
    </div>
</footer>
</body>
</html>
