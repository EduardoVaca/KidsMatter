<?php

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
      insertChild($name)
    default:
      break;
  }


  function insertChild($curp, $name, $birth, $gender, $stateId){

    $conn = connectToDataBase();

    $sql = "INSERT INTO Child (CURP, name, gender, birthday, stateId) VALUES (\"" . $curp .
                "\",\"" . $name . "\",\"" . $gender . "\",\"" . $birth . "\"," . $stateId . ");";

    $json = array();

    if(mysqli_query($conn, $sql)){
      $json["child"] = "correct";

      //$sql = "INSERT INTO "
    }else{
      $json["child"] = "wrong";

      closeDb($conn);
      echo json_encode($json);
    }
  }

  function insertInstitution($name, $email, $phone, $address){

		$conn = connectToDataBase();

		$sql = "INSERT INTO Institution (name, email, phone, address) VALUES (\"" . $name . "\", \"" .
				$email . "\", \"" . $phone . "\", \"" . $address . "\");";

		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		    closeDb($conn);
		    return true;
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		    closeDb($conn);
		    return false;
		}

		closeDb($conn);
	}

 ?>
