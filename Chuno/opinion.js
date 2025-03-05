const stars = document.querySelectorAll('.star');
const btnEnviar = document.getElementById('btnEnviar');
const btnSi = document.getElementById('btnSi');
const btnNo = document.getElementById('btnNo');

let votoAFavor = null; // Guarda si el usuario votó a favor o en contra
let calificacion = 0; 

stars.forEach((star, index) => {
    star.addEventListener("click", function() {
        calificacion = index + 1;
        for (let i = 0; i <= index; i++) {
            stars[i].classList.add('checked');
        }
        for (let i = index + 1; i < stars.length; i++) {
            stars[i].classList.remove('checked');
        }
    });
});



btnSi.addEventListener('click', function() {
    votoAFavor = true;
    btnSi.classList.add('btn-seleccionado');
    btnSi.classList.remove('btn-difuminado');

    btnNo.classList.add('btn-difuminado');
    btnNo.classList.remove('btn-seleccionado');
});

btnNo.addEventListener('click', function() {
    votoAFavor = false;
    btnNo.classList.add('btn-seleccionado');
    btnNo.classList.remove('btn-difuminado');

    btnSi.classList.add('btn-difuminado');
    btnSi.classList.remove('btn-seleccionado');
});

btnEnviar.addEventListener('click', function() {
    let mensajeVotacion = votoAFavor === true
        ? "Puntuaste a favor del conferencista."
        : "No puntuaste a favor del conferencista.";

    let mensajePuntuacion = `Calificaste la conferencia con ${calificacion} estrella(s).`;

    console.log(mensajeVotacion);
    console.log(mensajePuntuacion);
});