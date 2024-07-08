<?php ?>
<?php

session_start();




include ("../Controladores/Config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conexion->beginTransaction();
        $categoriaa = $_POST["categoria"];
        $categoria = trim(strtolower($categoriaa));

        if ($categoria == "cartera") {
            $categoria = "carteras";
        }


        $consulta1 = "SELECT category_id FROM categories WHERE category = :categoria";
        $stmt = $conexion->prepare($consulta1);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            $id = $row["category_id"];
            echo $id;
        } else {
            echo "No se encontraron resultados.";
        }

        $consulta2 = "SELECT p.nombre AS nombre, i.image_path AS image_path FROM products p JOIN productimages i ON p.product_id = i.product_id WHERE p.category_id = :categoria;";
        $stmt = $conexion->prepare($consulta2);
        $stmt->bindParam(":categoria", $id);
        $stmt->execute();
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        echo  "hola";


    } catch (PDOException $e) {
        $conexion->rollBack(); // Revierte la transacción en caso de error
        echo "Error: " . $e->getMessage();
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $categoria; ?></title>
</head>
<body>
    <?php
    $primerProducto = true; // Variable para controlar la impresión del nombre del producto
    while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Accede a los valores de las columnas
        $nombreProducto = $row2["nombre"];
        $urlImagen = $row2["image_path"];
        //echo $urlImagen;
        if ($primerProducto) {
            // Muestra el nombre del producto solo una vez
            echo "<p>Nombre del producto: $nombreProducto</p>";
            $primerProducto = false;
        }
        // \"$urlImagen\"

        // Muestra la imagen
        echo "<img src='../Controladores/Productos/$urlImagen' alt=\"Imagen del producto\">";
    }
    ?>
</body>
</html>