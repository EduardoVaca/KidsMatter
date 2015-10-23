$(document).ready(function(){
  alert("In child js");
  getChildrenTable();

});

function getChildrenTable(){
  $.post(
    "../Controladores/getInfo.php",
    {
      action: "getChildrenTable"
    },
    function(data){
      alert(data);
    }
  );
}
