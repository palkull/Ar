<?php ?>
<?php

session_start();
$isAdmin = isset($_SESSION['email']);




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
            // echo $id;
        } else {
            echo "No se encontraron resultados.";
        }

        $consulta2 = "SELECT p.nombre AS nombre, p.Descripcion AS Descripcion, p.color AS color, p.product_id  AS product_id,  i.image_path AS image_path FROM products p JOIN productimages i ON p.product_id = i.product_id WHERE p.category_id = :categoria;";
        $stmt = $conexion->prepare($consulta2);
        $stmt->bindParam(":categoria", $id);
        $stmt->execute();
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);



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
    <script>
        function toggleButtons() {
            const originalButton = document.getElementById("originalButton");
            const originalButton2 = document.getElementById("originalButton2");
            const buttons = document.querySelectorAll(".button1, .button2");

            // Toggle display for originalButton and originalButton2
            originalButton.style.display = "none";
            originalButton2.style.display = "block";

            // Show all buttons with classes button1 and button2
            buttons.forEach(button => {
                button.style.display = "block";
            });
        }
        function regreso() {
            const originalButton = document.getElementById("originalButton");
            const originalButton2 = document.getElementById("originalButton2");
            const buttons = document.querySelectorAll(".button1, .button2");

            // Toggle display for originalButton and originalButton2
            originalButton.style.display = "block";
            originalButton2.style.display = "none";

            // Show all buttons with classes button1 and button2
            buttons.forEach(button => {
                button.style.display = "none";
            });
        }
    </script>
</head>

<body>

    <header>
        <p>Modo Administrador:</p>
        <?php
        if ($isAdmin): ?>
            <div>
                <button id="originalButton" onclick="toggleButtons()">ON</button>
                <button id="originalButton2" style="display: none;" onclick="regreso()">OFF</button>
            </div>
        <?php endif; ?>
    </header>
    <div class="productos">
        <?php
        // Variable para almacenar el nombre del último producto procesado
        $product_id_anterior = null;

        // Verificamos si se ejecutó la consulta y hay resultados
        if ($stmt->rowCount() > 0) {
            while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nombreProducto = $row2["nombre"];
                $urlImagen = $row2["image_path"];
                $Descripcion = $row2["Descripcion"];
                $product_id = $row2["product_id"];
                $color = $row2["color"];

                // Mostrar el nombre del producto solo la primera vez
                if ($product_id !== $product_id_anterior) { ?>
                    <div class='producto'>
                        <p>Nombre del producto: <?php echo $nombreProducto ?></p>
                        <?php $product_id_anterior = $product_id;
                        if ($isAdmin): ?>
                            <div class="Botones_admin">
                                <form action="../Controladores/Productos/Desabilitar.php" method="POST">
                                    <button class="button1" type="submit" value="<?php echo $product_id ?>"
                                        style="display: none;" name="comentario">Desabilitar</button>
                                </form>
                                <form action="../Vistas/Editar.php" method="POST">
                                    <button class="button2" type="submit" value="<?php echo $product_id ?>"
                                        style="display: none;" name="comentario">Editar</button>
                                </form>
                            </div>
                        <?php endif;
                }
                // <?php echo $urlImagen 
                // Mostrar la imagen del producto
                ?>
                    <img src='../Controladores/Productos/uploads/favoritos.jpeg ' alt='Imagen del producto' width="150px" height="150px" >
                    <?php
                    // Botones de administrador si es admin
            
                    echo "</div>"; // Cierre del div de producto
            }
        } else {
            echo "<p>No se encontraron productos.</p>";
        }
        ?>
        </div>
</body>

</html>