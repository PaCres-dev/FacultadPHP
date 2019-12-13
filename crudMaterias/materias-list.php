<?php

  session_start();

  include('../connection.php');

  $userid=$_SESSION['id'];

  $query = "SELECT * from materias WHERE user='$userid' ORDER BY id";

  $result = mysqli_query($datos_conexion, $query);

  $json = array();

  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'id' => $row['id'],
      'materia' => $row['materia'],
      'descripcion' => $row['descripcion']
    );
  }
  $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
  mysqli_close($datos_conexion);
?>