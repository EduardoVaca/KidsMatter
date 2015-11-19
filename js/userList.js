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

  var shouldDelete = confirm("Do you want to delete this user?");
  if (shouldDelete) {
    // the user wants to delete
    $.post("../Controladores/deletes.php", {
      action: "deleteUser",
      userId: id
    },
    function(data){
      alert(data);
      if(data == "1"){
        getUsersTable();
      }
    });
  } else {
    // the user does not want to delete
  }
}
