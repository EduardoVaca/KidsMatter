$(document).ready(function(){

  $("#buscar").click(getChildByName);

});


function getChildByName(){

  var nombre = $("#nombreBusqueda").val();

  $.post("../Controladores/getInfo.php", {
      action: "getChildrenTableByName",
      nombreChild: "%" + nombre + "%"
  },
  function(data){
    alert(data);
    $('#kidsFound').append(data);
  });
}
