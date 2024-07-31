<?php
session_start();
$isAdmin = isset($_SESSION['email']);

include "../Controladores/Config/config.php";

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $consulta = "SELECT p.nombre, p.Descripcion, p.dimensiones, p.detalle1, p.detalle2, p.color, p.product_id, i.image_path 
                 FROM products p 
                 JOIN productimages i ON p.product_id = i.product_id 
                 WHERE p.product_id = :product_id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "<p>ID de producto no especificado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detalles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Detalles del producto</title>
</head>
<header>
    <div class="arrow" onclick="history.go(-1);">
        <div class="arrow-top"></div>
        <div class="arrow-bottom"></div>
    </div>

    <a href="../../index.php" class="header-logo">
        <div class="header2">
            <h1>ar</h1>
            <h2>Artesanía en Piel</h2>
        </div>
    </a>
        <div class="container">
            <a href="./Busqueda.php"><i class="fas fa-search"></i></a>
        </div>
</header>

<body>
    <div class="product-details">
        <?php if ($product): ?>
            <div class="product-info">
                <h1><?php echo $product[0]["nombre"]; ?></h1>
                <p><?php echo $product[0]["Descripcion"]; ?></p>
                <p><?php echo $product[0]["detalle1"]; ?></p>
                <p><?php echo $product[0]["detalle2"]; ?></p>
                <p><?php echo $product[0]["dimensiones"]; ?></p>
                <p>Color: <?php echo $product[0]["color"]; ?></p>
            </div>
            <div class="product-images">
                <?php foreach ($product as $row): ?>
                    <div class="product-image">
                        <img src='../Controladores/Productos/<?php echo $row["image_path"]; ?>' alt='Imagen del producto' width='300px'>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron detalles del producto.</p>
        <?php endif; ?>
    </div>

    <script>
       
    </script>
</body>
</html>