<?php
include("../../Config/validarSesion.php");
require_once("../../Config/conexion.php");
$Conexion = new Database;
$con = $Conexion->conectar();
?>

<?php
//3
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    //4
    $sql = $con->prepare("SELECT * FROM tipo_daño WHERE id_daño='$id' or nombre='$tipo'");
    $sql->execute();
    $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($tipo == "") {
        echo '<script>alert ("Hay campos vacios, llena los campos.");</script>';

    } else if ($fila) {
        echo '<script>alert ("Ese tipo de daño ya esta registrado.");</script>';
    } else {
        $insertSQL = $con->prepare("INSERT INTO tipo_daño (id_daño,nombre) VALUES 
        ('$id','$tipo')");

        $insertSQL->execute();
        echo '<script>alert ("Tipo de daño registrado exitosamente.");</script>';
        echo '<script>window.location = "../Visualizar/tipo_daño.php"</script>';
    }

}
?>


<?php include "../Template/header.php"; ?>

<h1>Crear Riesgo</h1>

            <div class="col-sm-12 col-md-8 offset-md-2"> <!-- Ajusté el ancho del formulario -->
                <form method="POST" name="formreg" autocomplete="off">
                    <div class="campos">
                        <input type="text" name="id" placeholder="Id_Daño" readonly>
                    </div>
                    <div class="campos">
                        <input type="text" name="tipo" placeholder="Tipo de daño">
                    </div>
                    <br>
                    <input type="submit" name="inicio" value="Registrar">
                    <input type="hidden" name="MM_insert" value="formreg">
                </form>
            </div>

            <?php include "../Template/footer.php"; ?>