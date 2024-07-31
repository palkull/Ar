<?php
session_start();

if (!isset($_SESSION['id'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../Controladores/Login/login.php"); // Cambia "login.php" por tu página de inicio de sesión
    exit;
}

$_SESSION['email'];
$_SESSION['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="../../App/css/forms.css">
    
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
    <form action="../Controladores/Productos/categoria.php" method="POST" enctype="multipart/form-data" class="form">
    <p id="heading">Agregar Categoría</p>
    <div class="field">
    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
            <path d="M3 3.5a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3zm0 4a.5.5 0 0 0 0 1h10a.5.5 0 0 0 0-1H3z"/>
        </svg>
        <input type="text" name="categoria" id="" placeholder="Categoria" maxlength="255" class="input-field">
        </div>
        <div class="btn">
        <button type="submit" class="styled-button">
        <span class="button-text">Subir</span>
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
      <a href="./productos.php" aria-label="GitHub" data-social="github">
        <div class="filled"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64l0 48-128 0 0-48zm-48 48l-64 0c-26.5 0-48 21.5-48 48L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-208c0-26.5-21.5-48-48-48l-64 0 0-48C336 50.1 285.9 0 224 0S112 50.1 112 112l0 48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"fill="currentColor"/></svg>
      </a>
      <div class="tooltip">Productos</div>
    </li>
  </ul>
</div>
    </form>
</body>

</html>