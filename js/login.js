$(document).ready(function(){

  $('#ingresar').click(isAcceptedUser);

});

function validate(){
  if ($('#User').val().length > 0 && $('#Passwd').val().length > 0){
    return true;
  }
  return false;
}

function isAcceptedUser(){

  if (validate()){

    var username = document.getElementById("User");
    var password = document.getElementById("Passwd");

    $.get("../Controladores/login.php", {
      action: "getUserData",
      username: username.value,
      password: password.value
    }, function(data){

      var object = jQuery.parseJSON(data);

      if(object.response == "accepted"){
        $('#errorImage').hide();
        $('#successImage').show();
        window.location.replace("Menu.html");
      }else{
        $('#errorImage').show();
        $('#successImage').hide();
      }
    });

  }else{

    alert("Favor de escribir usuario y contraseña");
  }


}
