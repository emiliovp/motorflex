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
    var rep = $('#nreporte').val();
     //alert(rep);
     
     $.ajax({
            url:'inc/buscareporte.php',
            type:'POST',
            dataType:'html',    
           data:{numreporte: rep},
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
        var msgClasses = "h3";
    } else {
        var msgClasses = "h3";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
