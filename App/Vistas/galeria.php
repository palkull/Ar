<?php
session_start();
$isAdmin = isset($_SESSION['email']);

include "../Controladores/Config/config.php";

$sql = "SELECT image_path FROM productimages";
$stmt = $conexion->query($sql);

// Verificar si se encontraron imágenes
$images = [];
if ($stmt->rowCount() > 0) {
    // Guardar todas las rutas de las imágenes en un array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $images[] = $row['image_path'];
    }

    // Mezclar el array de imágenes para que estén en orden aleatorio
    shuffle($images);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/galeria.css">
    <title>Galería</title>
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
</header>
<body>

    <h1 class="titulo">Galería completa</h1>
    <div class="gallery">
        <?php
        if (!empty($images)) {
            foreach ($images as $image_url) {
                echo "<img src='../Controladores/Productos/$image_url' alt='Imagen' style='width:200px;height:auto;margin:10px;' onclick='openModal(this)' />";
            }
        } else {
            echo "No se encontraron imágenes.";
        }
        ?>
    </div>
    <div class="copy">
    <p>&copy; 2024 AR | Artesanía en Piel. Todos los derechos reservados.</p>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content-container">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="img01">
        </div>
    </div>


    <script>
        function openModal(element) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");

            modal.style.display = "flex";
            modalImg.src = element.src;
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        window.onload = function() {
        const imagenes = document.querySelectorAll('.gallery img');
        imagenes.forEach((img, index) => {
            setTimeout(() => {
                img.classList.add('visible');
            }, 200 * index); // Retraso de 200ms por imagen para el efecto de aparición en cascada
        });
    }
    </script>
</body>

</html>
