<?php
  
  session_start();

  include('../connection.php');

  if(isset($_POST['materias'])) {
    $user = $_SESSION['id'];
    $materia = $_POST['materias'];
    $temas = $_POST['temas'];
    $fechafinal = $_POST['fechafinal'];
    $carrera = $_POST['carrera'];
    $recursante = $_POST['recursante'];
    $sede = $_POST['sede'];

    $query = "INSERT INTO seguimiento (id, materias, direccion, temas, fechafinal, recursante, carrera, user) VALUES (0, '$materia', '$sede', '$temas', '$fechafinal', '$recursante', '$carrera', $user)";
    $result = mysqli_query($datos_conexion, $query);

    if (!$result) {
      die("<h4 class='alert alert-danger text-center mt-3' role='alert'>Hubo un error en la carga, intente nuevamente</h4>");
    }

    $id = mysqli_insert_id($datos_conexion);
    $block = "<h4 class='alert alert-success text-center mt-3' role='alert'>Registro cargado correctamente</h4>";
    
    $data[] = array(
      'id' => $id,
      'block' => $block
    );

    $jsonstring = json_encode($data);
    echo $jsonstring;
  }
  else {
    echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Hubo un error.</h4>";
  }

?>
