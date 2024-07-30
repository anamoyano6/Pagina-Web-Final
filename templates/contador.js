var duracion_estudio = 2; 
var duracion_descanso = 1; 
var tiempo_restante; 
var contador; 
var tipo_actividad = 'estudio'; 
var contador_iniciado = false; 
var alarma = new Audio('../img/alarma2.mp3'); 


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
    contador_iniciado = false; 
}

function reiniciarContador() {
    clearInterval(contador);
    contador_iniciado = false; 
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
        alarma.play(); 
        mostrarAlertaPersonalizada("¡Tiempo terminado!"); 

        if (tipo_actividad === 'estudio') {
            iniciarContadorDescanso(); 
        } else {
            iniciarContadorEstudio(); 
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
