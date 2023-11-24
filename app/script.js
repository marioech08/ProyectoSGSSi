
document.getElementById('registerForm').addEventListener('submit', function(e) {
    let dni = document.getElementById('dni').value;

    if (!validateDNI(dni)) {
        alert('DNI no válido');
        e.preventDefault();
    }
});

function validateDNI(dni) {
    const letters = "TRWAGMYFPDXBNJZSQVHLCKE";
    const dniPattern = /^\d{8}[A-Za-z]$/; // Ahora sin el guion

    if (dniPattern.test(dni)) {
        let number = parseInt(dni.substr(0, 8), 10); // Convertir la cadena a un número
        let letter = dni.charAt(8).toUpperCase();
        if (letter === letters.charAt(number % 23)) {
            return true;
        }
    }
    return false;
}

function esPasswordSegura(password) {
    return password.length >= 8 &&
           /[A-Z]/.test(password) && // Al menos una letra mayúscula
           /[a-z]/.test(password) && // Al menos una letra minúscula
           /[0-9]/.test(password) && // Al menos un número
           /[\W]/.test(password);    // Al menos un carácter especial
}

function esPasswordComun(password) {
    $comunPasswords = file('WorstPasswordList.txt', FILE_IGNORE_NEW_LINES);
    return in_array($password, $comunPasswords);
}



let editButtons = document.querySelectorAll('.edit-asignatura');
let modal = document.getElementById('editModal');
let closeBtn = document.querySelector('.close-modal');

editButtons.forEach(function(button) {
    button.addEventListener('click', function(e) {
        let asignaturaId = e.target.getAttribute('data-id');
        // Aquí puedes agregar el código para cargar los datos actuales de la asignatura en el modal
        document.getElementById('editAsignaturaId').value = asignaturaId;
        modal.style.display = 'block';
    });
});



closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});


window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

