<?php
include ("./App/Controladores/Config/config.php");

session_start();
$isAdmin = isset($_SESSION['email']);

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
    <link rel="icon" type="image/x-icon" href="/Ar/App/img/logoAr.ico">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        function toggleNav() {
            const navMenu = document.getElementById("navMenu");
            navMenu.classList.toggle("show");
        }

        function toggleButtons() {
            const originalButton = document.getElementById("originalButton");
            const originalButton2 = document.getElementById("originalButton2");
            const buttons = document.querySelectorAll(".button1, .button2");

            originalButton.style.display = "none";
            originalButton2.style.display = "block";

            buttons.forEach(button => {
                button.style.display = "block";
            });
        }

        function regreso() {
            const originalButton = document.getElementById("originalButton");
            const originalButton2 = document.getElementById("originalButton2");
            const buttons = document.querySelectorAll(".button1, .button2");

            originalButton.style.display = "block";
            originalButton2.style.display = "none";

            buttons.forEach(button => {
                button.style.display = "none";
            });
        }
    </script>
</head>
<body>
    <div class="fondo">
        <header>
            <h1 class="titulo">AR | ARTESANÍA EN PIEL</h1>
            <nav>
        <button class="menu-toggle" aria-label="Open menu">&#9776;</button>
        <ul id="navMenu">
                    <li><a href="./App/Vistas/catalogo.php">Catálogo</a></li>
                    <li><a href="./App/Vistas/galeria.php">Galería</a></li>
                    <li> <a href="https://wa.me/+5216181664872?text=Hola,%20me%20gustaría%20adquirir%20un%20producto,%20podrías%20darme%20más%20información?">Consulta</a></li>
                </ul>
            </nav>
    
        </header>

        <div class="inicio">
            <div>
            <h1>Diseñados para toda la vida</h1>
            <h3>Artesanía elaborada a mano, 100% piel.</h3>
            </div>
            <div class="boton">
            <a href="https://wa.me/+5216181664872?text=Hola,%20me%20gustaría%20adquirir%20un%20producto,%20podrías%20darme%20más%20información?">Reservar una consulta</a>
            </div>
        </div>
    </div>

    <div class="somos">
        <div class="somos1">
            <h1>Quiénes Somos...</h1>
        </div>

        <div class="somos2">
            <p>
                AR Artesanía es una micro empresa en línea fundada por la Arquitecta Cecilia Hidalgo Rosales en el año 2008.
                La empresa comenzó como hobbie elaborando bolsas de piel en el estado de Durango y las enviaba a la ciudad
                de México para su venta. <br><br>Con el paso de los años sus productos comenzaron a tener más demanda por medio de
                recomendaciones y se comenzaron a hacer envíos a diferentes partes de la república, hasta que en febrero de
                2018, lo que llego a ser su pasatiempo se convirtió en una gran oportunidad de negocio y se dedicó al 100% a
                la elaboración de artículos de piel.
            </p>
        </div>
    </div>

    <img class="imagen2" src="./App/img/img2.png" alt="">

    <div class="testimonios">
        <div class="testimonios1">
            <h1>Testimonios</h1>
        </div>

        <div class="testimonios2">
            <?php if ($isAdmin): ?>
                <div class="admin">
                    <button id="originalButton" onclick="toggleButtons()">ON</button>
                    <button id="originalButton2" style="display: none;" onclick="regreso()">OFF</button>
                </div>
            <?php endif; ?>
            
            <?php foreach ($resultado as $fila): ?>
                <div class="testimonios3">
                    <h2>"<?php echo $fila['comentarios']; ?>"</h2>
                    <div class="usuaria">
                        <h3>— @<?php echo $fila['reduser']; ?></h3>
                        <img <?php if ($fila['red_social'] == 1) { ?> src="./App/img/facebook.png" <?php } else { ?> src="./App/img/Instagram.png" <?php } ?> alt="Red social">
                    </div>
                </div>
                <div class="Botones_admin">
                    <?php if ($isAdmin): ?>
                        <form action="./App/Controladores/Comentarios/Resenas.php" method="POST">
                            <button class="button1" type="submit" value="<?php echo $fila['comment_id']; ?>" style="display: none;" name="comentario">Eliminar</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <img class="imagen3" src="./App/img/img3.png" alt="">

    <div class="consulta">
        <div class="consulta2">
        <h1>Reservar una consulta</h1>
        <h3>Prepararemos una propuesta y le presentaremos todos los pasos del proceso.</h3>
        </div>
        <div class="boton">
        <a href="https://wa.me/+5216181664872?text=Hola,%20me%20gustaría%20adquirir%20un%20producto,%20podrías%20darme%20más%20información?">Reservar una consulta</a>
        </div>
    </div>

    <div class="footer">
        <h1>AR – Arte en Piel</h1>
        <h3>hola.ar@gmail.com</h3>
        <h3>(555) 555-5555</h3>
        
        <div class="redes">
            <ul class="social-icons">
                <li><a href="https://www.facebook.com/arartesaniaenpielDgo" target="_blank"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/ar_artesaniaenpiel/" target="_blank"><i class="fab fa-instagram"></i></a></li>
            </ul>
            <div class="botonesA">
                <?php if (!$isAdmin): ?>
                    <ul><a href="#" id="loginBtn" class="loginBtnC">Iniciar Sesión</a></ul>
                <?php else: ?>
                    <ul><a class="adminB" href="./App/Vistas/Dash.php">Dashboard</a></ul>
                    <button class="adminB" type="button" onclick="Logout()">Cerrar Sesión</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body"></div>
            <?php if (isset($_GET['error'])): ?>
                <p class="error-message shake-animation">Credenciales incorrectas, por favor intente de nuevo.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./App/js/modal.js"></script>
    <script>
        function Logout() {
            swal("¿Estás seguro?", {
                icon: "warning",
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Cerrar",
                        value: "catch",
                        dangerMode: true,
                    }
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                        fetch(`./App/Controladores/Login/logout.php`)
                            .then(response => {
                                if (response.ok) {
                                    swal("Sesión cerrada",{icon: "success"}).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal("Error!", "No se pudo cerrar sesión", "error");
                                }
                            })
                            .catch(error => {
                                swal("Error!", "Hubo un problema", "error");
                            });
                        break;

                    default:
                        swal("Operación cancelada!",{icon: "error"} );
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('nav ul');

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('show');
    });

    document.addEventListener('click', (event) => {
        if (!navMenu.contains(event.target) && !menuToggle.contains(event.target)) {
            navMenu.classList.remove('show');
        }
    });
});
    </script>
</body>
</html>
