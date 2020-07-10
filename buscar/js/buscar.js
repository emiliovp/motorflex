/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){    
 $("#buscar").click(function(){
     var rep = $('#nreporte').val();
     //alert(rep);
     
     $.ajax({
            url:'inc/buscareporte.php',
            type:'POST',
            dataType:'html',    
            //data:{numreporte: rep, fecinicio: feci, valuacion:val,presupuesto:pres,presupuestoAc:presAc,refacciones:refacc,porrefacciones:porRefac,porReparacion:porRepa,rampa:ram, deducible:dedu, monto:monto, fecfin:fecf},
            data:{numreporte: rep},
            success: function(data){
                if (parseInt(data)==1){                    
                    // window.location.assign("index-basic.php")
                    $('#resultado').html(data);
                }
                else{
                 $('#resultado').html(data);
            }
        }
   }) ;
   });
})


$(document).ready(function(){    
 $("#actualiza").click(function(){
     var rep = $('#reporte').val();
     //var feci  = $('#fecini').val();
       var val = $('input:radio[name=valuacion]:checked').val();  
       var pres = $('input:radio[name=presupuesto]:checked').val();
       var presAc = $('input:radio[name=presupuestoAc]:checked').val();
       var refacc = $('input:radio[name=refacciones]:checked').val();
       var porRefac = $('#porrefacciones').val();    
       var porRepa = $('#porreparacion').val();    
       var ram = $('input:radio[name=rampa]:checked').val();
     //var dedu = $('input:radio[name=deducible]:checked').val();     
        var monto = $('#montodedu').val();    
        var fecf = $('#fecfin').val();
        //alert(rep + val + pres + presAc + refacc + porRefac + porRepa + ram + monto + fecf);
     
     $.ajax({
           url:'inc/actualizaReporte.php',
            type:'POST',
            dataType:'html',    
            data:{numreporte: rep, valuacion:val,presupuesto:pres,presupuestoAc:presAc,refacciones:refacc,porrefacciones:porRefac,porReparacion:porRepa,rampa:ram, monto:monto, fecfin:fecf},
            //data:{numreporte: rep, fecinicio: feci, deducible:dedu},
            success: function(data){
                if (parseInt(data)==1){                    
                    // window.location.assign("index-basic.php")
                    $('#resultado').html(data);
                }
                else{
                 $('#resultado').html(data);
            }
        }
   }) ;
   });
})