/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){    
 $("#enviar").click(function(){
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
            success: function(data){
                if (parseInt(data)==1){                    
                    
                    $('#resultado').html(data);
                }
                else{
                 $('#resultado').html(data);
            }
        }
   }) ;
   });
})

$(function() {
			$('.dates #usr1').datepicker({
				'format': 'yyyy-mm-dd',
				'autoclose': true,
                                'language': "es",
                                'startDate': '+1d'                                
			});
		});



$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='citas']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      nombre: "required",
      placas: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      Nombre: "Ingresa tu nombre",
      placas: "Ingresa tus placas",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
