<?php
include('../Config/config.php');
session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén los datos enviados desde el formulario
        $categoria = $_POST["categoria"];
        $categoria = trim(strtolower($categoria));




        $consulta = "INSERT INTO categories values ('', :categoria)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->execute();

        header("Location: ../../Vistas/Dash.php");
    } else {
        // Si no se envió el formulario, redirige al usuario a la página de inicio
        header("Location: ../../Vistas/Login.php");
        exit;
    }


