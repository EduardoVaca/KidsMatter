$(document).ready(function(){
   $('#SU').click(function(){
       $.post("MenuSU.php", function(data){
        $('#tarjetas').append(data);
       })
   });
});