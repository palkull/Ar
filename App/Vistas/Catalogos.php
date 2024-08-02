<?php
session_start();
$isAdmin = isset($_SESSION['email']);

include ("../Controladores/Config/config.php");

$categoria = isset($_GET["categoria"]) ? trim(strtolower($_GET["categoria"])) : '';

try {
    $conexion->beginTransaction();

    $consulta1 = "SELECT category_id FROM categories WHERE category = :categoria";
    $stmt = $conexion->prepare($consulta1);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $id = $row["category_id"];
    } else {
        echo "Categoría no encontrada.";
        exit;
    }

    $consulta2 = "SELECT p.nombre AS nombre, p.Descripcion AS Descripcion, p.color AS color, p.product_id AS product_id, GROUP_CONCAT(i.image_path) AS image_paths FROM products p JOIN productimages i ON p.product_id = i.product_id WHERE p.category_id = :categoria AND p.Estado = 1 GROUP BY p.product_id";
    $stmt = $conexion->prepare($consulta2);
    $stmt->bindParam(":categoria", $id);
    $stmt->execute();

} catch (PDOException $e) {
    $conexion->rollBack();
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/productos.css">
    <link rel="icon" type="image/x-icon" href="../img/logoAr.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>AR | <?php echo isset($categoria) ? ucfirst($categoria) : 'Categoría no especificada'; ?></title>
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
        <?php else: ?>
            <div class="container">
                <a href="./Busqueda.php"><i class="fas fa-search"></i></a>
            </div>
        <?php endif; ?>
    </header>

<body>
    <nav>
        <ul>
            <li><a href="./Catalogos.php?categoria=bolsas" <?php echo ($categoria == 'bolsas') ? 'class="active"' : ''; ?>>Bolsas</a></li>
            <li><a href="./Catalogos.php?categoria=mochilas" <?php echo ($categoria == 'mochilas') ? 'class="active"' : ''; ?>>Mochilas</a></li>
            <li><a href="./Catalogos.php?categoria=bandoleras" <?php echo ($categoria == 'bandoleras') ? 'class="active"' : ''; ?>>Bandoleras</a></li>
            <li><a href="./Catalogos.php?categoria=carteras" <?php echo ($categoria == 'carteras') ? 'class="active"' : ''; ?>>Carteras</a></li>
            <li><a href="./Catalogos.php?categoria=mandiles" <?php echo ($categoria == 'mandiles') ? 'class="active"' : ''; ?>>Mandiles</a></li>
            <li><a href="./Catalogos.php?categoria=escolares" <?php echo ($categoria == 'escolares') ? 'class="active"' : ''; ?>>Escolares</a></li>
            <li><a href="./busqueda.php">Todos</a></li>
        </ul>
    </nav>
    <div class="contenido">
    <?php
    // Definir textos e imágenes por categoría
    $categoriasInfo = [
        'bolsas' => ['titulo' => 'Bolsas', 'texto' => 'Descubre nuestra exclusiva colección de bolsas, diseñadas con la más alta calidad y estilo artesanal.', 'imagen' => '../img/bolsasCover.png'],
        'mochilas' => ['titulo' => 'Mochilas','texto' => 'Encuentra la mochila perfecta para cada ocasión, combinando durabilidad y diseño innovador para satisfacer todas tus necesidades.', 'imagen' => '../img/mochilaCover.png'],
        'bandoleras' => ['titulo' => 'Bandoleras','texto' => 'Bandoleras prácticas y modernas, diseñadas para ofrecer comodidad y estilo en tu día a día.','imagen' => '../img/bandolerasCover.png'],
        'carteras' => ['titulo' => 'Carteras', 'texto' => 'Variedad de estilos, tamaños y tipos de carteras hechos para ti. ', 'imagen' => '../img/carteraCover2.png'],
        'mandiles' => ['titulo' => 'Mandiles', 'texto' => 'Mandiles de alta resistencia y durabilidad, diseñados para brindar máxima protección y comodidad en todas tus actividades.','imagen' => '../img/mandilesCover.png'],
        'escolares' => [ 'titulo' => 'Escolares', 'texto' => 'Artículos escolares de primera calidad, diseñados para satisfacer todas tus necesidades académicas con estilo y funcionalidad.', 'imagen' => '../img/escolaresCover.png'],        
    ];

    // Mostrar texto e imagen de la categoría seleccionada
    if (array_key_exists($categoria, $categoriasInfo)) {
        $info = $categoriasInfo[$categoria];
        echo '<div class="categoria-header">';
        echo '<h1>' . $info['titulo'] . '</h2>';
        echo '<img src="' . $info['imagen'] . '" alt="' . ucfirst($categoria) . '">';
        echo '<h2>' . $info['texto'] . '</h2>';
        echo '</div>';
    } else {
        echo '<p>Categoría no especificada o no encontrada.</p>';
    }
    ?>
        <div class="productos">
            <?php
            $product_id_anterior = null;
            if ($stmt->rowCount() > 0) {
                while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $nombreProducto = $row2["nombre"];
                    $imagenes = explode(',', $row2["image_paths"]);
                    $Descripcion = $row2["Descripcion"];
                    $product_id = $row2["product_id"];
                    $color = $row2["color"];
                    if ($product_id !== $product_id_anterior) { ?>
                        <div class="producto" data-product-id="<?php echo $product_id; ?>" onclick="openModal(<?php echo $product_id; ?>)">
                            <div class="imagenes">
                                <?php foreach ($imagenes as $index => $imagen): ?>
                                    <img src='../Controladores/Productos/<?php echo $imagen; ?>' alt='Imagen del producto' class="imagen <?php echo $index === 0 ? 'first activa' : ''; ?>">
                                <?php endforeach; ?>
                                <button class="details-button" onclick="window.location.href='./getProductDetails.php?product_id=<?php echo $product_id; ?>';">Ver más</button>
                            </div>
                            <div class="info">
                                <p class="nombre"><?php echo $nombreProducto ?></p>
                                <p class="descripcion"><?php echo $Descripcion ?></p>
                            </div>
                            <?php
                            $product_id_anterior = $product_id;
                            if ($isAdmin): ?>
                               <div class="BotonesEditarYEliminar">
                            <button class="button" onclick="Eliminar(<?php echo $product_id; ?>)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 14" class="svgIcon bin-top">
            <g clip-path="url(#clip0_35_24)">
                <path fill="black" d="M20.8232 2.62734L19.9948 4.21304C19.8224 4.54309 19.4808 4.75 19.1085 4.75H4.92857C2.20246 4.75 0 6.87266 0 9.5C0 12.1273 2.20246 14.25 4.92857 14.25H64.0714C66.7975 14.25 69 12.1273 69 9.5C69 6.87266 66.7975 4.75 64.0714 4.75H49.8915C49.5192 4.75 49.1776 4.54309 49.0052 4.21305L48.1768 2.62734C47.3451 1.00938 45.6355 0 43.7719 0H25.2281C23.3645 0 21.6549 1.00938 20.8232 2.62734ZM64.0023 20.0648C64.0397 19.4882 63.5822 19 63.0044 19H5.99556C5.4178 19 4.96025 19.4882 4.99766 20.0648L8.19375 69.3203C8.44018 73.0758 11.6746 76 15.5712 76H53.4288C57.3254 76 60.5598 73.0758 60.8062 69.3203L64.0023 20.0648Z"></path>
            </g>
            <defs>
                <clipPath id="clip0_35_24">
                    <rect fill="white" height="14" width="69"></rect>
                </clipPath>
            </defs>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 57" class="svgIcon bin-bottom">
            <g clip-path="url(#clip0_35_22)">
                <path fill="black" d="M20.8232 -16.3727L19.9948 -14.787C19.8224 -14.4569 19.4808 -14.25 19.1085 -14.25H4.92857C2.20246 -14.25 0 -12.1273 0 -9.5C0 -6.8727 2.20246 -4.75 4.92857 -4.75H64.0714C66.7975 -4.75 69 -6.8727 69 -9.5C69 -12.1273 66.7975 -14.25 64.0714 -14.25H49.8915C49.5192 -14.25 49.1776 -14.4569 49.0052 -14.787L48.1768 -16.3727C47.3451 -17.9906 45.6355 -19 43.7719 -19H25.2281C23.3645 -19 21.6549 -17.9906 20.8232 -16.3727ZM64.0023 1.0648C64.0397 0.4882 63.5822 0 63.0044 0H5.99556C5.4178 0 4.96025 0.4882 4.99766 1.0648L8.19375 50.3203C8.44018 54.0758 11.6746 57 15.5712 57H53.4288C57.3254 57 60.5598 54.0758 60.8062 50.3203L64.0023 1.0648Z"></path>
            </g>
            <defs>
                <clipPath id="clip0_35_22">
                    <rect fill="white" height="57" width="69"></rect>
                </clipPath>
            </defs>
        </svg>
    </button>

    <form action="./Editar.php" method="GET">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <button type="submit" class="editBtn">
            <svg height="1em" viewBox="0 0 512 512">
                <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
            </svg>
        </button>
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
    </div>

    <script>
        function toggleAdminMode() {
            var checkBox = document.getElementById("checkbox");
            var adminButtons = document.querySelectorAll(".BotonesEditarYEliminar");

            adminButtons.forEach(function (buttonGroup) {
                if (checkBox.checked) {
                    buttonGroup.style.display = "inline-flex";
                } else {
                    buttonGroup.style.display = "none";
                }
            });
        }

        window.onload = function () {
            var checkBox = document.getElementById("checkbox");
            if (checkBox && checkBox.checked) {
                toggleAdminMode();
            }

            showProducts();
        }

        function showProducts() {
            const productos = document.querySelectorAll('.producto');
            productos.forEach((producto, index) => {
                setTimeout(() => {
                    producto.classList.add('visible');
                }, 200 * index); // Retraso de 100ms por producto para el efecto de aparición en cascada
            });
        }
        


        function Eliminar(product_id) {
            swal("Estas seguro de eliminar el producto", {
                icon: 'warning',
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Seguir",
                        value: "catch",
                    }
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                        window.location.href = "../Controladores/Productos/Eliminar.php?product_id=" + product_id;
                        break;

                    default:
                        swal("Operacion Cancelada", {
                            icon: 'error'
                        });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const productos = document.querySelectorAll('.producto');
            productos.forEach(producto => {
                producto.addEventListener('mouseenter', () => {
                    const imagenes = producto.querySelectorAll('.imagenes img');
                    if (imagenes.length > 1) {
                        imagenes[0].classList.remove('activa');
                        imagenes[1].classList.add('activa');
                    }
                });

                producto.addEventListener('mouseleave', () => {
                    const imagenes = producto.querySelectorAll('.imagenes img');
                    if (imagenes.length > 1) {
                        imagenes[1].classList.remove('activa');
                        imagenes[0].classList.add('activa');
                    }
                });
            });
        });
    </script>
</body>
</html>
