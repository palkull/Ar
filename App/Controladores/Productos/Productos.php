<?php
include "../Config/config.php";
$carpeta = 'uploads';

if (!is_dir($carpeta)) {
    // Crea la carpeta
    if (mkdir($carpeta, 0777, true)) {
    } else {
    }
} else {
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $desc = $_POST["Desc"];
    $dimensiones = $_POST["dimensiones"];
    $det1 = $_POST["detalle1"];
    $det2 = $_POST["detalle2"];
    $categoria = $_POST["categoria"];
    $color = $_POST["color"];
    $estado = 1;




    try {
        $conexion->beginTransaction(); // Inicia la transacción

        // Inserta en la tabla 'Producto'
        $sql1 = "INSERT INTO products (category_id, Descripcion, dimensiones, detalle1, detalle2, Nombre, color, Estado) VALUES (:category_id, :Descripcion, :dimensiones, :detalle1, :detalle2, :nombre, :color, :estado)";
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->bindParam(":nombre", $name);
        $stmt1->bindParam(":Descripcion", $desc);
        $stmt1->bindParam(":detalle1", $det1);
        $stmt1->bindParam(":detalle2", $det2);
        $stmt1->bindParam(":dimensiones", $dimensiones);
        $stmt1->bindParam(":category_id", $categoria);
        $stmt1->bindParam(":color", $color);
        $stmt1->bindParam(":estado", $estado);
        $stmt1->execute();
        // Obtén el ID del producto recién insertado
        $producto_id = $conexion->lastInsertId();

        // usar $producto_id como el ID del producto



        // Procesa las imágenes subidas
        if (isset($_FILES['Imagen'])) {
            $total_files = count($_FILES['Imagen']['name']);
            for ($i = 0; $i < $total_files; $i++) {
                $file_name = $_FILES['Imagen']['name'][$i];
                $file_tmp = $_FILES['Imagen']['tmp_name'][$i];

                // Mueve la imagen a la carpeta deseada (por ejemplo, 'uploads/')
                $target_dir = 'uploads/';
                $target_path = $target_dir . basename($file_name);
                move_uploaded_file($file_tmp, $target_path);

                // Guarda la ruta en la base de datos (por ejemplo, en la columna 'image_path')
                $sql2 = "INSERT INTO productimages (product_id, Nombres, image_path) VALUES (:product_id, :Nombre, :image_path)";
                $stmt2 = $conexion->prepare($sql2);
                $stmt2->bindParam(":product_id", $producto_id);
                $stmt2->bindParam(":Nombre", $file_name);
                $stmt2->bindParam(":image_path", $target_path);
                $stmt2->execute();
                // echo "Producto insertado con ID: " . $producto_id;

            }
        }
        // Inserta en la tabla 'Imagen'
        $conexion->commit(); // Confirma la transacción

        echo "<script>window.location.href = '../../Vistas/Productos.php?status=success';</script>";



    } catch (PDOException $e) {
        $conexion->rollBack(); // Revierte la transacción en caso de error
        echo "Error: " . $e->getMessage();
        echo "<script>window.location.href = '../../Vistas/Productos.php?status=error';</script>";
    }
}



