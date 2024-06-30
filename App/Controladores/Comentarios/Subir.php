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
    $consulta = "INSERT INTO comments (user_id, comment, reduser, red_social) VALUES (:user_id, :comentario, :reduser, :red_social)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":user_id", $_SESSION['id']);
    $stmt->bindParam(":comentario", $comentario);
    $stmt->bindParam(":reduser", $user);
    $stmt->bindParam(":red_social", $red); // Asegúrate de obtener el valor correcto para "red_social"

    if ($stmt->execute()) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosef</title>
</head>

<body>
    <p>Alalalal</p>
</body>

</html>
