<?php
	
	function connectToDataBase(){

		$servername = "mysql16.000webhost.com";
		$username = "a2204124_admin";
		$password = "KM%2015_daw";
		$database = "a2204124_km";

		$conection = mysqli_connect($servername, $username, $password, $database);

		if( !$conection){
			die ("Connection failed! " . mysqli_connect_error());
		}

		return $conection;
	}

	function closeDb($mysql){
		mysqli_close($mysql);
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