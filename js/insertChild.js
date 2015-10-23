$(document).ready(function(){

  getStates();

  $("#registrar").click(insertChild);

});


function getStates(){

  $.post("/Controladores/getInfo.php", {
        action: "getStates",
  },
  function(data){
     $("#estadoComboPos").append("<select id='estadoCombo'>" + data + "</select>");
     $('#estadoCombo').material_select();
  });
}

function insertChild(){

  var childCURP = $('#CURP').val();
  var childName = $('#nombre').val() + " " +
            $('#apellidoPaterno').val() + " " +
            $('#apellidoMaterno').val();

  var childBirth = $('#nacimiento').val();
  var childArrival = $('#llegada').val();
  var childGender;

  if(document.getElementById("masculino").checked){
    childGender = "Masculino";
  }else{
    childGender = "Femenino";
  }
  var stateName = $('#estadoCombo option:selected').text();
  var stateId = $('#estadoCombo').val();
  alert("stateid send: " + stateId);

  alert(stateName + stateId);
  $.post("/Controladores/insertions.php", {
          action: "insertChild",
          curp: childCURP,
          name: childName,
          birth: childBirth,
          gender: childGender,
          stateId: stateId,
          arrival: childArrival
  }, function(data){
    alert("regresó");
    alert(data);
  }
);


}
