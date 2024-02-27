<?php
require_once("../../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

// Verificar si se recibió el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $id_rol = $_GET['id'];

    // Consultar el rol específico por su ID
    $consulta_rol = "SELECT id_tip_usu, tip_usu FROM roles WHERE id_tip_usu = ?";
    $stmt = $con->prepare($consulta_rol);
    $stmt->execute([$id_rol]);

    // Verificar si la consulta fue exitosa
    if ($stmt->rowCount() > 0) {
        $rol = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "No se encontró el rol con ID: $id_rol";
        exit;
    }
} else {
    echo "ID de rol no proporcionado";
    exit;
}

// Verificar si se envió el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario de edición y actualizar el rol en la base de datos
    $nuevo_rol = $_POST['nuevo_estado'];

    $actualizar_rol = "UPDATE roles SET tip_usu = ? WHERE id_tip_usu = ?";
    $stmt = $con->prepare($actualizar_rol);
    $stmt->execute([$nuevo_rol, $id_rol]);

    if ($stmt->rowCount() > 0) {
        // Redirigir a la página de lista de roles después de la edición exitosa
        header("Location: ../roles.php");
        exit;
    } else {
        echo "Error al actualizar el rol.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Editar Rol</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nuevo_rol" class="form-label">Nuevo Rol</label>
                <input type="text" class="form-control" id="nuevo_rol" name="nuevo_estado" value="<?php echo $rol['tip_usu']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="../roles.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</body>

</html>

<?php
// Cerrar la conexión PDO
$con = null;
?>
