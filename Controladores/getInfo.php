<?php

  session_start();

  require_once "util.php";

  $action = $_POST["action"];

  switch ($action) {
    case 'getStates':
      getStatesFromDb();
      break;

    case 'getInstitutions':
      getInstitutionsFromDb();
      break;

    case 'getChildrenTable':
      getChildrenByInstitution();
      break;

    case 'getChildrenTableByName':
      $name = $_POST["nombreChild"];
      getChildrenTableByName($name);
      break;

    case 'getEducationLevelFromDb':
      getEducationLevelFromDb();
      break;

    case 'getCoursesFromDb':
      getCoursesFromDb();
      break;

    default:
      # code...
      break;
  }

  function getChildrenTableByName($name){

    $conn = connectToDataBase();

    $sql = "SELECT * FROM Child C, BelongsToInstitution BTI " .
            "WHERE BTI.institutionId =" .  $_SESSION["institutionId"] . " AND " .
            "C.CURP = BTI.CURP AND C.name LIKE \"" . $name . "\";";

    $result = mysqli_query($conn, $sql);

    $table = "<table class='striped teal lighten-3 z-depth-1 tabla-actividades'>
                <thead>
                  <tr>
                    <th>CURP</th>
                    <th>Nombre</th>
                    <th>Agregar</th>
                    <th>Ver</th>
                  </tr>
                </thead>
                <tbody>";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $table .= "<tr id=\"" . $row["CURP"] . "\">
                      <td>" . $row["CURP"] . "</td>
                      <td>" . $row["name"] . "</td>
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='printId(this.id)' href='#modal1'><i class='material-icons'>add</i></a></td>
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='printId(this.id)' href='#modal2'><i class='material-icons'>search</i></a></td>
                    </tr>";
        }
      $table .= "</thead></table>";
      echo $table;

    }else{
      echo "No child found with that name";
    }

    closeDb($conn);
  }

  function getChildrenByInstitution(){

    $conn = connectToDataBase();

    $sql = "SELECT * FROM Child C, BelongsToInstitution BTI " .
            "WHERE BTI.institutionId =" .  $_SESSION["institutionId"] . " AND " .
            "C.CURP = BTI.CURP;";

    $result = mysqli_query($conn, $sql);

    $table = "<table class='striped teal lighten-3 z-depth-1 tabla-actividades'>
                <thead>
                  <tr>
                    <th>CURP</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Cumpleanos</th>
                    <th>Llegada</th>
                  </tr>
                </thead>
                <tbody>";

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
      $table .= "</tbody></table>";
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

    function getInstitutionsFromDb(){

      $conn = connectToDataBase();

      $sql = "SELECT * FROM Institution";

      $result = mysqli_query($conn, $sql);


      $json = array();
      if(mysqli_num_rows($result) > 0){
        $json["status"] = "correct";
        $json["num"] = mysqli_num_rows($result);
        $option = "";
        while($row = mysqli_fetch_assoc($result)){
          $option .= "<option value=\"" . $row["institutionId"] .
                    "\">" . $row["name"] . "</option>";
        }
        $json["data"] = $option;
        echo $option;
      }else{
        $json["status"] = "wrong";
      }

      closeDb($conn);
    }

    function getEducationLevelFromDb(){
        $conn = connectToDatabase();
        $sql = "SELECT * FROM Grade";
        $result = mysqli_query($conn, $sql);
        $json = array();

        if(mysqli_num_rows($result) > 0){
            $json["status"] = "correct";
            $json["num"] = mysqli_num_rows($result);
            $option = "";

            while($row = mysqli_fetch_assoc($result)){
                $option.= "<option value=\"" . $row["gradeId"] . "\">" . $row["grade"] . "</option>";
            }
            $json["data"] = $option;
            echo $option;
        } else {
            $json["status"] = "wrong";
        }

        closeDb($conn);
    }

    function getCoursesFromDb(){
        $conn = connectToDatabase();
        $sql = "SELECT * FROM Course";
        $result = mysqli_query($conn, $sql);
        $json = array();

        if(mysqli_num_rows($result) > 0){
            $json["status"] = "correct";
            $json["num"] = mysqli_num_rows($result);
            $option = "";

            while($row = mysqli_fetch_assoc($result)){
                $option.= "<option value=\"" . $row["courseId"] . "\">" . $row["name"] . "</option>";
            }
            $json["data"] = $option;
            echo $option;
        } else {
            $json["status"] = "wrong";
        }

        closeDb($conn);
    }

?>
