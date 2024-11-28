<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="novedades.css">
    <title>Novedades</title>

    <?php 
    include('dash.php');
    include('reacciones.php');
    ?>
    
</head>
<body>
<div class="page-content">
    <div class="content-container">
        <!-- Comienzo del contenido Novedades wa-->
        <div class="slider-frame">
            <h4>Noticias y novedades sobre el servicio</h4>
        <ul>
            <li><img src="fotos/img6.jpg" alt=""></li>
            <li><img src="fotos/img2.jpg" alt=""></li>
            <li><img src="fotos/img3.jpg" alt=""></li>
            <li><img src="fotos/img5.jpg" alt=""></li>
        </ul>
    </div>
    <div class="reacciones">
        <div class="cont-iconos" id="cont-iconos">
            <span class="gusta" id="gusta" onclick="gusta();">
                <img src="fotos/bear-thumbs-up.gif" alt="">
                <span id="contador-gusta">0</span>
            </span>
            <span class="encanta" id="encanta" onclick="encanta();">
                <img src="fotos/half-heart-full-heart.gif" alt="">
                <span id="contador-encanta">0</span>
            </span>
            <span class="divierte" id="divierte" onclick="divierte();">
                <img src="fotos/diversion.gif" alt="">
                <span id="contador-divierte">0</span>
            </span>
            <span class="asombra" id="asombra" onclick="asombra();">
                <img src="fotos/bear-blow-a-kiss.gif" alt="">
                <span id="contador-asombra">0</span>
            </span>
        </div>
        <button id="mostrar-btn" onclick="mostrar1()">Mostrar Reacciones</button>
    </div>
    <section id="projects" class="projects">
        <u><h2>Publicaciones</h2></u>
        <div class="projects-year">
            <div class="project-grid">
                <div class="project-card">
                    <img src="fotos/kici.jpg" alt="Noticia - 1">
                    <h3>De Jesus con Kiciloff</h3>
                    <p>El Intendente Juan de Jesus tuvo una reunión importante con el gobernador Axel Kiciloff.</p>
                </div>
                <div class="project-card">
                    <img src="fotos/junta.jpg" alt="Noticia - 2">
                    <h3>Junta Local</h3>
                    <p>El intendente se reunió con su equipo de trabajo para seguir progresando con el pueblo.</p>
                </div>
            </div>
        </div>
        <div class="projects-year">
            <div class="project-grid">
                <div class="project-card">
                    <img src="fotos/diabetes.jpeg" alt="Noticia - 3">
                    <h3>Día Mundial de la Diabetes</h3>
                    <p>El intendente Juan de Jesús compartió un desayuno con integrantes de Diabetes La Costa.</p>
                </div>
                <div class="project-card">
                    <img src="fotos/anteojos.jpeg" alt="Noticia - 4">
                    <h3>Anteojos</h3>
                <p>Se entregaron anteojos de “Ver para Aprender” en Escuelas Primarias de La Costa.</p>
                </div>
            </div>
        </div>
    </section>    




</div>
</div>
</body>
<script> 
function mostrar1() {
    document.getElementById('cont-iconos').classList.toggle("mostrar1");
}

document.addEventListener('DOMContentLoaded', function() {
    cargarContadores();
});

function cargarContadores() {
    const reacciones = ['gusta', 'encanta', 'divierte', 'asombra'];
    
    reacciones.forEach(reaccion => {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `reacciones.php?reaccion=${reaccion}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const contadorElement = document.getElementById('contador-' + reaccion);
                if (contadorElement) {
                    contadorElement.innerText = xhr.responseText;
                }
            } else {
                console.error('Error al cargar el contador de la reacción:', reaccion);
            }
        };
        xhr.send();
    });
}

function actualizarContador(reaccion) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "reacciones.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            const contadorElement = document.getElementById('contador-' + reaccion);
            if (contadorElement) {
                contadorElement.innerText = xhr.responseText;
            }
        } else {
            console.error('Error al actualizar el contador de la reacción:', reaccion);
        }
    };
    xhr.send("reaccion=" + encodeURIComponent(reaccion));
}

function cambiarTitulo(titulo, color) {
    const tituloElem = document.getElementById('titulo');
    if (tituloElem) {
        tituloElem.style.opacity = 0;
        setTimeout(() => {
            tituloElem.innerHTML = titulo;
            tituloElem.style.color = color;
            tituloElem.style.opacity = 1;
        }, 300);
    }
}

function gusta() {
    cambiarTitulo('Me Gusta', 'blue');
    actualizarContador('gusta');
}

function encanta() {
    cambiarTitulo('Me Encanta', 'red');
    actualizarContador('encanta');
}

function divierte() {
    cambiarTitulo('Me Divierte', 'yellow');
    actualizarContador('divierte');
}

function asombra() {
    cambiarTitulo('Me Asombra', 'yellow');
    actualizarContador('asombra');
}    
</script>
</html>