<?php
// Inicia la sesión
session_start();

// Incluye el archivo de configuración de la base de datos
include_once ('../Config/config.php');

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos enviados desde el formulario
    $password = $_POST["contrasena"];
    $email = $_POST["email"];
    $encryptedPassword = md5($password);

    echo $encryptedPassword;
    // Consulta preparada
    $consulta = "SELECT * FROM users WHERE email = :email AND pass = :contrasena";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":contrasena", $encryptedPassword);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // El correo y la contraseña coinciden
        $_SESSION['usuario_autenticado'] = true;
        $_SESSION['email'] = $email;

        // Consulta para obtener el ID del usuario
        $consulta_id = "SELECT user_id FROM users WHERE email = :email";
        $stmt_id = $conexion->prepare($consulta_id);
        $stmt_id->bindParam(":email", $email);
        $stmt_id->execute();
        $resultado_id = $stmt_id->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $resultado_id['user_id'];

        $_SESSION['id'] = $id_usuario;

        // Redirige al usuario a la página de bienvenida o al panel de control
        header("Location: ../../Vistas/Dash.php");
        exit; // Importante: detén la ejecución del script después de redirigir
    } else {
        // No se encontró una coincidencia
        header("Location: ../../Vistas/Login.php");
        exit;
    }
} else {
    // Si no se envió el formulario, redirige al usuario a la página de inicio
    header("Location: ../../Vistas/Login.php");
    exit;
}
?>
