<?php
require_once("../../../Config/conexion.php"); 
$conexion = new Database();
$con = $conexion->conectar();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "SELECT * FROM usuario WHERE documento = :id";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Handle invalid request or redirect to appropriate page
    header("Location: ../../usuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Editar Usuario</h1>
    <br>
    <form action="guardar_edicion.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['documento']; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['Correo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <div class="mb-3">
            <label for="pin" class="form-label">Pin</label>
            <input type="text" class="form-control" id="pin" name="pin" value="<?php echo $usuario['pin']; ?>" required>
        </div>
        <!-- Agregar campos adicionales según tu tabla -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $usuario['direccion']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nitc" class="form-label">NITC</label>
            <input type="text" class="form-control" id="nitc" name="nitc" value="<?php echo $usuario['Nitc']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tipo_usu" class="form-label">Tipo de Usuario</label>
            <input type="text" class="form-control" id="tipo_usu" name="tipo_usu" value="<?php echo $usuario['tipo_usu']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
    <br>
    <div class="row mt-3">
        <div class="col-md-6 text-start">
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
        <div class="col-md-6 text-end">
        </div>
    </div>
</div>
</body>
</html>
