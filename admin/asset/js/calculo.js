$(function(){
    
    $('#refaccionesact').on('input', function() {
      calculate();
    });
    $('#TotalRefacciones').on('input', function() {
     calculate();
    });
    function calculate(){
        var pPos = parseInt($('#refaccionesact').val()); 
        var pEarned = parseInt($('#TotalRefacciones').val());
        var perc="";
        if(isNaN(pPos) || isNaN(pEarned)){
            perc=" ";
           }else{
           perc = ((pEarned/pPos) * 100).toFixed(0);
           }
        
        $('#RefaccionesDispoiblesPorcentaje').val(perc);
    }

});
    