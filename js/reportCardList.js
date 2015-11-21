$(document).ready(function(){
  getReportCardsTable();
});

function getReportCardsTable(){

  $.post(
    "../Controladores/getInfo.php",
    {
      action: "getReportCardsOfChildren",
    },
    function(data){
      if(data != "Error"){
        $('#reportCards').append(data);
      }
    }
  )
}


function deleteReportCard(id){

  var shouldDelete = confirm("Desea eliminar esta boleta de forma permanente?");
  if (shouldDelete){
    var array = id.split("*");

    $.post("../Controladores/deletes.php", {
      action: "deleteReportCard",
      CURP: array[0],
      gradeId[1],
    },
    function(data){
      if(data == "1"){
        location.reload();
      }else{
        alert(data);
      }
    });
  }

}
