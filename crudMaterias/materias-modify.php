<?php

  include('../connection.php');

  if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $materia = $_POST['materia'];
    $descripcion = $_POST['descripcion'];

    $row = mysqli_query($datos_conexion, "UPDATE materias SET materia = '$materia', descripcion = '$descripcion' WHERE id=$id");

    if (!$row) {
      die("<h4 class='alert alert-danger text-center' role='alert mt-3'>Hubo un error en la carga, intente nuevamente</h4>");
    }
    mysqli_close($datos_conexion);

    echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Fue actualizado correctamente</h4>";  
  }

?>