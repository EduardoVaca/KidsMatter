<?php

  require_once "util.php";

  $action = "";

  if(isset($_POST['action']) && function_exists($_POST['action'])){
    $action = $_POST['action'];
  }

  switch ($action) {
    case 'insertInstitution':
      $name = $_POST["name"];
      $email = $_POST["mail"];
      $phone = $_POST["phone"];
      $address = $_POST["address"];
      insertInstitution($name, $email, $phone, $address);
      break;

    default:
      break;
  }


  function insertIntitution($name, $email, $phone, $address){

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
