<?php

session_start();

require_once "util.php";

class Materia{
  public $name = "";
  public $grade = "";
}

$action = "";


$action = $_POST['action'];

switch($action){

  case 'createGraphByGrade':
    $curp = $_POST["curp"];
    $gradeId = $_POST["gradeId"];
    getGraphByGrade($curp, $gradeId);
    break;
}


function getGraphByGrade($curp, $gradeId){

  $conn = connectToDataBase();

  $sql = "SELECT Co.name, gradeObtained FROM Course Co, ReportCard R
          WHERE R.CURP = \"" . $curp . "\" AND R.gradeId = " . $gradeId . " AND
          Co.courseId = R.courseId;";

  $result = mysqli_query($conn, $sql);

  $courses = array();

  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){

        $materia = new Materia();
        $materia->name = $row["name"];
        $materia->grade = $row["gradeObtained"];

        array_push($courses, $materia);
      }
      $res = array();
      $res["n"] = count($courses);
      $res["materias"] = $courses;
     echo json_encode($res);

  }else{

    echo "error";
  }

  closeDb($conn);

}


 ?>
