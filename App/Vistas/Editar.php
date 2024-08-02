<?php
include "../Controladores/Config/config.php";

session_start();
if (!isset($_SESSION['email'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php");
    exit;
}

//Todas las categorías
$conexion->beginTransaction();
$product_id = $_GET['product_id'];
$sql = "SELECT category_id, category FROM categories";
$result = $conexion->query($sql);

//Productos
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
    <title>Editar</title>
    <link rel="icon" type="image/x-icon" href="../img/logoAr.ico">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <center>
        <form action="../Controladores/Productos/editar.php" method="POST" enctype="multipart/form-data">
            <label>Nombre del Producto: </label>
            <input type="text" name="name" placeholder="Nombre del Producto" maxlength="255" value="<?php echo $row2['Nombre'] ?>"><br>
            <label>Descripción del Producto: </label>
            <input type="text" name="Desc" placeholder="Descripción" size="50" maxlength="255" value="<?php echo $row2['Descripcion'] ?>"><br>
            <label>Detalle 1: </label>
            <input type="text" name="detalle1" placeholder="Detalle 1" size="50" maxlength="255" value="<?php echo $row2['detalle1'] ?>"><br>
            <label>Detalle 2: </label>
            <input type="text" name="detalle2" placeholder="Detalle 2" size="50" maxlength="255" value="<?php echo $row2['detalle2'] ?>"><br>
            <select name="categoria" id="categoria">
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $row2['category_id']) echo 'selected'; ?>><?php echo $row['category']; ?></option>
                <?php } ?>
            </select><br>
            <label>Añadir más imágenes:</label>
            <input type="file" name="Imagen[]" multiple><br>
            <label>Color:</label>
            <input type="text" name="color" placeholder="Color" size="5" value="<?php echo $row2['color'] ?>"><br>
            <input type="submit" value="Guardar"><br>
            <input type="hidden" name="id" value="<?php echo $product_id ?>">
        </form>
        <br>

        <h2>¿Deseas eliminar el producto?</h2>
        <form action="../Controladores/Productos/Eliminar.php" method="GET">
            <button type="button" name="delete" class="delete" onclick="Eliminar(<?php echo $product_id ?>)">Eliminar</button>
        </form>
        <br>

        <h1>Imágenes del producto</h1>
        <form id="imageForm" method="GET">
            <?php while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) { ?>
                <button type="button" onclick="Eliminar_img(<?php echo $row3['image_id'] ?>)">
                    <img src="../Controladores/Productos/<?php echo $row3['image_path'] ?>" width="300vmax" alt="">
                </button>
            <?php } ?>
        </form>
    </center>
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
    </script>
</body>
</html>
