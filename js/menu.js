$(document).ready(function(){
   $('#SU').click(function(){
       $.post('../Controladores/MenuSU.php', function(data){
        $('#tarjetas').append(data);
       })
   });
});