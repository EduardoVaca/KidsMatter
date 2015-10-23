<?php

  session_start();

  require_once "util.php";

  $action = $_POST["action"];

  switch ($action) {
    case 'getStates':
      getStatesFromDb();
      break;

    case 'getChildrenTable':
      getChildrenByInstitution();
      break;

    default:
      # code...
      break;
  }

  function getChildrenTable(){

    $conn = connectToDataBase();

    $sql = "SELECT * FROM Child C, BelongsToInstitution BTI " .
            "WHERE BTI.institutionId =" .  $_SESSION["institutionId"] . " AND " .
            "C.CURP = BTI.CURP;";

    $result = mysqli_query($conn, $sql);

    $table = "<table>
                <tr>
                  <th>CURP</th>
                  <th>Nombre</th>
                  <th>Sexo</th>
                  <th>Cumpleanos</th>
                  <th>Llegada</th>
                </tr>";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $table .= "<tr id=\"" . $row["CURP"] . "\">
                      <td>" . $row["CURP"] . "</td>
                      <td>" . $row["name"] . "</td>
                      <td>" . $row["gender"] . "</td>
                      <td>" . $row["birthday"] . "</td>
                      <td>" . $row["arrival"] . "</td>
                    </tr>";
        }
      $table .= "</table>";
      echo $table;
      
    }else{
      echo "Error";
    }

    closeDb($conn);

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
      echo $option;
    }else{
      $json["status"] = "wrong";
    }

    closeDb($conn);
    //echo json_encode($json);

  }
?>
