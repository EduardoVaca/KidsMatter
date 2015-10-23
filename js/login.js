$(document).ready(function(){

  $('#ingresar').click(isAcceptedUser)

});

function isAcceptedUser(){

  var username = document.getElementById("User");
  var password = document.getElementById("Passwd");
  alert(username.value + password.value);

  $.get("/Controladores/login.php", {
    action: "getUserData",
    username: username.value,
    password: password.value
  }, function(data){
    alert(data);
    var object = jQuery.parseJSON(data);
    document.getElementById("debug").innerHTML = "DATA: " + object.response;

    if(object.response == "accepted"){
      window.location.replace("Menu.html");
    }
  });

}
