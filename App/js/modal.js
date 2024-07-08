// modal.js

document.addEventListener('DOMContentLoaded', () => {
    // Obtener elementos del DOM
    const modal = document.getElementById("myModal");
    const btn = document.getElementById("loginBtn");
    const span = document.getElementsByClassName("close")[0];
    const modalBody = document.getElementById("modal-body");

    // Función para abrir el modal y cargar el contenido
    function openModal() {
        fetch('./App/Vistas/Login.php')
            .then(response => response.text())
            .then(data => {
                modalBody.innerHTML = data;
                modal.style.display = "block";
            })
            .catch(error => console.error('Error al cargar el contenido:', error));
    }

    // Abrir el modal al hacer clic en "Iniciar Sesión"
    btn.onclick = function() {
        openModal();
    }

    // Cerrar el modal al hacer clic en la "x"
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cerrar el modal al hacer clic fuera del contenido del modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Verificar si hay un parámetro de error en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        openModal();
    }
});

