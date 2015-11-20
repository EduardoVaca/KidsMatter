<?php

session_start();

require_once "util.php";

$action = $_POST["action"];


switch($action){

  case 'deleteUser':
    $userId = $_POST['userId'];
    deleteUser($userId);
    break;

  case 'deleteChild':
    $CURP = $_POST['CURP'];
    deleteChild($CURP);
    break;

  case 'deleteInstitution':
    $institutionId = $_POST['institutionId'];
    deleteInstitution($institutionId);
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

function deleteUserSameConnection($userId, $conn){

  $sql = "DELETE FROM HasRole WHERE userName = '$userId';" .
          "DELETE FROM WorksInInstitution WHERE userName = '$userId';" .
          "DELETE FROM User WHERE userName = '$userId';";

  if (mysqli_multi_query($conn, $sql)) {
    echo "1";
  } else {
    echo "0";
  }

}


function deleteChild($CURP){
  $conn = connectToDatabase();

  $sql = "DELETE FROM BelongsToInstitution WHERE CURP = '$CURP';" .
          "DELETE FROM ReportCard WHERE CURP = '$CURP';" .
          "DELETE FROM Child WHERE CURP = '$CURP';";

  if (mysqli_multi_query($conn, $sql)) {
    echo "1";
  } else {
    echo "0" . mysqli_error($conn);
  }
  closeDb($conn);
}

function deleteChildSameConnection($CURP, $conn){

  $sql = "DELETE FROM BelongsToInstitution WHERE CURP = '$CURP';" .
          "DELETE FROM ReportCard WHERE CURP = '$CURP';" .
          "DELETE FROM Child WHERE CURP = '$CURP';";

  mysqli_multi_query($conn, $sql);

}


function deleteInstitution($institutionId){

  //Delete all children of Institution
  $conn = connectToDatabase();

  $sql = "SELECT CURP FROM BelongsToInstitution WHERE institutionId = '$institutionId';";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

      deleteChildSameConnection($row["CURP"], $conn);
    }
  }

  //Delete all users from institution
  $sql = "SELECT userName FROM WorksInInstitution WHERE institutionId = '$institutionId';";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

      deleteUserSameConnection($row["userName"], $conn);
    }
  }

  $sql = "DELETE FROM Institution WHERE institutionId = '$institutionId'";

  if (mysqli_query($conn, $sql)) {
    echo "1";
  } else {
      echo "0" . mysqli_error($conn);
  }
  closeDb($conn);

}

?>
