$(document).ready(function(){

  getStates();

  $("#registrar").click(insertChild);

});


function getStates(){

  $.post("getInfo.php", {
        action: "getStates",
  },
  function(data){
     $("#estadoComboPos").append("<select id='estadoCombo'>" + data + "</select>");
     $('#estadoCombo').material_select();
  });
}

function insertChild(){
  var childName = $('#nombre').val() + " " +
            $('#apellidoPaterno').val() + " " +
            $('#apellidoMaterno').val();

  var childBirth = $('#nacimiento').val();
  var childGender;

  if(document.getElementById("masculino").checked){
    childGender = "Masculino";
  }else{
    childGender = "Femenino";
  }
  var stateName = $('#estadoCombo option:selected').text();
  var stateId = $('#estadoCombo').val();

  alert(stateName + stateId);


}
