<header class="masthead mb-auto p-3 container">
    <div class="inner">
      <a href="index.php"><h3 class="masthead-brand">ESTUDIANTES</h3></a>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href="index.php">Home</a>
        <?php 
	        if(isset($_SESSION['user'])) {
	        ?>
	        	<a class="nav-link" href="cursada.php">Cursada</a>
	        	<a class="nav-link" href="tusmaterias.php">Materias</a>
	        	<a class="nav-link" href="logout.php">Cerrar Sesión</a>
	        <?php
	        } else {
	        ?>
	        	<a class="nav-link" href="login.php">Iniciar Sesión</a>
	        <?php
	        }
        ?>
      </nav>
    </div>
</header>