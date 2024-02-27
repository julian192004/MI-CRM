<?php
require_once("../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

// Lógica para eliminar categoría
if (isset($_GET['eliminar_id'])) {
    $eliminar_id = $_GET['eliminar_id'];
    $consultaEliminar = "DELETE FROM categoria WHERE id_cat = $eliminar_id";
    $con->query($consultaEliminar);
    header('Location: lista_categorias.php');
    exit;
}

$consulta = "SELECT * FROM categoria";
$resultado = $con->query($consulta);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Lista de Categorías</h1>
        <br>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Tipo de Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultado->fetch()) {
                    echo '
                    <tr>
                        <td>' . $fila["id_cat"] . '</td>
                        <td>' . $fila["tip_cat"] . '</td>
                        <td>
                            <a href="actualizar/editar_categoria.php?id=' . $fila["id_cat"] . '" class="btn btn-warning">Editar</a>
                            <a href="eliminar/eliminar_categorias.php?id=' . $fila["id_cat"] . '" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="row mt-3">
            <div class="col-md-6 text-start">
                <a href="crear/crear_categoria.php" class="btn btn-success">Crear Nueva Categoría</a>
            </div>
            <div class="col-md-6 text-end">
                <a href="index.php" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
</body>

</html>