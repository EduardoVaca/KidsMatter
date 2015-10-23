<?php

  require_once "util.php";

  $action = $_POST["action"];

  switch ($action) {
    case 'getStates':
      getStatesFromDb();
      break;

    default:
      # code...
      break;
  }


  function getStatesFromDb(){
    $conn = connectToDataBase();

    $sql = "SELECT * FROM State";

    $result = mysqli_query($conn, $sql);

    $json = array();
    if(mysqli_num_rows($result) > 0){
      $json["status"] = "correct";
      $json["num"] = mysqli_num_rows($result);
      $option = "";
      while($row = mysqli_fetch_assoc($result)){
        $option .= "<option value=\"" . $row["stateId"] .
                  "\">" . $row["name"] . "</option>";
      }
      $json["data"] = $option;
    }else{
      $json["status"] = "wrong";
    }

    closeDb($conn);
    echo json_encode($json);

  }
?>
