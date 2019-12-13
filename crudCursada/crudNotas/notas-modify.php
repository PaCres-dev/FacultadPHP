<?php

  include('../../connection.php');

  if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $nota = $_POST['nota'];
    $profesor = $_POST['profesor'];
    $fecha = $_POST['fecha'];

    $row = mysqli_query($datos_conexion, "UPDATE examenes SET nombre = '$nombre', nota = '$nota', profesor = '$profesor', fecha = '$fecha' WHERE id=$id");

    if (!$row) {
        die("<h4 class='alert alert-danger text-center' role='alert mt-3'>Hubo un error en la carga, intente nuevamente</h4>");
    }

    echo "Registro actualizado correctamente";

    mysqli_close($datos_conexion);  
  }

?>