<?php session_start(); if (!isset($_SESSION['user']) && !isset($_GET['id']) ) { header("Location:index.php"); }?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTN Tus Materias || Tus Materias</title>
    <link href="img/favicon.ico" rel="shortcut icon">
    <!-- BOOTSTRAP -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
        <!--   HEADER   -->
        <?php 
        include("./shared/header.php");
        ?>

        <!--   MAIN   -->
        <main role="main" class="inner cover p-4 mb-5">
            <section>
                <div class="ficha text-dark mt-4 p-4 row">
                    <?php
                    include("connection.php");

                    $user=$_SESSION['username']." ".$_SESSION['surname'];
                    $id=$_GET['id'];

                    $vercursada=mysqli_query($datos_conexion, "SELECT * FROM seguimiento WHERE id=$id");
                    $mostrarcursada=mysqli_fetch_array($vercursada);
                    if ($mostrarcursada['recursante'] == 1) {
                        $recursante = "Si";
                    } else {
                        $recursante ="No";
                    }

                    $vernotas=mysqli_query($datos_conexion, "SELECT * FROM examenes WHERE seguimientoid=$id ORDER BY fecha");

                    ?>

                    <button class="btn btn-primary" onclick="window.history.back();">Volver</button>
                    <!-- USER NAME -->
                    <div class="usuario col-sm-12 mb-4"><h2 class="text-center "><u><?php echo $user ?></u></h2></div>

                    <!-- DATOS CURSADA -->
                    <div class="vercursada col-sm-6 p-3">
                        <div>
                            <h3>Materia: </h3>
                            <p><?php echo $mostrarcursada['materias']; ?></p>
                        </div>

                        <div>
                            <h3>Temas: </h3>
                            <p><?php echo $mostrarcursada['temas']; ?></p>
                        </div>

                        <div>
                            <h3>Fecha: </h3>
                            <p><?php echo $mostrarcursada['fechafinal']; ?></p>
                        </div>

                        <div>
                        <h3>Recusante: </h3>
                            <p><?php echo $recursante; ?></p>
                        </div>

                        <h3>Sede: </h3>
                        <p><?php echo $mostrarcursada['direccion']; ?></p>
                    </div>

                    <!-- TABLA NOTAS -->
                    <div class="col-sm-6 p-3">
                        <table class="text-center table table-sm table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Examen</th>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Profesor</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody id="notasBody">
                                <?php 
                                while ($mostrarnotas=mysqli_fetch_array($vernotas)) {
                                    ?>
                                    <tr>
                                        <th><?php echo $mostrarnotas['nombre']; ?></th>
                                        <th><?php echo $mostrarnotas['nota']; ?></th>
                                        <th><?php echo $mostrarnotas['profesor']; ?></th>
                                        <th><?php echo $mostrarnotas['fecha']; ?></th>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>

        <!--   FOOTER   -->
        <?php
        include("./shared/footer.php");
        ?>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>
    <script src="js/cursada.js"></script>
    <script src="js/notas.js"></script>
</body>
</html>