<?php 

	$username=$_POST['username'];
	$surname=$_POST['surname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];

	if ($password===$cpassword && !empty($username) && !empty($surname) && !empty($email) && !empty($password)) 
	{
		include("connection.php");
		mysqli_query($datos_conexion, "INSERT INTO users (id, username, surname, email, password) VALUES (0, '$username', '$surname', '$email', '$password')");
		mysqli_close($datos_conexion);
		
		header("Location:signup.php?r=ok");
	}
	else
	{
		header("Location:signup.php?r=err");
	}

?>