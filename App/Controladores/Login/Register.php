<?php
include("../Config/config.php");

session_start();

if (!isset($_SESSION['id'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php"); // Cambia "login.php" por tu página de inicio de sesión
    exit;
}

$_SESSION['email'];
$_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $encryptedPassword = md5($password);
    

    $consulta = "INSERT INTO users (user, email, pass, rol) VALUES (:user, :email, :pass, :rol)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":user", $user);
    $stmt->bindParam(":pass", $encryptedPassword);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam("rol", $rol);
    $stmt->execute();

    // if ($consulta) {
    //     echo"Si jalo xdd";
    // }
    header("Location: ../../Vistas/Dash.php");
}

//Verificar la contraseña
// $password_ingresada = "mi_contraseña_ingresada";
// if (password_verify($password_ingresada, $hash)) {
//     // Contraseña válida
// } else {
//     // Contraseña incorrecta
// }
