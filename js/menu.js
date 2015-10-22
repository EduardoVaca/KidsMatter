$(document).ready(function(){
   $('#SU').click(function(){
       alert("entra");
       $.post("MenuSU.php", function(data){
        $('#tarjetas').append(data);
       })
        .done(function(){
            alert("done");
        })
        .fail(function(){
            alert("fail");
        })
       alert("entra");
   });
});