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
