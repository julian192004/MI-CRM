<?php
require_once("../../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario cuando se envía
    $idCategoria = $_POST['id_categoria'];
    $tipoCategoria = $_POST['tipo_categoria'];

    // Validar los datos si es necesario

    // Actualizar la categoría en la base de datos
    $consultaActualizar = "UPDATE categoria SET tip_cat = '$tipoCategoria' WHERE id_cat = $idCategoria";
    $con->query($consultaActualizar);

    // Redirigir a la página principal de categorías
    header('Location: lista_categorias.php');
    exit;
} elseif (isset($_GET['id'])) {
    // Mostrar el formulario de edición si se proporciona un ID en la URL
    $idCategoria = $_GET['id'];

    // Obtener los datos de la categoría para prellenar el formulario
    $consultaObtener = "SELECT * FROM categoria WHERE id_cat = $idCategoria";
    $resultado = $con->query($consultaObtener);

    if ($fila = $resultado->fetch()) {
        $tipoCategoria = $fila['tip_cat'];
    } else {
        // Manejar el caso en que no se encuentre la categoría con el ID dado
        echo "Categoría no encontrada.";
        exit;
    }
} else {
    // Manejar el caso en que no se proporciona un ID
    echo "ID de categoría no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Editar Categoría</h1>
        <br>
        <form method="POST">
            <input type="hidden" name="id_categoria" value="<?php echo $idCategoria; ?>">
            <div class="mb-3">
                <label for="tipo_categoria" class="form-label">Tipo de Categoría</label>
                <input type="text" class="form-control" id="tipo_categoria" name="tipo_categoria" value="<?php echo $tipoCategoria; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
        <div class="col-md-6 text-end">
                <a href="../categoria.php" class="btn btn-primary">Regresar</a>
            </div>
    </div>

</body>

</html>
    