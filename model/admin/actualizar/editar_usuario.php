<?php
require_once("../../../Config/conexion.php");

$conexion = new Database();
$con = $conexion->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $documento = $_POST["documento"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $pin = $_POST["pin"];
    $telefono = $_POST["telefono"];

    $id_rol = $_POST["id_rol"];

    // Construir la parte de la consulta que actualiza la contraseña solo si se proporciona una nueva contraseña
    $password_update = ($password != "") ? ", password='$password'" : "";

    // Actualizar la información en la base de datos
    $consulta_actualizar = "UPDATE usuario SET nombre='$nombre', correo='$telefono', correo='$cor reo' $password_update, id_rol='$id_rol' WHERE documento='$documento'";
    $con->query($consulta_actualizar);

    // Redireccionar a la página principal después de la actualización
    header("Location: ../usuario.php");
    exit();
} else {
    // Obtener el ID del usuario de la URL
    $documento = $_GET["id"];

    // Obtener la información del usuario para prellenar el formulario
    $consulta_usuario = "SELECT * FROM usuario WHERE documento='$documento'";
    $resultado_usuario = $con->query($consulta_usuario);
    $usuario = $resultado_usuario->fetch();
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
    <form method="POST" action="">
        <input type="hidden" name="documento" value="<?php echo $usuario["documento"]; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario["nombre"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario["telefono"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario["correo"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_rol" class="form-label">Tipo de Usuario:</label>
            <select class="form-control" id="id_rol" name="id_rol">
                <?php
                $control = $con->prepare("SELECT * FROM tipo_usuario");
                $control->execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($fila['id_rol'] == $usuario['id_rol']) ? 'selected' : '';
                    echo "<option value=" . $fila['id_rol'] . " $selected>"
                        . $fila['tipo_usu'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    <br>
    <div class="row mt-3">
        <div class="col-md-6 text-start">
            <a href="../usuario.php" class="btn btn-secondary">Regresar</a>
        </div>
    </div>
</div>

</body>
</html>