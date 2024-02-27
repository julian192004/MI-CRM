<?php
require_once("../../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

// Verificar si se recibió el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $id_estado = $_GET['id'];

    // Consultar el estado específico por su ID
    $consulta_estado = "SELECT id_est, tip_est FROM estado WHERE id_est = ?";
    $stmt = $con->prepare($consulta_estado);
    $stmt->execute([$id_estado]);

    // Verificar si la consulta fue exitosa
    if ($stmt->rowCount() > 0) {
        $estado = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "No se encontró el estado con ID: $id_estado";
        exit;
    }
} else {
    echo "ID de estado no proporcionado";
    exit;
}

// Verificar si se envió el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario de edición y actualizar el estado en la base de datos
    $nuevo_estado = $_POST['nuevo_estado'];

    $actualizar_estado = "UPDATE estado SET tip_est = ? WHERE id_est = ?";
    $stmt = $con->prepare($actualizar_estado);
    $stmt->execute([$nuevo_estado, $id_estado]);

    if ($stmt->rowCount() > 0) {
        // Redirigir a la página de lista de estados después de la edición exitosa
        header("Location: ../estado.php");
        exit;
    } else {
        echo "Error al actualizar el estado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Editar Estado</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nuevo_estado" class="form-label">Nuevo Estado</label>
                <input type="text" class="form-control" id="nuevo_estado" name="nuevo_estado" value="<?php echo $estado['tip_est']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="../estado.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</body>

</html>

<?php
// Cerrar la conexión PDO
$con = null;
?>
