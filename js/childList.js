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
