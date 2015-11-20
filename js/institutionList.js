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


function deleteInstitution(id){

  var shouldDelete = confirm("Desea eliminar esta Institución de forma permanente?");
  if (shouldDelete) {

    shouldDelete = confirm("Se borrarán niños relacionados con esta escuela");

    if(shouldDelete){
      // the user wants to delete
      $.post("../Controladores/deletes.php", {
        action: "deleteInstitution",
        institutionId: id
      },
      function(data){
        if(data == "1"){
          location.reload();
        }else{
          alert(data);
        }
      });
    }

  } else {
    // the user does not want to delete
  }

}
