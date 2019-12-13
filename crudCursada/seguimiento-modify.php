<?php

  include('../connection.php');

  if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $materia = $_POST['materias'];
    $temas = $_POST['temas'];
    $fechafinal = $_POST['fechafinal'];
    $carrera = $_POST['carrera'];
    $recursante = $_POST['recursante'];
    $sede = $_POST['sede'];

    $row = mysqli_query($datos_conexion, "UPDATE seguimiento SET materias = '$materia', direccion = '$sede', temas = '$temas', fechafinal = '$fechafinal', recursante = '$recursante', carrera = '$carrera' WHERE id=$id");

    if (!$row) {
        die("<h4 class='alert alert-danger text-center' role='alert mt-3'>Hubo un error en la carga, intente nuevamente</h4>");
    }

    $block = "<h4 class='alert alert-success text-center mt-3' role='alert'>Registro actualizado correctamente</h4>";

    $data[] = array(
      'id' => $id,
      'block' => $block
    );

    $jsonstring = json_encode($data);
    echo $jsonstring;

    mysqli_close($datos_conexion);  
  }

?>
