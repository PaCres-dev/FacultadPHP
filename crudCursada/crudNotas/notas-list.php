<?php

  session_start();

  include('../../connection.php');

  $query = "SELECT * from examenes ORDER BY fecha";

  $result = mysqli_query($datos_conexion, $query);

  $json = array();

  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'id' => $row['id'],
      'nombre' => $row['nombre'],
      'nota' => $row['nota'],
      'profesor' => $row['profesor'],
      'fecha' => $row['fecha'],
      'seguimientoid' => $row['seguimientoid']
    );
  }
  $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
  mysqli_close($datos_conexion);
  
?>