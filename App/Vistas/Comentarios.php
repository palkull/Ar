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
    <title>Comentarios</title>
    <link rel="stylesheet" href="../../App/css/forms.css">
    <link rel="icon" type="image/x-icon" href="../img/logoAr.ico">
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
        <form action="../Controladores/Comentarios/Subir.php" method="post" enctype="multipart/form-data" class="form">
        <p id="heading">Subir Reseña</p>
        <div class="field">
          <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512" style="margin-right: 8px; width: 15px; height: 15px;">
            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3 0 498.7 13.3 512 29.7 512h388.6c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3h-91.4z"/>
          </svg>
          <input type="text" placeholder="Usuario" name="user" required maxlength="255" class="input-field">
        </div>
            <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512" style="margin-right: 8px; width: 19px; height: 15px;">
            <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c0 0 0 0 0 0s0 0 0 0s0 0 0 0c0 0 0 0 0 0l.3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/>
            </svg>
            <input type="text" name="comentario" placeholder="Comentario" maxlength="255" class="input-field" required>
            </div>
            <select name="red_social" id="categoria"  class="input-field" required>
                <option value="0" selected>Instagram</option>
                <option value="1">Facebook</option>
            </select>
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
      <a href="./productos.php" aria-label="GitHub" data-social="github">
        <div class="filled"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64l0 48-128 0 0-48zm-48 48l-64 0c-26.5 0-48 21.5-48 48L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-208c0-26.5-21.5-48-48-48l-64 0 0-48C336 50.1 285.9 0 224 0S112 50.1 112 112l0 48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"fill="currentColor"/></svg>
      </a>
      <div class="tooltip">Productos</div>
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
</body>

</html>