document.getElementById("inscripcionForm").addEventListener("submit", function(event) {
    event.preventDefault();  // Previene que el formulario se envíe de forma tradicional

    const correoInscripcion = document.getElementById("correoInscripcion").value;
    const idCharla = document.getElementById("idCharla").value;
    


    // Crear la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../Persistencia/inscripcionBD.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Inscripción exitosa!");
            // Aquí podrías hacer alguna acción adicional, como redirigir al usuario
        }
    };

    // Enviar los datos del formulario
    xhr.send("correoInscripcion=" + encodeURIComponent(correoInscripcion) + "&idCharla=" + encodeURIComponent(idCharla));
    
});
