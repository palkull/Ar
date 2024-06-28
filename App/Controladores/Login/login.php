<?php
// Inicia la sesión
session_start();

// Incluye el archivo de configuración de la base de datos
include_once('../Config/config.php');

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos enviados desde el formulario
    $contrasena = $_POST["contrasena"];
    $email = $_POST["email"];

    // Consulta preparada
    $consulta = "SELECT * FROM users WHERE email = :email AND pass = :contrasena";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":contrasena", $contrasena);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // El correo y la contraseña coinciden
        $_SESSION['usuario_autenticado'] = true;
        $_SESSION['email'] = $email;

        // Redirige al usuario a la página de inicio
        header("Location: ../../Vistas/Dash.php");
        exit; // Importante: detén la ejecución del script después de redirigir
    } else {
        // No se encontró una coincidencia
        header("Location: ../../Vistas/index.php");
        exit;
    }
} else {
    // Si no se envió el formulario, redirige al usuario a la página de inicio
    header("Location: ../../Vistas/index.php");
    exit;
}

