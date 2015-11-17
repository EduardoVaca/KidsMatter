$(document).ready(function(){

  getStates();
  $("#registrar").click(function(){
    validaciones();
  });

});


function getStates(){

  $.post("../Controladores/getInfo.php", {
        action: "getStates",
  },
  function(data){
     $("#estadoComboPos").append("<select id='estadoCombo'>" + data + "</select>");
     $('#estadoCombo').material_select();
  });
}

function validaciones(){
  var childCURP = $('#CURP').val();
  var childName = $('#nombre').val();
  var childlast1 = $('#apellidoPaterno').val();
  var childlast2 = $('#apellidoMaterno').val();

  var childBirth = $('#nacimiento').val();
  var childArrival = $('#llegada').val();

  $.post("../Controladores/validate.php", {
          action: "valida",
          curp: childCURP,
          name: childName,
          last1: childlast1,
          last2: childlast2,
          birth: childBirth,
          arrival: childArrival
  }, function(data){
    if(data==0){
      insertChild();
    }else{
      //error inserting
      failed();
      alert("Campos incorrectos");
    }
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
  $.post("../Controladores/insertions.php", {
          action: "insertChild",
          curp: childCURP,
          name: childName,
          birth: childBirth,
          gender: childGender,
          stateId: stateId,
          arrival: childArrival
  }, function(data){
    if(data == "1"){
      success();
    }else{
      failed();
    }
  }
);
}

function success(){
  $('#successImage').show();
  $('#errorImage').hide();
  $('#CURP').val("");
  $('#nombre').val("");
  $('#apellidoPaterno').val("");
  $('#apellidoMaterno').val("");
}

function failed(){
  $('#errorImage').show();
  $('#successImage').hide();
}
