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

    case 'getMissingEducationLevel':
      $CURP = $_POST["CURP"];
      getMissingEducationLevel($CURP);
      break;

    case 'getStoredEducationLevel':
      $CURP = $_POST["CURP"];
      getStoredEducationLevel($CURP);
      break;

    case 'getCoursesFromDb':
      getCoursesFromDb();
      break;

    case 'getChildGPA':
      $CURP = $_POST["CURP"];
      getChildGPA($CURP);
      break;

    case 'getReportCardsOfChildren':
      if($_SESSION["rolId"] == 1){
        getReportCardsOfChildren();
      }else{
        getReportCardsOfChildrenByInstitution();
      }
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

    $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades s8 m8 l8' style='width:100%;'>
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
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='printId(this.id);refresh()' href='#modal1'><i class='material-icons'>add</i></a></td>
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='printId(this.id);refreshModal2()' href='#modal2'><i class='material-icons'>search</i></a></td>
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

    $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='width:100%;'>
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
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='printId(this.id);refresh()' href='#modal1'><i class='material-icons'>add</i></a></td>
                      <td>" . "<a id='" . $row["CURP"] . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='printId(this.id);refreshModal2()' href='#modal2'><i class='material-icons'>search</i></a></td>
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

    $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='width:100%;'>
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

    $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='width:100%;'>
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

        $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='width:100%;'>
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

    $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='width:100%;'>
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

    function getMissingEducationLevel($CURP){
      $conn = connectToDatabase();
      $sql = "SELECT grade, gradeId FROM Grade WHERE gradeId NOT IN (".
              "Select gradeId FROM ReportCard WHERE CURP = '$CURP');";

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

    function getStoredEducationLevel($CURP){
      $conn = connectToDatabase();
      $sql = "SELECT grade, gradeId FROM Grade WHERE gradeId IN (".
              "Select gradeId FROM ReportCard WHERE CURP = '$CURP');";

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

    function getChildGPA($CURP){
      $conn = connectToDatabase();
      $sql = "SELECT AVG(gradeObtained) as Average FROM ReportCard WHERE CURP = '$CURP';";
      if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $avg = $row["Average"];
        echo number_format((float)$avg, 2, '.', '');
      }else {
        echo "0";
      }

      closeDb($conn);
    }

    function getReportCardsOfChildren(){

      $conn = connectToDatabase();

      $sql = "SELECT  C.CURP, name, grade, G.gradeId FROM Child C, Grade G, ReportCard RC " .
              "WHERE C.CURP = RC.CURP AND G.gradeId = RC.gradeId ".
              "GROUP BY C.CURP, G.gradeId;";

      $result = mysqli_query($conn, $sql);

      $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='width:100%;'>
                  <thead>
                    <tr>
                      <th>CURP</th>
                      <th>Nombre</th>
                      <th>Grado</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>";

      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            $tempId = $row["CURP"] . "*" . $row["gradeId"];
            $table .= "<tr id=\"" . $row["CURP"] . "\">
                        <td>" . $row["CURP"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["grade"] . "</td>
                        <td>" . "<a id='" . $tempId . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='deleteReportCard(this.id)' href='#modal1'><i class='material-icons'>clear</i></a></td>
                      </tr>";
          }
        $table .= "</tbody></table>";
        echo $table;

      }else{
        echo "Error";
      }

      closeDb($conn);

    }

    function getReportCardsOfChildrenByInstitution(){

      $conn = connectToDatabase();

      $sql = "SELECT  C.CURP, name, grade, G.gradeId FROM Child C, Grade G, ReportCard RC, BelongsToInstitution BTI " .
            "WHERE C.CURP = RC.CURP AND G.gradeId = RC.gradeId AND BTI.institutionId = " . $_SESSION["institutionId"] . " AND C.CURP = BTI.CURP " .
            "GROUP BY C.CURP, G.gradeId;";

      $result = mysqli_query($conn, $sql);

      $table = "<table class='responsive-table striped teal lighten-3 z-depth-1 tabla-actividades' style='max-width:100%;'>
                  <thead>
                    <tr>
                      <th>CURP</th>
                      <th>Nombre</th>
                      <th>Grado</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>";

      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            $tempId = $row["CURP"] . "*" . $row["gradeId"];
            $table .= "<tr id=\"" . $row["CURP"] . "\">
                        <td>" . $row["CURP"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["grade"] . "</td>
                        <td>" . "<a id='" . $tempId . "' class='btn-floating medium waves-effect waves-light cyan z-depth-1 modal-trigger center' onclick='deleteReportCard(this.id)' href='#modal1'><i class='material-icons'>clear</i></a></td>
                      </tr>";
          }
        $table .= "</tbody></table>";
        echo $table;

      }else{
        echo "Error";
      }

      closeDb($conn);
    }

?>
