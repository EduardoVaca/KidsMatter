$(document).ready(function(){
  getInstitutionTable();
});

function getInstitutionTable(){
  $.post(
    "../Controladores/getInfo.php",
    {
      action: "getInstitutionsTable"
    },
    function(data){
      $('#institutions').append(data);
      $('.modal-trigger').leanModal();
    }
  )
}
