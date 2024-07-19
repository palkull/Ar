<?php
include '../../Controladores/Config/config.php';

if (isset($_GET['image_id'])) {
    $imageId = $_GET['image_id'];
    // Aquí puedes realizar alguna operación con $imageId, por ejemplo, guardar en la base de datos, procesar datos, etc.
    $consulta = 'DELETE FROM productimages WHERE image_id = :imageId';
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':imageId', $imageId);
    $stmt->execute();


    // Puedes devolver una respuesta si es necesario (opcional)
    echo "Operación completada";
} else {
    echo "Error: No se proporcionó el image_id.";
}

