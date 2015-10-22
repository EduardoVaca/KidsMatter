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

    $array = array();
    if(mysqli_num_rows($result) > 0){
      $array["response"] = "accepted";

      $sql = "SELECT rolId, institutionId
              FROM HasRole hr, WorksInInstitution wi
              WHERE hr.userName = \"" . $username . "\" AND
              hr.userName = wi.userName;";

      $result = mysqli_query($conn, $sql);
      if($row = mysqli_fetch_assoc($result)){
        $array["rolId"] = $row["rolId"];
        $array["institutionId"] = $row["institutionId"];
      }

    }else{
      $array["response"] = "declined";
    }

    closeDb($conn);
    echo json_encode($array);
  }

 ?>
