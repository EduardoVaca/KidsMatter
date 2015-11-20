$(document).ready(function(){
  getUserTable();
});

function getUserTable(){
  $.post(
    "../Controladores/getInfo.php",
    {
      action: "getUsersTable"
    },
    function(data){
      $('#users').append(data);
    }
  )
}


function deleteUser(id){

  var shouldDelete = confirm("Desea eliminar este usuario de forma permanente?");
  if (shouldDelete) {
    // the user wants to delete
    $.post("../Controladores/deletes.php", {
      action: "deleteUser",
      userId: id
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
