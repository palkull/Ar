<?php
include("../Config/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $consulta = "INSERT INTO users (user, email, pass, rol) VALUES (:user, :email, :pass, :rol)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":user", $user);
    $stmt->bindParam(":pass", $hash);
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
