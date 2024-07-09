<?php
session_start();
$isAdmin = isset($_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con PHP</title>
    <link rel="stylesheet" href="./App/css/login.css">
</head>

<body>
    <div class="contenido">
        <div class="logo">
            <h1>ar</h1>
        </div>
    <h2>Hola, Bienvenida de nuevo!</h2>
    <form action="./App/Controladores/Login/login.php" method="post">
        <p>Email</p>
        <input type="email" name="email" placeholder="Email">
        <p>Contraseña</p>
        <input type="password" name="contrasena" placeholder="Contraseña">
        <div class="botonI">
        <button type="submit" class="btn-shine">Iniciar Sesión</button>
        </div>
    </form>
    <a href="./App/Vistas/Register.php" >Registrar</a>
    </div>
</body>

</html>