<?php
include ("../Controladores/Config/config.php");

session_start();
if (!isset($_SESSION['email'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php"); // Cambia "login.php" por tu página de inicio de sesión
    exit;
}

$sql = "SELECT category_id, category FROM categories";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link rel="stylesheet" href="../css/dash.css">
</head>

<body>
    <header>
        <a class="izq" href="../Controladores/Login/logout.php">Cerrar Sesión</a>
        <a href="../../index.php">
            <div class="header2">
                <h1>ar</h1>
                <h2>Artesaníaen Piel</h2>
            </div>
        </a>
        <a class="der" href="./catalogo.php">Catálogo ></a>

    </header>
    <div class="navbar">
        <div class="editor editor1">
            <a href="./categorias.php">Categorias</a>
        </div>
        <div class="editor editor2">
            <a href="./productos.php">Productos</a>
        </div>
        <div class="editor editor3">
            <a href="./Comentarios.php">Reseñas</a>
        </div>
    </div>
</body>

</html>