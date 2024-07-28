<?php
include "../Controladores/Config/config.php";

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $consulta = "SELECT p.nombre, p.Descripcion, p.color, p.product_id, i.image_path FROM products p JOIN productimages i ON p.product_id = i.product_id WHERE p.product_id = :product_id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product_id_anterior = '';
    $details = '<div class="product-details">';
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_id = $row['product_id'];

            if ($product_id !== $product_id_anterior) {
                $details .= '<div class="product-info">';
                $details .= "<h1>" . $row["nombre"] . "</h1>";
                $details .= "<p>" . $row["Descripcion"] . "</p>";
                $details .= "<p>Color: " . $row["color"] . "</p>";
                $details .= "<h4>Contactanos</h4>";
                $details .= "<a href='https://www.instagram.com/ar_artesaniaenpiel/'>Instagram</a> <br>";
                $details .= "<a href='https://www.facebook.com/arartesaniaenpielDgo/'>Facebook</a>";


                $details .= '</div>';
                $product_id_anterior = $product_id;
                $details .= '<div id="product_item">';
            }
            $details .= '<div class="product-image">';
            $details .= "<img src='../Controladores/Productos/" . $row["image_path"] . "' alt='Imagen del producto' width='300px'>";
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

