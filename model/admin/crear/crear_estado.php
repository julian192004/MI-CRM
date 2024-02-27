<?php
require_once("../../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();


// Verificar si se envió el formulario de creación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario de creación y agregar el nuevo estado a la base de datos
    $nuevo_estado = $_POST['nuevo_estado'];

    $insertar_estado = "INSERT INTO estado (tip_est) VALUES (?)";
    $stmt = $con->prepare($insertar_estado);
    $stmt->execute([$nuevo_estado]);

    if ($stmt->rowCount() > 0) {
        // Redirigir a la página de lista de estados después de la creación exitosa
        header("Location: ../estado.php");
        exit;
    } else {
        echo "Error al crear el estado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Estado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Crear Estado</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nuevo_estado" class="form-label">Nuevo Estado</label>
            <input type="text" class="form-control" id="nuevo_estado" name="nuevo_estado" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Estado</button>
        <a href="../index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>

<?php
// Cerrar la conexión PDO
$con = null;
?>