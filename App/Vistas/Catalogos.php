<?php
session_start();
$isAdmin = isset($_SESSION['email']);

include("../Controladores/Config/config.php");

if (isset($_GET["categoria"])) {
    try {
        $conexion->beginTransaction();
        $categoriaa = $_GET["categoria"];
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
        } else {
            echo "No se encontraron resultados.";
        }

        $consulta2 = "SELECT p.nombre AS nombre, p.Descripcion AS Descripcion, p.color AS color, p.product_id AS product_id, i.image_path AS image_path FROM products p JOIN productimages i ON p.product_id = i.product_id WHERE p.category_id = :categoria;";
        $stmt = $conexion->prepare($consulta2);
        $stmt->bindParam(":categoria", $id);
        $stmt->execute();

    } catch (PDOException $e) {
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No se especificó una categoría válida.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/productos.css">
    <title><?php echo isset($categoria) ? ucfirst($categoria) : 'Categoría no especificada'; ?></title>
</head>
<header>
    <a class="izq" href="javascript:void(0);" onclick="history.go(-1);">Volver</a>
    <a href="../../index.php">
        <div class="header2">
            <h1>ar</h1>
            <h2>Artesanía en Piel</h2>
        </div>
    </a>
    <?php if ($isAdmin): ?>
        <div class="container">
            <input type="checkbox" id="checkbox" onclick="toggleAdminMode()" />
            <label for="checkbox" class="switch">
                <span class="icon">
                    <span class="admin-mode">Administrador</span>
                </span>
                <svg class="slider" viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"></path>
                </svg>
            </label>
        </div>
    <?php endif; ?>
</header>
<body>
<div class="contenido">
<nav>
    <ul>
        <li><a href="catalogos.php?categoria=bolsas" <?php echo ($categoria == 'bolsas') ? 'class="active"' : ''; ?>>Bolsas</a></li>
        <li><a href="catalogos.php?categoria=mochilas" <?php echo ($categoria == 'mochilas') ? 'class="active"' : ''; ?>>Mochilas</a></li>
        <li><a href="catalogos.php?categoria=bandoleras" <?php echo ($categoria == 'bandoleras') ? 'class="active"' : ''; ?>>Bandoleras</a></li>
        <li><a href="catalogos.php?categoria=carteras" <?php echo ($categoria == 'carteras') ? 'class="active"' : ''; ?>>Carteras</a></li>
        <li><a href="catalogos.php?categoria=mandiles" <?php echo ($categoria == 'mandiles') ? 'class="active"' : ''; ?>>Mandiles</a></li>
        <li><a href="catalogos.php?categoria=escolares" <?php echo ($categoria == 'escolares') ? 'class="active"' : ''; ?>>Escolares</a></li>
        <li><a href="catalogos.php?categoria=otros" <?php echo ($categoria == 'otros') ? 'class="active"' : ''; ?>>Otro</a></li>
    </ul>
</nav>

<div class="productos">
    <?php
    $product_id_anterior = null;
    if ($stmt->rowCount() > 0) {
        while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nombreProducto = $row2["nombre"];
            $urlImagen = $row2["image_path"];
            $Descripcion = $row2["Descripcion"];
            $product_id = $row2["product_id"];
            $color = $row2["color"];

            if ($product_id !== $product_id_anterior) { ?>
                <div class='producto' data-product-id="<?php echo $product_id; ?>" onclick="openModal(<?php echo $product_id; ?>)">
                    <img src='../Controladores/Productos/uploads/favoritos.jpeg' alt='Imagen del producto' width="150px" height="150px">
                    <p id="nombre"><?php echo $nombreProducto ?></p>
                    <p id="descripcion"><?php echo $Descripcion ?></p>
                    <?php
                    $product_id_anterior = $product_id;
                    if ($isAdmin): ?>
                        <div class="BotonesEditarYEliminar">
                            <form action="../Controladores/Productos/eliminar_producto.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" name="delete" class="delete">Eliminar</button>
                            </form>
                            <form action="../Controladores/Productos/editar_producto.php" method="GET">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit" name="edit" class="edit">Editar</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php }
        }
    } else {
        echo "<p>No se encontraron productos en esta categoría.</p>";
    }
    ?>
</div>

<!-- Modal para mostrar los detalles del producto -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalDetails"></div>
    </div>
</div>

<script>
    function toggleAdminMode() {
        var checkBox = document.getElementById("checkbox");
        var adminButtons = document.querySelectorAll(".BotonesEditarYEliminar");

        adminButtons.forEach(function(buttonGroup) {
            if (checkBox.checked) {
                buttonGroup.style.display = "block";
            } else {
                buttonGroup.style.display = "none";
            }
        });
    }

    // Mantener el estado del modo admin si estaba activado
    window.onload = function() {
        var checkBox = document.getElementById("checkbox");
        if (checkBox.checked) {
            toggleAdminMode();
        }

        showProducts(); // Llamar a showProducts al cargar la página
    }

    function showProducts() {
        const products = document.querySelectorAll('.producto');
        products.forEach((product, index) => {
            setTimeout(() => {
                product.classList.add('show');
            }, index * 150); // 100ms delay between each product
        });
    }

    function openModal(productId) {
        // Mostrar el modal
        var modal = document.getElementById("productModal");
        modal.style.display = "block";

        // Aplicar blur al fondo
        document.querySelector(".contenido").classList.add("blur-background");

        // Obtener detalles del producto
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "getProductDetails.php?product_id=" + productId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("modalDetails").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    function closeModal() {
        var modal = document.getElementById("productModal");
        modal.style.display = "none";
        document.querySelector(".contenido").classList.remove("blur-background");
    }
</script>
</div>
</body>
</html>
