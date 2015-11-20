$(document).ready(function(){
  getChildrenTable();
});

function getChildrenTable(){
  $.post(
    "../Controladores/getInfo.php",
    {
      action: "getChildrenTable"
    },
    function(data){
      $('#kids').append(data);
    }
  );
}

function deleteChild(id){

  var shouldDelete = confirm("Desea eliminar al niño " + id + " y todo lo referente a el de forma permanente?");
  if (shouldDelete) {
    // the user wants to delete
    $.post("../Controladores/deletes.php", {
      action: "deleteChild",
      CURP: id
    },
    function(data){
      if(data == "1"){
        location.reload();
      }
    });
  } else {
    // the user does not want to delete
  }
}
