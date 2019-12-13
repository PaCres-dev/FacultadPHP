<?php session_start(); if (!isset($_SESSION['user'])) { header("Location:index.php"); }?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTN Tus Materias || Cursada</title>
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
            <!--   SECTION TABLE   -->
            <section>
                <div class="col-lg-12 mt-4 p-4 bg-info">
                    <div class="m-4">
                        <h2>Seguimiento de Cursada</h2>
                        <p>Agregá las materias que rendiste, sus notas y lleva un seguimiento de las mismas, tambien puede editarlas o borrarlas en caso de errores.</p>
                    </div>
                     <button type="button" class="btn btn-primary my-2" id="agregar" value="Agregar" onclick="agregar();">Añadir Registro</button>
                    <div class="my-2 ml-auto float-sm-right">
                        <input type="search" id="search" class="form-control mr-ms-2 mr-1" placeholder="Busca tu registro">
                    </div>
                </div>
                <div id="block"></div>
                <!--   TABLE   -->
                <div class="mytable table-responsive p-4 table-dark">
                  <table id="mytable" class="table table-sm table-dark text-center table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="id align-middle">#</th>
                            <th scope="col" class="align-middle">Materias</th>
                            <th scope="col" class="align-middle">Temas</th>
                            <th scope="col" class="align-middle">Parciales y Finales</th>
                            <th scope="col" class="align-middle">Fecha de Aprobación</th>
                            <th scope="col" class="align-middle">Carrera</th>
                            <th scope="col" class="align-middle">Recursante</th>
                            <th scope="col" class="align-middle">Sede</th>
                            <th scope="col" class="align-middle"></th>
                            <th scope="col" class="align-middle"></th>
                            <th scope="col" class="align-middle"></th>
                        </tr>
                    </thead>
                    <tbody id="seguimiento">
                    </tbody>
                  </table>
                </div>
            </section>

            <!--   POPUP FORM   -->
            <section id="addElements">
                <!--   FORM TO ADD "REGISTROS DE MATERIAS"   -->
                <div id="popupbox" class="popupbox">
                    <span class="close m-4" onclick="cancelar();">&times;</span>
                    <form class="mt-4 mb-4" method="POST" name="addRegistro" id="addRegistro">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group"> 
                            <label for="materias">Materia a las que estas inscripto:</label>
                            <select class="form-control" id="materias" name="materias">
                                <?php
                                    include("connection.php");
                                    $id=$_SESSION['id'];
                                    $consultar_materias=mysqli_query($datos_conexion, "SELECT id, materia, descripcion FROM materias WHERE user=$id");
                                    while ($mostrar_materias=mysqli_fetch_array($consultar_materias))
                                    {
                                        ?>
                                        <option value="<?php echo $mostrar_materias['materia'];?>"><?php echo $mostrar_materias['materia'];?></option>
                                        <?php
                                    } 
                                ?>
                            </select>
                            <small class="form-text text-muted">Si no tienes ninguna materia, ve a la sección "Materias" y agrega las que estás cursando en este momento.*</small>
                        </div>
                        <div class="form-group">
                            <label for="temas">Temas:</label>
                            <textarea class="form-control" id="temas" name="temas" value="" required></textarea>
                        </div>
                        <div class="form-group divtablita">
                            <label>Examenes: </label>
                            <table id="tablanotas" class="text-center table table-sm table-bordered table-dark" style="display: relative; width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Examen</th>
                                        <th scope="col">Nota</th>
                                        <th scope="col">Profesor</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="notasBody">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-left" colspan="6">
                                            <a class="btn btn-primary" onclick="addNota();">
                                                Agregar un nuevo examen
                                            </a>
                                            <small class="text-muted">Tus notas se guardaran al guardar la cursada completa.</small>
                                            <input type="hidden" id="cantN" value="">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="fechafinal">Fecha:</label>
                            <input type="date" class="form-control" id="fechafinal" name="fechafinal">
                        </div>
                        <div class="form-group">
                            <label for="carrera">Carrera:</label>
                            <select class="form-control" id="carrera" name="carrera">
                                <option value="Ingeniería Civil">Ingeniería Civil</option>
                                <option value="Ingeniería Eléctrica">Ingeniería Eléctrica</option>
                                <option value="Ingeniería Electrónica">Ingeniería Electrónica</option>
                                <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                                <option value="Ingeniería Mecánica">Ingeniería Mecánica</option>
                                <option value="Ingeniería Sistemas de Información">Ingeniería Sistemas de Información</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="recursante" name="recursante">
                            <label class="form-check-label" for="defaultCheck1">
                                Recursante
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Sede:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="buttonsBar">
                            <input id="cancel" class="btn btn-danger" type="button" value ="Cancelar" onclick="cancelar();"/>
                            <input id="save" class="btn btn-success float-right" type="button" name="submit" onclick="guardar();" value ="Guardar"/>
                            <input id="modify" class="btn btn-warning float-right" type="button" name="submit" onclick="modificar();" value ="Modificar"/>
                        </div>
                    </form>
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
            $("nav a[href='"+currentPHP+"']").addClass('active');
        });
    </script>
    <script src="js/cursada.js"></script>
    <script src="js/notas.js"></script>
</body>
</html>