<?php
  
  session_start();

  include('../connection.php');

  if(isset($_POST['materia'])) {
    $user = $_SESSION['id'];
    $materia = $_POST['materia'];
    $descripcion = $_POST['descripcion'];

    $query = "INSERT INTO materias (id, materia, descripcion, user) VALUES (0, '$materia', '$descripcion', $user)";
    $result = mysqli_query($datos_conexion, $query);

    if (!$result) {
      die("<h4 class='alert alert-danger text-center' role='alert mt-3'>Hubo un error en la carga, intente nuevamente</h4>");
    }
      
    echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Fue agregado correctamente</h4>";  
    mysqli_close($datos_conexion);
  }

?>