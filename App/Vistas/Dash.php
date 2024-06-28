<?php
include("../Controladores/Config/config.php");

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
    <center>
    <form action="" method="post" enctype="multipart/form-data">
        <label> Nombre del Producto </label>
        <input type="text" name="name"><br>
        <label> Descripcion del Producto </label>
        <input type="text" name="Desc" id="" placeholder="Descripcion" size="50">
        <br>
        <input type="file" name="Imagen"><br>
        <input type="submit" value="Guardar">
        <select name="categoria" id="categoria">
            <option value="">Selecciona una categoría</option>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>
            <?php } ?>
        </select>
        <br>
        <a href="../Controladores/Login/logout.php">Log out</a>
        
    </form>
    </center>
</body>
</html>