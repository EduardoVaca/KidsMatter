<?php

	function connectToDataBase(){

		$servername = getenv('IP');
		$username = getenv('C9_USER');
		$password = "";
		$database = "KidsMatter";

		$conection = mysqli_connect($servername, $username, $password, $database);

		if( !$conection){
			die ("Connection failed! " . mysqli_connect_error());
		}

		return $conection;
	}

	function closeDb($mysql){
		mysqli_close($mysql);
	}


?>
