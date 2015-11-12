$(document).ready(function(){
     $.post('../Controladores/MenuSU.php', function(data){
      $('#tarjetas').append(data);
     })
});
