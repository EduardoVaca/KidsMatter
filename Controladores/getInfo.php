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

    case 'getRoles':
      getRolesFromDb();
      break;

    case 'getInstitutionsTable':
      getInstitutionsTable();
      break;

    case 'getUsersTable':
      getUsersTable();
      break;

    case 'getChildrenTable':
      if($_SESSION["rolId"] == 1){
        getChildren();
      }else{
        getChildrenByInstitution();
      }
      break;

    case 'getChildrenTableByName':
      $name = $_POST["nombreChild"];
      if($_SESSION["rolId"] == 1){
        getChildrenTableByName($name);
      }else{
        getChildrenTableByNameInInstitution($name);
      }
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

    $sql = "SELECT * FROM Child " .
            "WHERE name LIKE \"" . $name . "\";";

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

  function getChildrenTableByNameInInstitution($name){

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
                    <th>Eliminar</th>
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
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 center' onclick='deleteChild(this.id)'><i class='material-icons'>clear</i></a></td>
                    </tr>";
        }
      $table .= "</tbody></table>";
      echo $table;

    }else{
      echo "Error";
    }

    closeDb($conn);

  }

  function getUsersTable(){

    $conn = connectToDataBase();

    $sql = "SELECT" . " U.userName as uName, I.name as iName, R.name as rName
          FROM User U, HasRole HR, Rol R, WorksInInstitution WII, Institution I
          WHERE U.userName = HR.userName AND R.rolId = HR.rolId AND U.userName = WII.userName
          AND WII.institutionId = I.institutionId";

    $result = mysqli_query($conn, $sql);

    $table = "<table class='striped teal lighten-3 z-depth-1 tabla-actividades'>
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Institucion</th>
                    <th>Rol</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $table .= "<tr id=\"" . $row["uName"] . "\">
                      <td>" . $row["uName"] . "</td>
                      <td>" . $row["iName"] . "</td>
                      <td>" . $row["rName"] . "</td>
                      <td>" . "<a id='" . $row["uName"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 center' onclick='deleteUser(this.id)'><i class='material-icons'>clear</i></a></td>
                    </tr>";
        }
      $table .= "</tbody></table>";
      echo $table;

    }else{
      echo "Error";
    }

    closeDb($conn);
  }

  function getInstitutionsTable(){

        $conn = connectToDataBase();

        $sql = "SELECT * FROM Institution";

        $result = mysqli_query($conn, $sql);

        $table = "<table class='striped teal lighten-3 z-depth-1 tabla-actividades'>
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Mapa</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>";

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              $table .= "<tr id=\"" . $row["institutionId"] . "\">
                          <td>" . $row["name"] . "</td>
                          <td>" . $row["email"] . "</td>
                          <td>" . $row["phone"] . "</td>
                          <td>" . "<a id='" . $row["address"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='buildMapInList(this.id)' href='#modal1'><i class='material-icons'>map</i></a></td>
                          <td>" . "<a id='" . $row["institutionId"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 center' onclick='deleteInstitution(this.id)'><i class='material-icons'>clear</i></a></td>
                        </tr>";
            }
          $table .= "</tbody></table>";
          echo $table;

        }else{
          echo "Error";
        }

        closeDb($conn);
  }

  function getChildren(){

    $conn = connectToDataBase();

    $sql = "SELECT C.CURP, C.name as cName, gender, birthday, arrival, I.name as iName
            FROM Child C, BelongsToInstitution BTI, Institution I
             WHERE C.CURP = BTI.CURP AND I.institutionId = BTI.institutionId
             ORDER BY iName;";

    $result = mysqli_query($conn, $sql);

    $table = "<table class='striped teal lighten-3 z-depth-1 tabla-actividades'>
                <thead>
                  <tr>
                    <th>CURP</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Cumpleanos</th>
                    <th>Llegada</th>
                    <th>Institucion<th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $table .= "<tr id=\"" . $row["CURP"] . "\">
                      <td>" . $row["CURP"] . "</td>
                      <td>" . $row["cName"] . "</td>
                      <td>" . $row["gender"] . "</td>
                      <td>" . $row["birthday"] . "</td>
                      <td>" . $row["arrival"] . "</td>
                      <td>" . $row["iName"] . "<td>
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='deleteChild(this.id)' href='#modal1'><i class='material-icons'>clear</i></a></td>
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


    function getRolesFromDb(){
      $conn = connectToDataBase();

      $sql = "SELECT * FROM Rol";

      $result = mysqli_query($conn, $sql);


      $json = array();
      if(mysqli_num_rows($result) > 0){
        $json["status"] = "correct";
        $json["num"] = mysqli_num_rows($result);
        $option = "";
        while($row = mysqli_fetch_assoc($result)){
          $option .= "<option value=\"" . $row["rolId"] .
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
        $sql = "SELECT * FROM Course ORDER BY name ASC";
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
