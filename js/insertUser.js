$(document).ready(function(){

  getInstitutions();
  getRoles();
  $('#registrar').click(function(){
    insertUserInDb();
  });
});

function validate(){

  if($('#nombre').val().length < 0){
    return false;
  }

  if($('#password1').val().length < 0){
    return false;
  }

  if($('#password1').val() != $('#password2').val()){
    return false;
  }

  return true;
}


function insertUserInDb(){
  if(validate()){

    var userName = $('#nombre').val();
    var passwordUser = $('#password1').val();
    var institutionId = $('#institutionCombo').val();
    var rolId = $('#rolesCombo').val();

    alert("instId" + institutionId + " rolId:" + rolId + " pASS: " + passwordUser);
    $.post("../Controladores/insertions.php", {
      action: "insertUser",
      user: userName,
      password: passwordUser,
      instId: institutionId,
      roleId: rolId
    }, function(data){
      alert(data);
    });
  }else{
    alert("Fields are NOT validate");
  }

}

function getInstitutions(){

  $.post("../Controladores/getInfo.php", {
        action: "getInstitutions",
  },
  function(data){

    $("#institutionComboPos").append("<select id='institutionCombo'>" + data + "</select>");
    $('#institutionCombo').material_select();
  });
}


function getRoles(){
  $.post("../Controladores/getInfo.php", {
      action: "getRoles",
  },
  function(data){
    $("#rolesComboPos").append("<select id='rolesCombo'>" + data + "</select>");
    $('#rolesCombo').material_select();
  });
}
