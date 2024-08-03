<?php
include "../Controladores/Config/config.php";

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Controladores/Login/login.php");
    exit;
}

// Todas las categorías
$conexion->beginTransaction();
$product_id = $_GET['product_id'];
$sql = "SELECT category_id, category FROM categories";
$result = $conexion->query($sql);

// Productos
$consulta = "SELECT * FROM products WHERE product_id = :product_id";
$stmt1 = $conexion->prepare($consulta);
$stmt1->bindParam(':product_id', $product_id);
$stmt1->execute();
$row2 = $stmt1->fetch(PDO::FETCH_ASSOC);

// Imágenes
$consulta2 = "SELECT * FROM productimages WHERE product_id = :product_id";
$stmt3 = $conexion->prepare($consulta2);
$stmt3->bindParam(':product_id', $product_id);
$stmt3->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="icon" type="image/x-icon" href="../img/logoAr.ico">
    <link rel="stylesheet" href="../css/editor.css"> <!-- Añade el CSS de la primera página -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
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
            
    </header>
    <div class="product-details">
    <form class="imagenesForm" id="imageForm" method="GET">
    <?php while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) { ?>
        <button type="button" onclick="Eliminar_img(<?php echo $row3['image_id'] ?>)">
            <img src="../Controladores/Productos/<?php echo $row3['image_path'] ?>" width="300vmax" alt="">
            <div class="overlay">
                <svg viewBox="0 0 16 16" class="bi bi-trash3-fill" fill="currentColor" height="30" width="30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"></path>
                </svg>
            </div>
        </button>
    <?php } ?>
</form>
        <div class="product-info">
            <form action="../Controladores/Productos/editar.php" method="POST" enctype="multipart/form-data">
                <div class="input-container">
                    <input type="text" id="name" name="name" required="" value="<?php echo $row2['Nombre'] ?>">
                    <label for="name" class="label">Nombre del Producto</label>
                    <div class="underline"></div>
                </div>
                <div class="input-container">
                    <input type="text" id="Desc" name="Desc" required="" value="<?php echo $row2['Descripcion'] ?>">
                    <label for="Desc" class="label">Descripción del Producto</label>
                    <div class="underline"></div>
                </div>
                <div class="input-container">
                    <input type="text" id="detalle1" name="detalle1" required="" value="<?php echo $row2['detalle1'] ?>">
                    <label for="detalle1" class="label">Detalle 1</label>
                    <div class="underline"></div>
                </div>
                <div class="input-container">
                    <input type="text" id="detalle2" name="detalle2" required="" value="<?php echo $row2['detalle2'] ?>">
                    <label for="detalle2" class="label">Detalle 2</label>
                    <div class="underline"></div>
                </div>
                <div class="input-container">
                    <input type="text" id="color" name="color" required="" value="<?php echo $row2['color'] ?>">
                    <label for="color" class="label">Color</label>
                    <div class="underline"></div>
                </div>
                <div class="input-container selector">
                    <select name="categoria" id="categoria">
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $row2['category_id']) echo 'selected'; ?>><?php echo $row['category']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-container añadirImagenes">
                    <input type="file" id="Imagen" name="Imagen[]" multiple class="custom-file-input">
                    <label for="Imagen" class="custom-file-label">Añadir imágenes</label>
                    <div class="underline"></div>
                    <span id="file-count" class="file-count"></span>
                    <input type="submit" value="Guardar" class="custom-file-label">
                    <input type="hidden" name="id" value="<?php echo $product_id ?>">
                </div>

            </form>

<form action="../Controladores/Productos/Eliminar.php" method="GET" class="delete-form">
    <button type="button" name="delete" class="Btn" onclick="Eliminar(<?php echo $product_id ?>)">
        <div class="sign">
            <svg
                viewBox="0 0 16 16"
                class="bi bi-trash3-fill"
                fill="currentColor"
                height="18"
                width="18"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"
                ></path>
            </svg>
        </div>
        <div class="text">Eliminar Producto</div>
    </button>
</form>

        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'success') {
                swal("¡Éxito!", "El producto se editó correctamente.", "success");
            } else if (status === 'error') {
                swal("Error", "Hubo un problema al editar el producto.", "error");
            }
        });

        function Eliminar_img(imageId) {
            swal("¿Estás seguro de eliminar la imagen?", {
                icon: 'warning',
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Eliminar",
                        value: "catch",
                    }
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                        fetch(`../Controladores/Productos/EliminarImg.php?image_id=${imageId}`, {
                            method: 'GET'
                        })
                        .then(response => {
                            if (response.ok) {
                                swal("Eliminado!", "La imagen ha sido eliminada.", "success")
                                .then(() => {
                                    location.reload(); // Recarga la página después de mostrar el mensaje de éxito
                                });
                            } else {
                                swal("Error!", "No se pudo eliminar la imagen.", "error");
                            }
                        })
                        .catch(error => {
                            swal("Error!", "Hubo un problema al eliminar la imagen.", "error");
                        });
                        break;
                    default:
                        swal("Operación cancelada!", { icon: 'error' });
                }
            });
        }

        function Eliminar(product_id) {
            swal("¿Estás seguro de eliminar el producto?", {
                icon: 'warning',
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Eliminar",
                        value: "catch",
                    }
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                        fetch(`../Controladores/Productos/Eliminar.php?product_id=${product_id}`, {
                            method: 'GET'
                        })
                        .then(response => {
                            if (response.ok) {
                                swal("Eliminado!", "El producto ha sido eliminado.", "success")
                                .then(() => {
                                    location.href = "./Busqueda.php"; // Redirige después de mostrar el mensaje de éxito
                                });
                            } else {
                                swal("Error!", "No se pudo eliminar el producto.", "error");
                            }
                        })
                        .catch(error => {
                            swal("Error!", "Hubo un problema al eliminar el producto.", "error");
                        });
                        break;
                    default:
                        swal("Operación cancelada!", { icon: 'error' });
                }
            });
        }
        const fileInput = document.getElementById('Imagen');
    const fileCount = document.getElementById('file-count');

    fileInput.addEventListener('change', function() {
        const count = fileInput.files.length;
        fileCount.textContent = count === 0 ? '' : `${count} archivo(s) seleccionado(s)`;
    });
    </script>
</body>
</html>
