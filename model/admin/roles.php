<?php
require_once("../../Config/conexion.php"); 
$conexion = new Database();
$con = $conexion->conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tipos de Usuario</title>
    <!-- Agregar enlaces a los archivos CSS y JavaScript de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Lista de Tipos de Usuario</h1>
    <br>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>id_rol</th>
                <th>Tipo de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $consulta = "SELECT * FROM roles";
             
            $resultado = $con->query($consulta);

            while ($fila = $resultado->fetch()) {
                echo '
                <tr>
                    <td>' . $fila["id_tip_usu"] . '</td>
                    <td>' . $fila["tip_usu"] . '</td>
                    <td>
                        <div class="text-center">
                            <a href="actualizar/editar_rol.php?id=' . $fila["id_tip_usu"] . '" class="btn btn-primary btn-sm">Editar</a>
                            <a href="eliminar/eliminar_rol.php?id=' . $fila["id_tip_usu"] . '" class="btn btn-danger btn-sm">Eliminar</a>
                        </div>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="row mb-3">
        <div class="col-md-6 text-start">
            <a href="crear/crear_rol.php" class="btn btn-success">Crear Nuevo Tipo de Usuario</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 text-start">
            <form action="index.php">
                <input type="submit" value="Regresar" class="btn btn-secondary"/>
            </form>
        </div>
    </div>
</div>
</body>
</html>
