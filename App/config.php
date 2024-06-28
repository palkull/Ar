

<?php
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "";
    $base_de_datos = "ar_test";

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$base_de_datos", $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>
