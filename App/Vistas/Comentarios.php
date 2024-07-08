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
    <title>Comentarios</title>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="./categorias.php">Categorias</a></li>
            <li><a href="./Dash.php">Productos</a></li>
            <li><a href="./Comentarios.php">Reseñas</a></li>
        </ul>
    </nav>
    <center>

        <form action="../Controladores/Comentarios/Subir.php" method="post">
            <label for="">Usuario: </label>
            <input type="text" placeholder="User" name="user" required><br>
            <select name="red_social" id="" required>
                <option value="0" selected>Instagram</option>
                <option value="1">Facebook</option>
            </select>
            <br>
            <input type="text" placeholder="Comentario" style="height: 40px; width: 300px;" name="comentario" required>
            <button type="submit">Subir</button>
        </form>
    </center>

</body>

</html>