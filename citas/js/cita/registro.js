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




