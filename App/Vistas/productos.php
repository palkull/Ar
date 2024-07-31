<?php
include ("../Controladores/Config/config.php");

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Controladores/Login/login.php");
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
    <title>Productos</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../App/css/forms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
        <a class="der" href="./catalogo.php">Catálogo</a>

    </header>
    <form action="../Controladores/Productos/Productos.php" method="post" enctype="multipart/form-data" class="form">
    <p id="heading">Agregar Producto</p>
    <div class="field">
        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
            <path d="M5.5 2.5a2.5 2.5 0 0 1 5 0V3h3.5a1 1 0 0 1 1 1v10.5a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1H5.5v-.5zm1 0v.5h3V2.5a1.5 1.5 0 1 0-3 0z"/>
        </svg>
        <input type="text" name="name" placeholder="Nombre del Producto" maxlength="255" class="input-field">
    </div>
    <div class="field">
        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
            <path d="M3 3.5a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3z"/>
        </svg>
        <input type="text" name="Desc" placeholder="Descripción Principal" maxlength="255" class="input-field">
    </div>
    <div class="descripciones">
    <div class="fieldDesc">
        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
            <path d="M3 3.5a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3z"/>
        </svg>
        <input type="text" name="detalle1" placeholder="Detalle 1" maxlength="255" class="input-fieldDesc">
    </div>
    <div class="fieldDesc">
        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
            <path d="M3 3.5a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3z"/>
        </svg>
        <input type="text" name="detalle2" placeholder="Detalle 2" maxlength="255" class="input-fieldDesc">
    </div>
    </div>
    <div class="field">
        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
            <path d="M3 3.5a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3z"/>
        </svg>
        <input type="text" name="dimensiones" placeholder="Dimensiones" maxlength="255" class="input-field">
    </div>
    <div class="field">
        <i class="fas fa-sun input-icon"></i>  <input type="text" name="color" placeholder="Color" maxlength="255" class="input-field">
    </div>
    <select name="categoria" id="categoria" class="input-field">
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>
        <?php } ?>
    </select>
    <input type="file" id="real-file" name="Imagen[]" multiple class="input-field" hidden="hidden">
    <button type="button" id="custom-button">Subir Imagenes</button>
    <span id="custom-text">No hay archivos seleccionados.</span>
    <div class="btn">
  <button type="submit" class="styled-button">
    <span class="button-text">Guardar</span>
    <div class="inner-button">
      <svg
        id="Arrow"
        viewBox="0 0 32 32"
        xmlns="http://www.w3.org/2000/svg"
        height="20px"
        width="20px"
        class="icon"
      >
        <defs>
          <linearGradient y2="100%" x2="100%" y1="0%" x1="0%" id="iconGradient">
            <stop style="stop-color:#FFFFFF;stop-opacity:1" offset="0%"></stop>
            <stop style="stop-color:#AAAAAA;stop-opacity:1" offset="100%"></stop>
          </linearGradient>
        </defs>
        <path
          fill="url(#iconGradient)"
          d="M4 15a1 1 0 0 0 1 1h19.586l-4.292 4.292a1 1 0 0 0 1.414 1.414l6-6a.99.99 0 0 0 .292-.702V15c0-.13-.026-.26-.078-.382a.99.99 0 0 0-.216-.324l-6-6a1 1 0 0 0-1.414 1.414L24.586 14H5a1 1 0 0 0-1 1z"
        ></path>
      </svg>
    </div>
  </button>
</div>
<div class="icon-container">
  <ul class="example-2">
    <li class="icon-content">
      <a href="./Comentarios.php" aria-label="Instagram" data-social="instagram">
        <div class="filled"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9l.3-.5z" fill="currentColor"></path>/></svg>
      </a>
      <div class="tooltip">Reseñas</div>
    </li>
    <li class="icon-content">
      <a href="./categorias.php" aria-label="GitHub" data-social="github">
        <div class="filled"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z" fill="currentColor"></path>/></svg>
      </a>
      <div class="tooltip">Categorías</div>
    </li>
  </ul>
</div>



</form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'success') {
                swal("¡Éxito!", "El producto se subió correctamente.", "success").then(() => {
                    location.reload();
                });
            } else if (status === 'error') {
                swal("Error", "Hubo un problema al subir el producto.", "error");
            }
        });

        const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");
const customTxt = document.getElementById("custom-text");

customBtn.addEventListener("click", function() {
    realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
    if (realFileBtn.files.length > 0) {
        customTxt.innerHTML = realFileBtn.files.length + " archivo(s) seleccionado(s)";
    } else {
        customTxt.innerHTML = "No hay archivos seleccionados.";
    }
});

    </script>
</body>

</html>
