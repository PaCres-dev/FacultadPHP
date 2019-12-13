<?php

  session_start();

  include('../connection.php');

  $userid=$_SESSION['id'];

  $query = "SELECT * from seguimiento WHERE user='$userid' ORDER BY id";

  $result = mysqli_query($datos_conexion, $query);

  $json = array();

  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'id' => $row['id'],
      'materias' => $row['materias'],
      'temas' => $row['temas'],
      'fechafinal' => $row['fechafinal'],
      'carrera' => $row['carrera'],
      'recursante' => $row['recursante'],
      'direccion' => $row['direccion']
    );
  }
  $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
  mysqli_close($datos_conexion);
  
?>