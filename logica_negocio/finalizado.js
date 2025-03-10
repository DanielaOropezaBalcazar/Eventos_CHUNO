document.addEventListener("DOMContentLoaded", function () {
    // Función para cargar los eventos finalizados
    function cargarEventos() {
        const oradorId = document.getElementById("idOrador").value;

        console.log("ID del orador enviado:", oradorId); // Depuración

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../Persistencia/finalizadoBD.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("eventos-tbody").innerHTML = xhr.responseText;
            }
        };
        xhr.send("idOrador=" + encodeURIComponent(oradorId));
    }

    // Llamada inicial para cargar los eventos
    cargarEventos();
});
