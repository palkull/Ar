<?php
include("../Controladores/Config/config.php");

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $consulta = "SELECT p.nombre, p.Descripcion, p.color, i.image_path 
                 FROM products p 
                 JOIN productimages i ON p.product_id = i.product_id 
                 WHERE p.product_id = :product_id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
    $stmt->execute();

    $details = '<div class="product-details">';
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $details .= '<div class="product-image">';
        $details .= "<img src='../Controladores/Productos/uploads/" . $row["image_path"] . "' alt='Imagen del producto' width='300px'>";
        $details .= '</div>';

        $details .= '<div class="product-info">';
        $details .= "<h1>" . $row["nombre"] . "</h1>";
        $details .= "<p>" . $row["Descripcion"] . "</p>";
        $details .= "<p>Color: " . $row["color"] . "</p>";
        $details .= '</div>';
    }
} else {
    $details .= "<p>No se encontraron detalles del producto.</p>";
}
$details .= '</div>';


    echo $details;
} else {
    echo "<p>ID de producto no especificado.</p>";
}
?>
