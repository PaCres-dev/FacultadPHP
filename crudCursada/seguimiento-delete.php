<?php

	include('../connection.php');

	if(isset($_POST['id'])) {
		$id = $_POST['id'];
	  	$query = "DELETE FROM seguimiento WHERE id = $id"; 
	  	$deleteregistro = mysqli_query($datos_conexion, $query);

	  	$querynotas = "DELETE FROM examenes WHERE seguimientoid = $id"; 
	  	$deletenotas = mysqli_query($datos_conexion, $querynotas);

	  	if (!$deleteregistro) {
	    	die("<h4 class='alert alert-danger text-center mt-3' role='alert'>Hubo un error en la carga, intente nuevamente</h4>");
	  	}

	  	echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Fue eliminado correctamente</h4>";
	  	mysqli_close($datos_conexion);

	}

?>