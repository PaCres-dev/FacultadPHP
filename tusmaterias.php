<?php session_start(); if (!isset($_SESSION['user'])) { header("Location:index.php"); }?>
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

                <!--   TABLE   -->
                <div class="col-lg-12 mt-4 p-4 bg-warning">
                    <div class="m-4">
                        <h2>Anotá las materias que estas cursando en este momento</h2>
                        <p>Anota cada materia en la que cursas y una descripción de la misma, de ese modo luego podras realizar un seguimiento de los parciales y finales de esas materias en la parte de "cursada".</p>
                    </div>
                     <button type="button" class="btn btn-primary my-2" id="agregar" value="Agregar" onclick="agregar();">Añadir Materia</button>
                    <div class="form-inline my-2 ml-auto float-sm-right">
                        <input type="search" id="search" class="form-control mr-ms-2 mr-1" placeholder="Busca tu materia">  
                    </div>
                </div>
                <div id="block"></div>
                <div class="mytable table-responsive p-4 table-dark">
                  <table id="mytable" class="table table-light table-sm text-center table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="id align-middle">#</th>
                            <th scope="col" class="align-middle">Materias</th>
                            <th scope="col" class="align-middle">Información</th>
                            <th scope="col" class="align-middle"></th>
                            <th scope="col" class="align-middle"></th>
                        </tr>
                    </thead>
                    <tbody id="materias">
                    </tbody>
                  </table>
                </div>
            </section>

            <!--   POPUP BOX   -->
            <section id="addmaterias" class="row p-4">
                <div id="popupbox" class="popupbox align-middle">
                    <span class="close m-4" onclick="cancelar();">&times;</span>
                    <div class="card popupbox-content">
                        <div class="card-body">
                        <!--   FORM TO ADD "MATERIAS"   -->
                            <form id="addMateria" name="addMateria" method="POST" class="text-dark">
                                <input type="hidden" id="id">
                                <div class="form-group">
                                    <label for="materia">Agregar materia:</label>
                                    <input type="text" id="materia" name="materia" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Información:</label>
                                    <textarea id="descripcion" name="descripcion" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                                <input id="cancel" class="btn btn-danger" type="button" value ="Cancelar" onclick="cancelar();"/>
                                <input id="save" class="btn btn-success float-right" type="button" name="submit" value ="Guardar" onclick="guardar();"/>
                                <input id="modify" class="btn btn-warning float-right" type="button" name="submit" value ="Modificar" onclick="modificar();"/>          
                            </form>
                        </div>
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
    <script type="text/javascript">
        $(document).ready(function(){
            var i = document.location.href.lastIndexOf("/");
            var currentPHP = document.location.href.substr(i+1);
            $("nav a").removeClass('active');
            $("nav a[href^='"+currentPHP+"']").addClass('active');
        });
    </script>
    <script src="js/materias.js"></script>
</body>
</html>