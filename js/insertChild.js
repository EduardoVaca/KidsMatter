$(document).ready(function(){

  getStates();

});


function getStates(){

  $.post("getInfo.php", {
        action: "getStates",
  },
  function(data){

    alert(data);
  });
}

function insertChild(){
  var childName = document.getElementById("nombre").value + " " +
            document.getElementById("apellidoPaterno").value + " " +
            document.getElementById("apellidoMaterno").value;
  var childBirth = document.getElementById("nacimiento").value;
  var childGender;
  if(document.getElementById("Masculino").checked){
    childGender = "Masculino";
  }else{
    childGender = "Femenino";
  }


}
