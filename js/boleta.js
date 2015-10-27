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
    $('#kidsFound').html(data);
    $('.modal-trigger').leanModal();
  });
}

function printId(myId){
  alert("id: " + myId);
  $('#secret').html(myId);
}
