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
