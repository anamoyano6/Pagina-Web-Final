var duracion_estudio = 25; // Duración del periodo de estudio en minutos (1 minuto)
var duracion_descanso = 5; // Duración del periodo de descanso en minutos (1 minuto)
var tiempo_restante; // Variable para almacenar el tiempo restante en segundos
var contador; // Variable para almacenar el intervalo del contador
var tipo_actividad = 'estudio'; // Tipo de actividad actual (estudio o descanso)
var contador_iniciado = false; // Bandera para indicar si el contador ha sido iniciado
var alarma = new Audio('../img/alarma2.mp3'); // Sonido de alerta

function iniciarContadorEstudio() {
    tipo_actividad = 'estudio';
    tiempo_restante = duracion_estudio * 60;
    document.getElementById("titulo_actividad").innerText = "Estudio";
    actualizarContador();
    contador = setInterval(actualizarContador, 1000);
    contador_iniciado = true;
}

function iniciarContadorDescanso() {
    tipo_actividad = 'descanso';
    tiempo_restante = duracion_descanso * 60;
    document.getElementById("titulo_actividad").innerText = "Descanso";
    actualizarContador();
    contador = setInterval(actualizarContador, 1000);
    contador_iniciado = true;
}

function iniciarContador() {
    clearInterval(contador);
    if (tipo_actividad === 'estudio') {
        iniciarContadorEstudio();
    } else {
        iniciarContadorDescanso();
    }
}

function pausarContador() {
    clearInterval(contador);
    contador_iniciado = false; // establecer la bandera como falsa al pausar el contador
}

function reiniciarContador() {
    clearInterval(contador);
    contador_iniciado = false; // establecer la bandera como falsa al reiniciar el contador
    iniciarContador();
}

function actualizarContador() {
    if (!contador_iniciado) {
        return;
    }

    var minutos_restantes = Math.floor(tiempo_restante / 60);
    var segundos_restantes = tiempo_restante % 60;

    segundos_restantes = segundos_restantes.toString().padStart(2, '0');

    document.getElementById("tiempo_restante").innerText = minutos_restantes + ":" + segundos_restantes;

    tiempo_restante--;

    if (tiempo_restante < 0) {
        clearInterval(contador);
        alarma.play(); // Reproducir el sonido de alerta
        mostrarAlertaPersonalizada("¡Tiempo terminado!"); // Mostrar la notificación personalizada

        if (tipo_actividad === 'estudio') {
            iniciarContadorDescanso(); // Cambiar al temporizador de descanso después de que termine el de estudio
        } else {
            iniciarContadorEstudio(); // Cambiar al temporizador de estudio después de que termine el de descanso
        }
    }
}

function mostrarAlertaPersonalizada(mensaje) {
    var customAlert = document.getElementById("custom-alert");
    var customAlertMessage = document.getElementById("custom-alert-message");
    
    customAlertMessage.textContent = mensaje;
    customAlert.style.display = "block";
}

function cerrarAlertaPersonalizada() {
    var customAlert = document.getElementById("custom-alert");
    customAlert.style.display = "none";
}

document.getElementById("custom-alert-close").addEventListener("click", cerrarAlertaPersonalizada);
