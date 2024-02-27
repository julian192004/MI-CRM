<?php
    require_once("../../Config/conexion.php"); 
    $conexion = new Database();
    $con = $conexion->conectar();

    // Recuperar el ID del usuario a editar
    $id_usuario = $_GET['id'];

    // Consulta para obtener los detalles del usuario a editar
    $consulta_usuario = "SELECT * FROM usuario WHERE documento = :id";
    $stmt = $con->prepare($consulta_usuario);
    $stmt->bindParam(':id', $id_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el usuario
    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Agregar enlaces a los archivos CSS y JavaScript de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Editar Usuario</h1>
    <br>
    <form action="actualizar_usuario.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $usuario['documento']; ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>" required>
        </div>

        <!-- Agregar otros campos del usuario -->

        <div class="mb-3">
            <input type="submit" value="Actualizar" class="btn btn-primary">
            <a href="lista_usuarios.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

</body>
</html>
