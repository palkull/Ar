<?php
include("../Config/config.php");

session_start();
if (!isset($_SESSION['id'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../../Controladores/Login/login.php"); // Cambia "login.php" por tu página de inicio de sesión
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $comentario = $_POST["comentario"];
    $red = $_POST["red_social"];
    

    // Corrige la consulta SQL y proporciona valores para todas las columnas
    $consulta = "INSERT INTO comments (user_id, comentarios, reduser, red_social) VALUES (:user_id, :comentario, :reduser, :red_social)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":user_id", $_SESSION['id']);
    $stmt->bindParam(":comentario", $comentario);
    $stmt->bindParam(":reduser", $user);
    
    $stmt->bindParam(":red_social", $red); // Asegúrate de obtener el valor correcto para "red_social"

    if ($stmt->execute()) {
        header("Location: ../../Vistas/Comentarios.php");
        exit(); // Asegurarse de que el script se detiene después de redirigir
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}


