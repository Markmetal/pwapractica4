
document.addEventListener('DOMContentLoaded', function() {
    console.log("Sistema de Calificaciones iniciado y JavaScript cargado.");

    const loginForm = document.querySelector('.login-container form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {

            const email = loginForm.querySelector('input[name="email"]').value.trim();
            const contrasena = loginForm.querySelector('input[name="contrasena"]').value.trim();

            if (email === "" || contrasena === "") {
                alert("Por favor, complete todos los campos de acceso.");
                event.preventDefault();
                return;
            }

            if (!isValidEmail(email)) {
                alert("Por favor, ingrese un formato de email válido.");
                event.preventDefault();
                return;
            }

            console.log("Formulario de acceso validado por JS. Enviando a PHP...");
        });
    }

    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            if (!confirm("¿Está seguro de que desea eliminar este registro? Esta acción es irreversible.")) {
                event.preventDefault();
            }
        });
    });

    function isValidEmail(email) {

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    const notasTable = document.querySelector('.table-notas');
    if (notasTable) {

        notasTable.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseover', function() {
                this.style.backgroundColor = '#eef';
            });
            row.addEventListener('mouseout', function() {
                this.style.backgroundColor = '';
            });
        });
    }
});