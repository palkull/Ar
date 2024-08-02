<?php
session_start();
$isAdmin = isset($_SESSION['email']);
include '../Controladores/Config/config.php';

$searchTerm = isset($_GET['search']) ? trim(strtolower($_GET['search'])) : '';

try {
    $conexion->beginTransaction();

    if (!empty($searchTerm) && strlen($searchTerm) > 2) {
        $consulta = "SELECT p.nombre AS nombre, p.Descripcion AS Descripcion, p.color AS color, p.product_id AS product_id, GROUP_CONCAT(i.image_path) AS image_paths 
                    FROM products p 
                    JOIN productimages i ON p.product_id = i.product_id 
                    WHERE (p.nombre LIKE :busqueda OR p.Descripcion LIKE :busqueda) AND p.Estado = 1 
                    GROUP BY p.product_id";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindValue(":busqueda", '%' . $searchTerm . '%', PDO::PARAM_STR);
    } else {
        $consulta = "SELECT p.nombre AS nombre, p.Descripcion AS Descripcion, p.color AS color, p.product_id AS product_id, GROUP_CONCAT(i.image_path) AS image_paths 
                    FROM products p 
                    JOIN productimages i ON p.product_id = i.product_id 
                    WHERE p.Estado = 1 
                    GROUP BY p.product_id";
        $stmt = $conexion->prepare($consulta);
    }
    $stmt->execute();
    $conexion->commit();
} catch (PDOException $e) {
    $conexion->rollBack();
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los artículos</title>
    <link rel="stylesheet" href="../css/busqueda.css">
    <link rel="icon" type="image/x-icon" href="../img/logoAr.ico">
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

<div class="busqueda">
    <form action="" method="GET" class="search">
        <input type="text" name="search" class="search__input" placeholder="Buscar...">
        <button type="submit" name="enviar" class="search__button">
            <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
        </button>
    </form>
</div>

<div class="contenido">
    <div class="productos">
        <?php
        $product_id_anterior = null;
        if ($stmt && $stmt->rowCount() > 0) {
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
            echo "<p>No se encontraron productos que coincidan con la búsqueda.</p>";
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
            }, 200 * index); 
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
