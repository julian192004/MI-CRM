<?php
    session_start();
    require_once("../../Config/conexion.php"); 
    $conexion = new Database();
    $con = $conexion->conectar();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Interfaz admin</title>
    <link rel="stylesheet" type="text/css" href="../../css/stile.css">
</head>
<body>

<style>
      body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .product {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            width: calc(50% - 20px);
            box-sizing: border-box;
            transition: transform 0.3s ease-in-out;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-title {
            color: #333;
            margin-bottom: 10px;
        }

        .product-btn {
            display: block;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease-in-out;
        }

        .product-btn:hover {
            background-color: #2980b9;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #e74c3c;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c0392b;
        }
        </style>

<?php  
    $sql = $con->prepare("SELECT * FROM usuario INNER JOIN roles ON usuario.id_tip_usu = roles.tip_usu");
    $sql->execute();
    $fila = $sql->fetch();
?>

<section class="container">
    <h1>Bienvenido/a <?php echo $fila['nombre']; ?> <?php echo $_SESSION['nombre']; ?> </h1>

    <div class="product">
        <img src="../../img/usuario.jpg">
        <div class="product-info">
            <h4 class="product-title">usuario</h4>
            <a class="product-btn" href="usuario.php">Ingresar</a>
        </div>
    </div>

    <div class="product">
        <img src="../../img/usuario.jpg">
        <div class="product-info">
            <h4 class="product-title">estado</h4>
            <a class="product-btn" href="estado.php">Ingresar</a>
        </div>
    </div>

    <div class="product">
        <img src="../../img/usuario.jpg">
        <div class="product-info">
            <h4 class="product-title">roles</h4>
            <a class="product-btn" href="roles.php">Ingresar</a>
        </div>
    </div>

    <div class="product">
        <img src="../../img/usuario.jpg">
        <div class="product-info">
            <h4 class="product-title">categoria</h4>
            <a class="product-btn" href="categoria.php">Ingresar</a>
        </div>
    </div>

</section>
<form method="POST">
    <input type="submit" value="Cerrar sesión" name="btncerrar">
</form>

<?php 
if(isset($_POST['btncerrar']))
{
    session_destroy();
    header('location: ../../login.php');
}
?>

</body>
</html>
