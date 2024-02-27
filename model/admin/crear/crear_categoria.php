<?php
require_once("../../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario cuando se envía
    $tipoCategoria = $_POST['tipo_categoria'];

    // Validar los datos si es necesario

    // Insertar nueva categoría en la base de datos
    $consultaInsertar = "INSERT INTO categoria (tip_cat) VALUES ('$tipoCategoria')";
    $con->query($consultaInsertar);

    // Redirigir a la página principal de categorías (en este caso, categoria.php)
    header('Location: ../../categoria.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Crear Nueva Categoría</h1>
        <br>
        <form method="POST">
            <div class="mb-3">
                <label for="tipo_categoria" class="form-label">Tipo de Categoría</label>
                <input type="text" class="form-control" id="tipo_categoria" name="tipo_categoria" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <div class="col-md-6 text-end">
                <a href="../categoria.php" class="btn btn-primary">Regresar</a>
            </div>
    </div>

</body>

</html>
