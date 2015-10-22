<?php

  require_once "util.php";

  $action = $_GET["action"];

  switch ($action) {
    case "getUserData":
      $username = $_GET["username"];
      $password = $_GET["password"];
      validateUser($username, $password);
      break;

    default:
      # code...
      break;
  }


  function validateUser($username, $password){
    $conn = connectToDataBase();

    $sql = "SELECT * FROM User WHERE userName = \"" .
            $username . "\" AND userPassword = \"" .
            $password . "\"";

    $result = mysqli_query($conn, $sql);

    closeDb($conn);

    if(mysqli_num_rows($result) > 0){
      echo "User ACCEPTED";
    }else{
      echo "Invalid USER";
    }

  }

 ?>
