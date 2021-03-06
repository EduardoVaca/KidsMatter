<?php

  session_start();

  require_once "util.php";

  $action = "";


  $action = $_POST['action'];


  switch ($action) {
    case 'insertInstitution':
      $name = $_POST["name"];
      $email = $_POST["mail"];
      $phone = $_POST["phone"];
      $address = $_POST["address"];
      insertInstitution($name, $email, $phone, $address);
      break;

    case 'insertChild':
      $curp = $_POST["curp"];
      $name = $_POST["name"];
      $birth = $_POST["birth"];
      $gender = $_POST["gender"];
      $stateId = $_POST["stateId"];
      $arrival = $_POST["arrival"];
      insertChild($curp, $name, $birth, $gender, $stateId, $arrival);
      break;

    case 'insertGradeCard':
      $curp = $_POST["curp"];
      $courseId = $_POST["courseId"];
      $gradeId = $_POST["gradeLevelId"];
      $gradeObtained = $_POST["gradeObtained"];
      insertInReportCard($curp, $courseId, $gradeId, $gradeObtained);
      break;

    case 'insertUser':
      $username = $_POST["user"];
      $password = $_POST["password"];
      $institutionId = $_POST["instId"];
      $rolId = $_POST["roleId"];
      insertUser($username, $password, $institutionId, $rolId);
      break;

    default:
      break;
  }

  function insertUser($username, $password, $institutionId, $rolId){

    $conn = connectToDataBase();

    $sql = "INSERT INTO User (userName, userPassword) VALUES (\"" . $username .
            "\",\"" . $password . "\");";

    if(mysqli_query($conn, $sql)){
      $sql = "INSERT INTO WorksInInstitution (userName, institutionId) VALUES (\"" . $username .
      "\"," . $institutionId . ");";
      if(mysqli_query($conn, $sql)){
        $sql = "INSERT INTO HasRole (userName, rolId) VALUES (\"" . $username . "\"," . $rolId . ");";
        if(mysqli_query($conn, $sql)){
          echo "1";
        }else{
          echo "0";
        }
      }else{
        echo "0";
      }
    }else{
      echo "0";
    }
    closeDb($conn);
  }


  function insertInReportCard($curp, $courseId, $gradeId, $gradeObtained){

    $conn = connectToDataBase();

    $sql = "INSERT INTO ReportCard (CURP, gradeId, courseId, gradeObtained) VALUES (\"" . $curp .
          "\"," . $gradeId . "," . $courseId . "," . $gradeObtained . ");";

    if(mysqli_query($conn, $sql)){
      echo "Insertion Done!";
    }else{
      echo "Error in Insertion";
    }
    closeDb($conn);
  }

  function insertChild($curp, $name, $birth, $gender, $stateId, $arrival){

    $conn = connectToDataBase();

    $sql = "INSERT INTO Child (CURP, name, gender, birthday, stateId) VALUES (\"" . $curp .
                "\",\"" . $name . "\",\"" . $gender . "\",\"" . $birth . "\"," . $stateId . ");";


    if(mysqli_query($conn, $sql)){

      $sql = "INSERT INTO BelongsToInstitution (CURP, institutionId, arrival) VALUES (\"" . $curp .
              "\"," . $_SESSION["institutionId"] . ", \"" . $arrival . "\");";

      if(mysqli_query($conn, $sql)){
        echo "1";
      }else{
        echo "0";
      }

    }else{
      echo "0";

      closeDb($conn);
    }
  }

  function insertInstitution($name, $email, $phone, $address){

		$conn = connectToDataBase();

		$sql = "INSERT INTO Institution (name, email, phone, address) VALUES (\"" . $name . "\", \"" .
				$email . "\", \"" . $phone . "\", \"" . $address . "\");";

		if (mysqli_query($conn, $sql)) {
		    echo "1";
		} else {
		    echo "0";
		}

		closeDb($conn);
	}

 ?>
