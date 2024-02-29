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
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Usuarios Registrados</h1>
    <br>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>PIN</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>NITC</th>
                <th>Tipo de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $consulta = "SELECT * FROM usuario INNER JOIN roles ON usuario.id_tip_usu = roles.id_tip_usu";
            $resultado = $con->query($consulta);

            while ($fila = $resultado->fetch()) {
                echo '
                <tr>
                    <td>' . $fila["documento"] . '</td>
                    <td>' . $fila["nombre"] . '</td>
                    <td>' . (isset($fila["Correo"]) ? $fila["Correo"] : '') . '</td>
                    <td>' . (isset($fila["contrasena"]) ? $fila["contrasena"] : '') . '</td>
                    <td>' . $fila["pin"] . '</td>
                    <td>' . $fila["telefono"] . '</td>
                    <td>' . $fila["direccion"] . '</td>
                    <td>' . (isset($fila["Nitc"]) ? $fila["Nitc"] : '') . '</td>
                    <td>' . (isset($fila["tipo_usu"]) ? $fila["tipo_usu"] : '') . '</td>
                    <td>
                        <div class="text-center">
                            <a href="actualizar/editar_usuario.php?id=' . $fila['documento'] . '" class="btn btn-primary btn-sm">Editar</a>
                            <a href="eliminar/eliminar_usuario.php?id=' . $fila['documento'] . '" class="btn btn-danger btn-sm">Eliminar</a>
                        </div>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="row mt-3">
        <div class="col-md-6 text-start">
            <form action="index.php">
                <input type="submit" value="Regresar" class="btn btn-secondary"/>
            </form>
        </div>
        <div class="col-md-6 text-end">
        </div>
    </div>
</div>
</body>
</html>
