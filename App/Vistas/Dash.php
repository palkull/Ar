<?php
include ("../Controladores/Config/config.php");

session_start();
if (!isset($_SESSION['email'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php"); // Cambia "login.php" por tu página de inicio de sesión
    exit;
}

$sql = "SELECT category_id, category FROM categories";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="./categorias.php">Categorias</a></li>
            <li><a href="./Dash.php">Productos</a></li>
            <li><a href="./Comentarios.php">Reseñas</a></li>
        </ul>
    </nav>
    <center>
        <form action="../Controladores/Productos/Productos.php" method="post" enctype="multipart/form-data">
            <label> Nombre del Producto </label>
            <input type="text" name="name" placeholder="Nombre del Producto"  maxlength="255"><br>
            <label> Descripcion del Producto </label>
            <input type="text" name="Desc" id="" placeholder="Descripcion" size="50"  maxlength="255">
            <br>
            <select name="categoria" id="categoria">

                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row['category_id']; ?>" select><?php echo $row['category']; ?></option>
                <?php } ?>
            </select><br>
            <input type="file" name="Imagen[]" multiple> <br>
            <input type="text" name="color" id="" placeholder="color" size="5"><br>

            <input type="submit" value="Guardar">
            <br>


        </form>
        <a href="../Controladores/Login/logout.php">Log out</a>
    </center>
</body>

</html>