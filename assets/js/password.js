document.addEventListener("DOMContentLoaded", function () {
  // Obtener referencias a los campos de contraseña
  const password1 = document.getElementById('password');
  const password2 = document.getElementById('password2');
  const passwordMismatch = document.getElementById('passwordMismatch');

  // Función para verificar si las contraseñas coinciden
  function checkPasswords() {
    if (password1.value !== password2.value) {
      passwordMismatch.style.display = 'block';
    } else {
      passwordMismatch.style.display = 'none';
    }
  }

  // Agregar un event listener para verificar las contraseñas cuando se escriba en password2
  password2.addEventListener('input', checkPasswords);
  password1.addEventListener('input', checkPasswords);

  // Función para actualizar la posición de los elementos
  function actualizarPosicionElementos(doc) {
    // Obtener todos los elementos con la clase .toggle-password
    let elementos = doc.querySelectorAll('.toggle-password');

    // Iterar sobre cada elemento
    elementos.forEach(function (elemento) {
      // Borrar los estilos top y left
      elemento.style.top = '';
      elemento.style.left = '';
      // Obtener la posición actual del elemento
      let posicionActualTop = elemento.offsetTop;
      let posicionActualLeft = elemento.offsetLeft;

      // Mover el elemento
      let nuevaPosicionTop = posicionActualTop + 15; // Ejemplo: mover 15 píxeles hacia abajo
      let nuevaPosicionLeft = posicionActualLeft - 30; // Ejemplo: mover 30 píxeles a la izquierda
      elemento.style.top = nuevaPosicionTop + 'px';
      elemento.style.left = nuevaPosicionLeft + 'px';
    });
  }

  actualizarPosicionElementos(document);

  // Ejecutar la función cuando cambia el tamaño de la ventana
  window.addEventListener('resize', function () {
    actualizarPosicionElementos(document);
  });

});

function togglePasswordVisibility(icon) {
  var passwordInput = icon.previousElementSibling;
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.innerHTML = '<i class="fa fa-eye"></i>';
  } else {
    passwordInput.type = "password";
    icon.innerHTML = '<i class="fa fa-eye-slash"></i>';
  }
}