/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//numcitas
$(document).ready(function(){    
 $("#consulta").click(function(){
     //var nom = $('#nombre').val();
     //var ap  = $('#apellido').val();
     //var tele = $('#tel').val();
     //var mat = $('#placas').val();
    var fec = $('#usr1').val();
     //alert(nom + ap + tele + mat + fec);
     var test = '';
     
     $.ajax({
            url:'inc/gestorCitas.php',
            type:'POST',
            dataType:'html',    
            data:{fecha: fec},
            success: function(data){
                if (parseInt(data)==1){                    
                    // window.location.assign("index-basic.php")
                    $('#numcitas').html(data);
                }
                else{
                 $('#numcitas').html(data);
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
                                'startDate': '-5d'                                
			});
		});
		
		
$(document).ready(function(){    
 $("#disponibilidad").click(function(){
     //var nom = $('#nombre').val();
     //var ap  = $('#apellido').val();
     //var tele = $('#tel').val();
     //var mat = $('#placas').val();
    var citas = $('#numeroCitas').val();
     //alert(citas);
     //var test = '';
     
     $.ajax({
            url:'inc/cambioDisponibilidad.php',
            type:'POST',
            dataType:'html',    
            data:{numcitas: citas},
            success: function(data){
                if (parseInt(data)==1){                    
                    // window.location.assign("index-basic.php")
                    $('#cambioCitas').html(data);
                }
                else{
                 $('#cambioCitas').html(data);
            }
        }
   }) ;
   });
})
