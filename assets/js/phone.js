document.addEventListener("DOMContentLoaded", function () {
    const inputPhone = document.getElementById('phone');
    inputPhone.addEventListener('keydown', function (event) {
        if (event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Backspace') {
            return;
        }
        if (isNaN(event.key)) {
            event.preventDefault(true);
        }
    });
});