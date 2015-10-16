<?php
	
	require_once "util.php";

	$name = $_POST["nombreInstitucion"];
	$email = $_POST["correoInstitucion"];
	$phone = $_POST["telefonoInstitucion"];
	$address = $_POST["direccionInstitucion"];

	if(strlen($name) > 0 && strlen($email) > 0){

		if(insertIntitution($name, $email, $phone, $address)){
			echo '<script language="javascript">';
			echo 'alert("Fruit added!")';
			echo '</script>';
			header('Location: Registro.html'); 
			echo "Success";
		}
	}

	

?>