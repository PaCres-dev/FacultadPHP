<?php

	session_start();
	
	$email=$_POST['email'];
	$password=$_POST['password'];

	include("connection.php");

	$consultar_datos=mysqli_query($datos_conexion, "SELECT * FROM users");

	while ($verificar_datos=mysqli_fetch_array($consultar_datos)) 
	{
		if($email==$verificar_datos['email'] && $password==$verificar_datos['password']) 
		{
			$_SESSION['id']=$verificar_datos['id'];
			$_SESSION['username']=$verificar_datos['username'];
			$_SESSION['surname']=$verificar_datos['surname'];
			$_SESSION['user']=$email;
			mysqli_close($datos_conexion);
			header("Location:index.php");
			exit;
		}
	}

	header("Location:login.php?login=error")
	
?>