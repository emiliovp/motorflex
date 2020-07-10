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
    var rep = $('#reporte').val();
     //var feci  = $('#fecini').val();
       var val = $('input:radio[name=valuacion]:checked').val();  
       var pres = $('input:radio[name=presupuesto]:checked').val();
       var presAc = $('input:radio[name=presupuestoAc]:checked').val();
       var refacc = $('input:radio[name=refacciones]:checked').val();
       //var porRefac = $('#porrefacciones').val();    
       var porRepa = $('#porreparacion').val();    
       var ram = $('input:radio[name=rampa]:checked').val();
     //var dedu = $('input:radio[name=deducible]:checked').val();     
        var monto = $('#montodedu').val();    
        var fecf = $('#fecfin').val();
        var totRefacc = $('#totrefacciones').val();  
        var dispRefacc = $('#disprefacciones').val(); 
        //alert(rep + val + pres + presAc + refacc + porRefac + porRepa + ram + monto + fecf);
     
     $.ajax({
            url:'inc/actualizaReporte.php',
            type:'POST',
            dataType:'html',
            data:{numreporte: rep, valuacion:val,presupuesto:pres,presupuestoAc:presAc,refacciones:refacc,porReparacion:porRepa,rampa:ram, monto:monto, fecfin:fecf, totalRefacciones:totRefacc, dispoRefacciones:dispRefacc},
             //data:{numreporte: rep, valuacion:val,presupuesto:pres,presupuestoAc:presAc,refacciones:refacc,porrefacciones:porRefac,porReparacion:porRepa,rampa:ram, monto:monto, fecfin:fecf},
            //data:{numreporte: rep, fecinicio: feci, deducible:dedu},
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
