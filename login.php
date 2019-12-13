<?php session_start(); if (isset($_SESSION['user'])) { header("Location:index.php"); }?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTN Tus Materias || Registro</title>
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
        <main role="main" class="inner cover">
            <h2>Iniciar Sesión</h2>
            <?php
                if(isset($_GET['login'])) {
                    if($_GET['login']=='error') 
                    {
                        echo "<p class='alert alert-danger' role='alert'>Los datos ingresados son incorrectos.</p>";
                    }
                }
            ?>
        	<form class="mt-4 mb-4" method="POST" action="loginuser.php">
			  	<div class="form-group">
			    	<label for="email">Email:</label>
			    	<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Ingrese su email">
			    	<small id="emailHelp" class="form-text text-muted">ejemplo@mail.com</small>
			  	</div>
			  	<div class="form-group">
			    	<label for="password">Contraseña:</label>
			    	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			 	</div>
			  	<button type="submit" class="btn btn-primary">Ingresar</button>
			</form>
        </main>

        <!-- FOOTER -->
        <?php
        include("./shared/footer.php");
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>
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