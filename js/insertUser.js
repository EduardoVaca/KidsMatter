$(document).ready(function(){
  getInstitutions();
});

function getInstitutions(){
  $.post("../Controladores/getInfo.php", {
        action: "getInstitutions",
  },
  function(data){
    alert(data);
    $("#institutionComboPos").append("<select id='institutionCombo'>" + data + "</select>");
    $('#institutionCombo').material_select();
  });
}
