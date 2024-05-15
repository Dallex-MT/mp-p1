document.addEventListener("DOMContentLoaded", function () {
    function redirectToWhatsapp() {
        window.open('https://wa.me/593961779839', '_blank');
    }
    document.getElementById('telefono').addEventListener('mouseover', function() {
        document.body.style.cursor = 'pointer';
    });

    document.getElementById('telefono').addEventListener('mouseout', function() {
        document.body.style.cursor = 'default';
    });

    function validarFormulario() {
        let usuario = document.getElementById("usuarioI").value;
        let email = document.getElementById("emailI").value;
        let mensaje = document.getElementById("mensajeI").value;

        if (usuario.length < 3 || email.indexOf("@") === -1 || mensaje.length < 5) {
            alert("Por favor, completa el formulario correctamente.");
            return false;
        }
        return true;
    }

    document.getElementById("contactForm").addEventListener("submit", function (event) {
        if (!validarFormulario()) event.preventDefault();
    });
});