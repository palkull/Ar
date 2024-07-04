<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel de Elementos</title>
    <link rel="stylesheet" href="../css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<header>
    <div class="header1">
        <li><a href="#"><i class="fas fa-search"></i></a></li> 
        <a href="../../index.html">
            <div class="header2">
                <h1>ar</h1>
                <h2>Artesaníaen Piel</h2>
            </div>
        </a>
        <li><a href="#"><i class="fas fa-shopping-bag"></i></a></li>
    </div>
    <ul>
        <li><a href="#Bolsas">Bolsas</a></li>
        <li><a href="#Mochilas">Mochilas</a></li>
        <li><a href="#Bandoleras">Bandoleras</a></li>
        <li><a href="#Carteras">Carteras</a></li>
        <li><a href="#Mandiles">Mandiles</a></li>
        <li><a href="#Escolares">Escolares</a></li>
        <li><a href="#Otro">Otro</a></li>
    </ul>
</header>

<!-- Carruseldemierda -->
<section id="container-slider">	
    <a href="javascript: fntExecuteSlide('prev');" class="arrowPrev"><i class="fas fa-chevron-circle-left"></i></a>
    <a href="javascript: fntExecuteSlide('next');" class="arrowNext"><i class="fas fa-chevron-circle-right"></i></a>
    <ul class="listslider">
      <li><a itlist="itList_0" href="#" class="item-select-slid"></a></li>
      <li><a itlist="itList_1" href="#"></a></li>
      <li><a itlist="itList_2" href="#"></a></li>
    </ul>
    <ul id="slider">
      <li style="background-image: url('../img/slider1.jpeg'); z-index:0; opacity: 1;">
        <div class="content_slider" >
          <div>
            <h2>Personal</h2>
            <p>Descubre lo mejor para tu productividad diseñado a medida, con soluciones que se adaptan a tus necesidades.</p>
        <a href="#" class="btnSlider">Ver más</a>
      </div>
        </div>
      </li>
      <li style="background-image: url('../img/slider2.jpeg'); ">
        <div class="content_slider" >
          <div>
            <h2>Herramientas</h2>
            <p>Optimiza tu trabajo con las herramientas adecuadas, diseñadas para facilitar cada tarea y mejorar la eficiencia en tu día a día.</p>
        <a href="#" class="btnSlider">Ver más</a>
      </div>
        </div>
      </li>
      <li style="background-image: url('../img/slider3.jpeg'); ">
        <div class="content_slider" >
          <div>
            <h2>Contáctanos</h2>
            <p>Estamos aquí para entender y adaptarnos a tus necesidades y gustos. Ponte en contacto con nosotros para descubrir cómo podemos ayudarte.</p>
        <a href="#" class="btnSlider">WhatsApp</a>
      </div>
        </div>
      </li>
   </ul>
 </section>

<div class="titulo">
<h1 class="titulo1">Cosido y Cortado a Mano Envíos a Todo México </h1>
</div>

<form action="./Catalogos.php" method="POST" class="categorias">
    <button name="categoria" value="bolsa" type="submit" id="Bolsas" class="categoria categoria1">
        <p>BOLSAS</p>
        <h3></h3>
    </button>
    <button name="categoria" value="mochila" type="submit" id="Mochilas" class="categoria categoria2">
        <p>MOCHILAS</p>
        <h3>Prendas para el y ella</h3>
    </button>
    <button name="categoria" value="bandoleras" type="submit" id="Bandoleras" class="categoria categoria3">
        <p>BANDOLERAS</p>
        <h3>Variedad de Accesorios</h3>
    </button>
    <button name="categoria" value="carteras" type="submit" id="Carteras" class="categoria categoria4">
        <p>CARTERAS</p>
        <h3>Indispensables</h3>
    </button>
    <button name="categoria" value="mandiles" type="submit" id="Mandiles" class="categoria categoria5">
        <p>MANDILES</p>
        <h3>Indispensables</h3>
    </button>
    <button name="categoria" value="escolares" type="submit" id="Escolares" class="categoria categoria6">
        <p>ESCOLARES</p>
        <h3>Indispensables</h3>
    </button>
    <button name="categoria" value="otro" type="submit" id="Otro" class="categoria categoria7">
        <p>OTRO</p>
        <h3>Indispensables</h3>
    </button>
</div>

<footer>
    <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti fuga deserunt ut eum labore laudantium quaerat voluptatibus cum non aperiam sunt recusandae excepturi, iusto corporis veritatis cumque molestiae perspiciatis expedita?</div>

    <div>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit facere adipisci quidem minus officia, consectetur corrupti sed aperiam perspiciatis repellat fugiat placeat perferendis autem tempora error doloremque aut maxime doloribus!</div>

    <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi alias tenetur magni iure eum culpa aspernatur accusantium ad, deserunt a consequuntur tempore qui voluptates magnam temporibus asperiores pariatur! Saepe, maxime.</div>
</footer>

<div class="copy">
    <p>&copy; 2024 AR | Artesanía en Piel. Todos los derechos reservados.</p>
</div>

<script src="../js/catalogo.js"></script>
</body>
</html>
