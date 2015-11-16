
$(document).ready(function(){
  $('#registrar').click(insertInstitutionRequest);

});


function insertInstitutionRequest(){

  if(allFiledsFilled()){

    var insName = document.getElementById("nombreInstitucion");
    var insMail = document.getElementById("correoInstitucion");
    var insPhone = document.getElementById("telefonoInstitucion");
    var insAddress = document.getElementById("direccionInstitucion");

    $.post("../Controladores/insertions.php", {
            action: "insertInstitution",
            name: insName.value,
            mail: insMail.value,
            phone: insPhone.value,
            address: insAddress.value
          },
          function(data){
            if(data == "1"){
              success();
            }else{
              failed();
            }
          }
    );
  }  
}

function success(){
  $('#errorImage').hide();
  $('#successImage').show();
  $('#nombreInstitucion').val("");
  $('#correoInstitucion').val("");
  $('#telefonoInstitucion').val("");
  $('#direccionInstitucion').val("");
}

function failed(){
  $('#errorImage').show();
  $('#successImage').hide();
}

function allFiledsFilled(){

  if($('#nombreInstitucion').val().length == 0){
    return false;
  }
  if($('#correoInstitucion').val().length == 0){
    return false;
  }
  if($('#telefonoInstitucion').val().length != 10){
    alert("Telefono deben ser 10 digitos");
    return false;
  }
  if($('#direccionInstitucion').val().length == 0){
    return false;
  }
  return true;
}
