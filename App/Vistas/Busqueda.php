<?php
session_start();
$isAdmin = isset($_SESSION['email']);
include '../Controladores/Config/config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    <link rel="stylesheet" href="../css/busqueda.css">

</head>

<body>
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
                        <path
                            d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z">
                        </path>
                    </svg>
                </label>
            </div>
        <?php else: ?>
            <div class="container">
                <a href="./Catalogos.php?categoria=bolsas">Catalogo</a>
            </div>
        <?php endif; ?>
    </header>
    <div class="a">
        <div class="busqueda">
            <form action="" method="GET">
                <input type="text" name="Busqueda" id="input_buscar"><br>
                <input type="submit" name="enviar" value="Buscar" id="button_buscar">
            </form>
        </div>

    </div>

    <?php
    if (isset($_GET['enviar'])) {
        $busqueda = $_GET['Busqueda'];
        $consulta = "SELECT p.nombre AS nombre, p.Descripcion AS Descripcion, p.color AS color, p.product_id AS product_id, i.image_path AS image_path FROM products p JOIN productimages i ON p.product_id = i.product_id WHERE p.Nombre LIKE :busqueda";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindValue(":busqueda", '%' . $busqueda . '%'); // Añade los signos de porcentaje aquí
        $stmt->execute();
        ?>
        <div class="productos">
            <?php
            $product_id_anterior = null;
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $nombreProducto = $row["nombre"];
                    $urlImagen = $row["image_path"];
                    $Descripcion = $row["Descripcion"];
                    $product_id = $row["product_id"];
                    $color = $row["color"];

                    if ($product_id !== $product_id_anterior) { ?>
                        <div class='producto <?php //echo $clase ?>' data-product-id="<?php echo $product_id; ?>"
                            onclick="openModal(<?php echo $product_id; ?>)">
                            <img src='../Controladores/Productos/<?php echo $urlImagen ?>' alt='Imagen del producto' width="150px"
                                height="150px">
                            <p id="nombre"><?php echo $nombreProducto ?></p>
                            <p id="descripcion"><?php echo $Descripcion ?></p>
                            <?php
                            $product_id_anterior = $product_id;
                            if ($isAdmin): ?>
                                <div class="BotonesEditarYEliminar">
                                    <form action="./Editar.php" method="GET">
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
        <?php
    }
    ?>
    <div class="contenido">
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

                adminButtons.forEach(function (buttonGroup) {
                    if (checkBox.checked) {
                        buttonGroup.style.display = "block";
                    } else {
                        buttonGroup.style.display = "none";
                    }
                });
            }

            // Mantener el estado del modo admin si estaba activado
            window.onload = function () {
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
                modal.style.display = "flow";

                // Aplicar blur al fondo
                document.querySelector(".contenido").classList.add("blur-background");

                // Obtener detalles del producto
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "getProductDetails.php?product_id=" + productId, true);
                xhr.onreadystatechange = function () {
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