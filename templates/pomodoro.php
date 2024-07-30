<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene el rol adecuado
if (!isset($_SESSION['usuarioID']) || empty($_SESSION['usuarioID']) || $_SESSION['rol'] !== 'usuario') {
    // Redireccionar a la página de inicio de sesión si no hay una sesión activa o el rol no es de usuario
    header("Location: ../usuario/inicioSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador Pomodoro</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<?php include 'header.html'; ?>

<div class="container">
    <h1>Contador Pomodoro</h1>
    <h2 id="titulo_actividad" class="actividad">Estudio</h2>
    <p class="temporizador" id="tiempo_restante">25 minutos</p> <!-- Cambié el valor inicial a 1 minuto -->
    <div class="botones-container"> <!-- Contenedor para los botones -->
        <button class="pomodoro-btn" onclick="iniciarContador()">Iniciar</button>
        <button class="pomodoro-btn" onclick="pausarContador()">Pausar</button>
        <button class="pomodoro-btn" onclick="reiniciarContador()">Reiniciar</button>
    </div>
</div>

<!-- Elemento de alerta personalizada -->
<div id="custom-alert" class="custom-alert">
    <p id="custom-alert-message" class="custom-alert-message"></p>
    <button id="custom-alert-close" class="custom-alert-close">Cerrar</button>
</div>

<audio id="alerta" src="../img/alarma2.mp3" preload="auto"></audio> <!-- Agregamos un elemento de audio -->

<?php include 'footer.html'; ?>

<script src="contador.js"></script>

</body>
</html>
