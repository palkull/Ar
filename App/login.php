<?php
    echo '<a href="../Index.php" >Regresar</a>';
    include_once ('./config.php');

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos enviados desde el formulario
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
            header("Location: Dash.php");
        } else {
            // No se encontró una coincidencia
            header("Location: ../index.php");
        }
    }