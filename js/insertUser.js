$(document).ready(function(){

  $('#addUser').click(insertUserInDb());
  getInstitutions();
  getRoles();
});

function validate(){

  if($('#nombre').val().length < 0)
    return false;
  if($('#password1').val().length < 0)
    return false;
  if($('#password1').val() != $('#password2').val())
    return false;
  return true;
}


function insertUserInDb(){
  if(validate()){
    alert("Fields are validate");

    var userName = $('#nombre').val();
    var passwordUser = $('#password1').val();
    var institutionId = $('#institutionCombo').val();
    var rolId = $('#rolesCombo').val();

    alert("instId" + institutionId + " rolId:" + rolId);
    $.post("../Controladores/insertions.php", {
      action: "insertUser",
      user = userName,
      password = passwordUser,
      instId = institutionId,
      roleId = rolId
    }, function(data){
      alert(data);
    });
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
    alert(data);
    $("#rolesComboPos").append("<select id='rolesCombo'>" + data + "</select>");
    $('#rolesCombo').material_select();
  });
}
