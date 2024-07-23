<?php
include "../../Controladores/Config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id"]; // Obtener el id del producto a modificar desde el formulario
    $name = $_POST["name"];
    $desc = $_POST["Desc"];
    $categoria = $_POST["categoria"];
    $color = $_POST["color"];
    $id = $_POST["id"];
    $estado = 1;

    try {
        $conexion->beginTransaction(); // Inicia la transacción

        // Actualizar datos del producto en la tabla 'products'
        $sql1 = "UPDATE products SET category_id = :category_id, Descripcion = :Descripcion, Nombre = :nombre, color = :color, Estado = :estado WHERE product_id = :id";
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->bindParam(":nombre", $name);
        $stmt1->bindParam(":Descripcion", $desc);
        $stmt1->bindParam(":category_id", $categoria);
        $stmt1->bindParam(":color", $color);
        $stmt1->bindParam(":estado", $estado);
        $stmt1->bindParam(":id", $id);
        $stmt1->execute();

        if (isset($_FILES['Imagen']) && !empty($_FILES['Imagen']['name'][0])) {
            $total_files = count($_FILES['Imagen']['name']);
            for ($i = 0; $i < $total_files; $i++) {
                $file_name = $_FILES['Imagen']['name'][$i];
                $file_tmp = $_FILES['Imagen']['tmp_name'][$i];

                // Verificar si el archivo subido es válido
                if (!empty($file_name) && is_uploaded_file($file_tmp)) {
                    // Mueve la imagen a la carpeta deseada (por ejemplo, 'uploads/')
                    $target_dir = 'uploads/';
                    $target_path = $target_dir . basename($file_name);
                    if (move_uploaded_file($file_tmp, $target_path)) {
                        // Si se movió correctamente, inserta en la tabla 'productimages'
                        $sql2 = "INSERT INTO productimages (product_id, Nombres, image_path) VALUES (:product_id, :Nombre, :image_path)";
                        $stmt2 = $conexion->prepare($sql2);
                        $stmt2->bindParam(":product_id", $id);
                        $stmt2->bindParam(":Nombre", $file_name);
                        $stmt2->bindParam(":image_path", $target_path);
                        $stmt2->execute();
                    }
                }
            }
        }
        $conexion->commit(); // Confirma la transacción
        echo "Datos actualizados correctamente.";
        echo "<script>window.location.href = '../../Vistas/Editar.php?status=success&product_id=$id&edit=?';</script>";

    } catch (PDOException $e) {
        $conexion->rollBack(); // Revierte la transacción en caso de error
        echo "Error: " . $e->getMessage();
        
        echo "<script>window.location.href = '../../Vistas/Editar.php?product_id=$id&edit=?status=error';</script>";

    }
}
