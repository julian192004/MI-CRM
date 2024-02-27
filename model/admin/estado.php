<?php
require_once("../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

// Consulta para obtener los datos de la tabla estado usando PDO
$sql = "SELECT id_est, tip_est FROM estado";
$resultado = $con->query($sql);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Comprobar si hay filas en el resultado
    if ($resultado->rowCount() > 0) {
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Lista de estados</title>
            <!-- Agregar enlaces a los archivos CSS y JavaScript de Bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>

        <div class="container mt-5">
            <h1 class="text-center">Lista de estados</h1>
            <br>
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID Estado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                        <tr>
                            <td>' . $fila["id_est"] . '</td>
                            <td>' . $fila["tip_est"] . '</td>
                            <td>
                                <div class="text-center">
                                    <a href="editar/editar_estado.php?id=' . $fila["id_est"] . '" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="eliminar/eliminar_estado.php?id=' . $fila["tip_est"] . '" class="btn btn-danger btn-sm">Eliminar</a>
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
            </div>
            <div class="text-end mb-3">
        <a href="crear/crear_estado.php" class="btn btn-success">Crear Nuevo Estado</a>
    </div>
        </div>
        </body>
        </html>

        <?php
    } else {
        echo "No hay resultados en la tabla estado.";
    }
} else {
    echo "Error en la consulta: " . $con->errorInfo()[2];
}

// Cerrar la conexión PDO
$con = null;
?>