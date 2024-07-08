<?php
include ("./App/Controladores/Config/config.php");

$consulta = "SELECT * FROM comments";
$stmt_id = $conexion->prepare($consulta);
$stmt_id->execute();
$resultado = $stmt_id->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR | ARTESANÍA EN PIEL</title>
    <link rel="stylesheet" href="./App/css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="fondo">
        <header>
            <h1 class="titulo">AR | ARTESANÍA EN PIEL</h1>
            <nav>
                <ul><a href="./App/Vistas/acercaDe.php">Acerca de</a></ul>
                <ul><a href="./App/Vistas/catalogo.php">Catálogo</a></ul>
                <ul><a href="./App/Vistas/galeria.php">Galeria</a></ul>
                <ul><a href="./App/Vistas/consulta.php">Consulta</a></ul>
                <ul><a href="#" id="loginBtn">Iniciar Sesión</a></ul>
            </nav>
        </header>

        <div class="inicio">
            <h1>Diseñados para toda la vida</h1>
            <h3>Artesanía elaborada a mano, 100% piel.</h3>

            <div class="boton">
                <a href="">Reservar una consulta</a>
            </div>
        </div>
    </div>

    <div class="somos">
        <div class="somos1">
            <h1>Quiénes Somos...</h1>
        </div>

        <div class="somos2">
            AR Artesanía es una micro empresa en línea fundada por la Arquitecta Cecilia Hidalgo Rosales en el año 2008.
            La empresa comenzó como hobbie elaborando bolsas de piel en el estado de Durango y las enviaba a la ciudad
            de México para su venta. Con el paso de los años sus productos comenzaron a tener más demanda por medio de
            recomendaciones y se comenzaron a hacer envíos a diferentes partes de la república, hasta que en febrero de
            2018, lo que llego a ser su pasatiempo se convirtió en una gran oportunidad de negocio y se dedicó al 100% a
            la elaboración de artículos de piel.
        </div>
    </div>

    <img class="imagen2" src="./App/img/img2.png" alt="">

    <div class="testimonios">
        <div class="testimonios1">
            <h1>Testimonios</h1>
        </div>

        <div class="testimonios2">
            <?php
            foreach ($resultado as $fila) {
                ?>
                <div class="testimonios3">
                    <h2><?php echo $fila['comentarios'] ?> </h2>
                    <h3>— @<?php echo $fila['reduser'] ?> </h3>
                    <img <?php if ($fila['red_social'] == 1) { ?> src="./App/img/facebook.png" <?php } else { ?>
                            src="./App/img/Instagram.png" <?php } ?> alt="Tacos de asada">
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <img class="imagen3" src="./App/img/img3.png" alt="">

    <div class="consulta">
        <h1>Reservar una consulta</h1>
        <h3>Prepararemos una propuesta y le presentaremos todos los pasos del proceso.</h3>

        <div class="boton">
            <a href="">Reservar una consulta</a>
        </div>
    </div>

    <div class="footer">
        <h1>AR – Arte en Piel</h1>
        <h3>hola.ar@gmail.com</h3>
        <h3>(555) 555-5555</h3>

        <div class="redes">
            <ul class="social-icons">
                <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body"></div>
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error-message shake-animation'>Credenciales incorrectas, por favor intente de nuevo.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./App/js/modal.js"></script>
</body>

</html>