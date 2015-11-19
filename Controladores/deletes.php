<?php

session_start();

require_once "util.php";

$action = $_POST["action"];


switch($action){

  case 'deleteUser':
    $userId = $_POST['userId'];
    deleteUser($userId);
    break;
}


function deleteUser($userId){
  $conn = connectToDatabase();

  $sql = "DELETE FROM HasRole WHERE userName = '$userId';" .
          "DELETE FROM WorksInInstitution WHERE userName = '$userId';" .
          "DELETE FROM User WHERE userName = '$userId';";

  if (mysqli_multi_query($conn, $sql)) {
    echo "1";
  } else {
    echo "0";
  }
  closeDb($conn);
}

?>
