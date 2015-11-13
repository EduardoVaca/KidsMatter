$(document).ready(function(){

  getInstitutions();
  getRoles();
});

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
