$(document).ready(function(){

  $('#registrar').click(insertInstitutionRequest);

});


function insertInstitutionRequest(){

  var insName = document.getElementById("nombreInstitucion");
  var insMail = document.getElementById("correoInstitucion");
  var insPhone = document.getElementById("telefonoInstitucion");
  var insAddress = document.getElementById("direccionInstitucion");

  $.post("insertions.php", {
          action: "insertInstitution",
          name: insName.value,
          mail: insMail.value,
          phone: insPhone.value,
          address: insAddress.value
        },
        function(data, status){
          alert("Data: " + data + "\nStatus: " + status);
        }
  );
}
