$(document).ready(function(){

  getInstitutions();
});



function getInstitutions(){
  $.post("../Controladores/getInfo.php"), {
      action: "getInstitutions",
  },
  function(data){
    $("#institutionComboPos").append("<select id='institutionCombo'>" + data + "</select>");
    $('#institutionComboPos').material_select();
  }
}
