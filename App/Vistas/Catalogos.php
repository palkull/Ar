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

        $consulta2 = "SELECT products.Descripcion, products.Nombre, products.color, productimages.image_path FROM products JOIN productimages ON products.product_id = productimages.product_id WHERE products.category_id = :categoria;";
        $stmt->bindParam(":categoria", $id);
        $stmt->execute();



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
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div>
            <?php
            echo $row["products.Descripcion"]
            ?>
        </div> <?php
    }
    ?>

</body>

</html>