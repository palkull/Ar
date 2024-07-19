<?php
include "../Controladores/Config/config.php";

session_start();
if (!isset($_SESSION['email'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php");
    exit;
}
//Todas las cateegorias
$conexion->beginTransaction();
$product_id = $_GET['product_id'];
$sql = "SELECT category_id, category FROM categories";
$result = $conexion->query($sql);
//Productos
$consulta = "SELECT * FROM products where product_id = :product_id";
$stmt1 = $conexion->prepare($consulta);
$stmt1->bindParam(':product_id', $product_id);
$stmt1->execute();
$row2 = $stmt1->fetch(PDO::FETCH_ASSOC);
// Imagenes
$consulta2 = "SELECT * FROM productimages where product_id = :product_id";
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
</head>

<body>
    <center>
        <form action="../Controladores/Productos/editar.php" method="POST" enctype="multipart/form-data">
            <label> Nombre del Producto: </label>
            <input type="text" name="name" placeholder="Nombre del Producto" maxlength="255"
                value="<?php echo $row2['Nombre'] ?> "><br>
            <label> Descripcion del Producto: </label>
            <input type="text" name="Desc" id="" placeholder="Descripcion" size="50" maxlength="255"
                value="<?php echo $row2['Descripcion'] ?> ">
            <br>
            <select name="categoria" id="categoria">
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row['category_id']; ?>" select><?php echo $row['category']; ?></option>
                <?php } ?>
            </select><br>
            <label>Añadir más imagenes:</label>
            <input type="file" name="Imagen[]" multiple> <br>
            <label>Color:</label>
            <input type="text" name="color" id="" placeholder="color" size="5"
                value="<?php echo $row2['color'] ?> "><br>
            <input type="submit" value="Guardar">
            <br>
            <input type="text" name="id" value="<?php echo $product_id ?>">
        </form>
        <br>
        <h1>Imágenes del producto</h1>
        <form id="imageForm" action="otro_archivo.php" method="GET">
            <?php
            while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) { ?>
                <button type="button" onclick="confirmAndSubmit(<?php echo $row3['image_id'] ?>)">
                    <img src="../Controladores/Productos/<?php echo $row3['image_path'] ?>" width="300vmax" alt="">
                </button>
            <?php } ?>
        </form>


    </center>
    <script>
        function confirmAndSubmit(imageId) {
            if (confirm('¿Estás seguro que deseas continuar?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Aquí se  maneja la respuesta si es necesario
                            alert(xhr.responseText); // Ejemplo: mostrar una alerta con la respuesta del servidor
                            // o redirigir aquí si lo deseas
                            window.location.href = 'Catalogos.php?categoria=bolsas';
                        } else {
                            // Manejar errores si es necesario
                            alert('Hubo un error al procesar la solicitud.');
                        }
                    }
                };
                xhr.open('GET', '../Controladores/Productos/EliminarImg.php?image_id=' + imageId, true); // Cambia 'tufuncion.php' al nombre de tu archivo PHP
                xhr.send();
            } else {
                // Si el usuario da clic en "Cancelar", no hacer nada
                return false;
            }
        }

    </script>



</body>

</html>