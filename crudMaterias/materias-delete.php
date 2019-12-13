<?php

	include('../connection.php');

	if(isset($_POST['id'])) {
		$id = $_POST['id'];
	  	$query = "DELETE FROM materias WHERE id = $id"; 
	  	$result = mysqli_query($datos_conexion, $query);

	  	if (!$result) {
	    	die("<h4 class='alert alert-danger text-center' role='alert mt-3'>Hubo un error en la carga, intente nuevamente</h4>");
	  	}

	  	echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Fue eliminado correctamente</h4>";
	  	mysqli_close($datos_conexion); 
	}

?>