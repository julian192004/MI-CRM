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
    <form class="row g-3 needs-validation" method="post" novalidate>
    <div class="col-12">
        <label class="form-label" for="documento">Documento</label>
        <input type="number" id="documento" name="documento" class="form-control" value="<?php echo $usuario["documento"]; ?>" minlength="9" required readonly>
        <div class="invalid-feedback">Por Favor, ingrese su Documento!</div>
    </div>
    <div class="col-12">
        <label class="form-label" for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $usuario["nombre"]; ?>" required>
        <div class="invalid-feedback">Por Favor, ingrese su Nombre!</div>
    </div>
    <div class="col-12">
        <label class="form-label" for="correo">Correo</label>
        <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $usuario["correo"]; ?>" required>
        <div class="invalid-feedback">Por Favor, ingrese su Correo!</div>
</div>
    <div class="col-12">
        <label class="form-label" for="pin">Pin</label>
        <input type="number" id="pin" name="pin" class="form-control" value="<?php echo $usuario["pin"]; ?>" pattern="\d{5,}" required>
        <div class="invalid-feedback">Por Favor, ingrese su Pin!</div>
    </div>
    <div class="col-12">
        <label class="form-label" for="telefono">Telefono</label>
        <input type="number" id="telefono" name="telefono" class="form-control" value="<?php echo $usuario["telefono"]; ?>" required>
        <div class="invalid-feedback">Por Favor, ingrese su Telefono!</div>
    </div>
    <div class="col-12">
        <label class="form-label" for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $usuario["direccion"]; ?>" required>
        <div class="invalid-feedback">Por Favor, ingrese su Dirección!</div>
    </div>
    <div class="col-12">
        <label for="id_rol" class="form-label">Tipo de Usuario:</label>
        <select class="form-control" id="id_rol" name="id_rol">
        <?php
$control = $con->prepare("SELECT * FROM roles");
$control->execute();
while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
    $selected = ($fila['id_tip_usu'] == $usuario['tip_usu']) ? 'selected' : '';
    echo "<option value=" . $fila['id_tip_usu'] . " $selected>"
        . $fila['tip_usu'] . "</option>";
}
?>

        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Actualizar</button>
    </div>
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