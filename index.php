<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTN Tus Materias</title>
    <link href="img/favicon.ico" rel="shortcut icon">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">
</head>
<body>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <!-- HEADER -->
        <?php 
        include("./shared/header.php");
        ?>

        <!-- MAIN -->
        <main role="main" class="inner cover text-center">
            <?php 
                if (isset($_SESSION['user'])) {
                    ?>
                    <h1 class="cover-heading">Bienvenido <?php echo $_SESSION['username']; ?></h1>
                    <p class="lead">Anota las materias que has rendido, sus notas y lleva un registro de cada una de ellas</p>
                    <p class="lead">
                        <a href="cursada.php" class="btn btn-lg btn-secondary">Cursada</a>
                        <a href="tusmaterias.php" class="btn btn-lg btn-secondary">Tus materias</a>
                    </p>
                    <?php
                } 
                else {
                    ?>
                    <h1 class="cover-heading">Estudia Mejor</h1>
                    <p class="lead">Anote los parciales y sus notas, las materias que tiene aprobadas y tenga un seguimiento de su carrera de una manera sencilla</p>
                    <p class="lead">
                        <a href="signup.php" class="btn btn-lg btn-secondary">Crear Usuario</a>
                    </p>
                    <?php 
                } 
            ?>
        </main>

        <!-- FOOTER -->
        <?php
        include("./shared/footer.php");
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var i = document.location.href.lastIndexOf("/");
            var currentPHP = document.location.href.substr(i+1);
            $("nav a").removeClass('active');
            $("nav a[href^='"+currentPHP+"']").addClass('active');
        });
    </script>
</body>
</html>