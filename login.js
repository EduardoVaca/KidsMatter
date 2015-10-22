$(document).ready(function(){

  $('#ingresar').click(isAcceptedUser)

});

function isAcceptedUser(){
  
  var username = document.getElementById("User");
  var password = document.getElementById("Passwd");
  alert(username.value + password.value);
  
  $.get("login.php", {
    action: "getUserData",
    username: username.value,
    password: password.value
  }, function(data){
    document.getElementById("debug").innerHTML = "DATA: " + data;
  });
  
}
