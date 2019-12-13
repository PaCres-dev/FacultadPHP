<?php
  
  session_start();

  include('../../connection.php');

  if(isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $nota = $_POST['nota'];
    $profesor = $_POST['profesor'];
    $fecha = $_POST['fecha'];
    $seguimientoid = $_POST['seguimientoid'];

    $query = "INSERT INTO examenes (id, nombre, nota, profesor, fecha, seguimientoid) VALUES (0, '$nombre', '$nota', '$profesor', '$fecha', '$seguimientoid')";
    $result = mysqli_query($datos_conexion, $query);

    if (!$result) {
      die("<h4 class='alert alert-danger text-center mt-3' role='alert'>Hubo un error en la carga, intente nuevamente</h4>");
    }
      
    echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Fue agregado correctamente</h4>";  

  }
  else {
    echo "<h4 class='alert alert-success text-center mt-3' role='alert'>Hubo un error.</h4>";
  }
  mysqli_close($datos_conexion);

?>