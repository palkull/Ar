<?php
session_start();
$isAdmin = isset($_SESSION['email']);

include "../Controladores/Config/config.php";

$sql = "SELECT image_path FROM productimages";
$stmt = $conexion->query($sql);

// Verificar si se encontraron imágenes

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
</head>

<body>
    <?php
    if ($stmt->rowCount() > 0) {
        // Recorrer y mostrar todas las imágenes
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $image_url = $row['image_path'];
            echo "<img src='../Controladores/Productos/$image_url' alt='Imagen' style='width:200px;height:auto;margin:10px;'/>";
        }
    } else {
        echo "No se encontraron imágenes.";
    }
    ?>
</body>

</html>