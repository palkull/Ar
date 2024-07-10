<?php
session_start();

if (!isset($_SESSION['id'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php"); // Cambia "login.php" por tu página de inicio de sesión
    exit;
}

$_SESSION['email'];
$_SESSION['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>

<body>
    <!-- <nav class="navbar">
        <ul>
            <li><a href="./categorias.php">Categorias</a></li>
            <li><a href="./Dash.php">Productos</a></li>
            <li><a href="./Comentarios.php">Reseñas</a></li>
        </ul>
    </nav> -->
    <form action="../Controladores/Productos/categoria.php" method="POST">
        <label>Categoria</label>
        <input type="text" name="categoria" id="" placeholder="Categoria">
        <button type="submit">Subir</button>
    </form>
</body>

</html>