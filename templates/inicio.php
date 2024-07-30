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
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<?php include 'header.html'; ?>

<!-- Banner grande -->
<div class="banner">
    <source src="../img/PATAS.mp4" type="video/mp4">
</div>

<!-- Primera sección de información -->
<div class="seccion-info">
    <div class="contenedor-info">
        <div class="texto-info">
            <h2>¿Qué es el Método Pomodoro?</h2>
            <p>El trabajo dividido en bloques de tiempo es una efectiva estrategia para utilizar tu tiempo sabiamente y lograr mejores resultados. Te ayuda a dar mejor estructura a tu flujo de trabajo, te permite concentrarte en una labor a la vez, y limita el distraerse y recaer en procastinación. El método Pomodoro es utilizado por desarrolladores, diseñadores, escritores y estudiantes a lo largo del mundo.</p>
        </div>
    </div>
    <div class="contenedor-img">
        <img src="../img/indiologo2.png" alt="Descripción de la imagen">
    </div>
</div>

<!-- Segunda sección de información -->
<div class="seccion-info">
    <div class="contenedor-img">
        <img src="../img/cuatroperros.png" alt="Descripción de la imagen">
    </div>
    <div class="contenedor-info">
        <div class="texto-info">
            <h2>¿Cuáles son los beneficios?</h2>
            <p>La utilización recurrente y prolongada de esta técnica, te va a permitir lograr grandiosos resultados. Estos ciclos, al tornarse naturales para vos, te van a ayudar a mantenerte despejado y alerta. Tu habilidad para concentrarte y trabajar van a mejorar.</p>
        </div>
    </div>
</div>
<!-- Contenedor de las tarjetas -->
<div class="contenedor-tarjetas">
    <!-- Tarjeta 1 -->
    <div class="tarjeta">
        <div class="texto-info">
            <h2>¿Cómo funciona?</h2>
            <p>Primero, elegí la tarea que necesitás completar. Eliminá toda distracción e inicia el temporizador de 25 minutos. Disponete a trabajar hasta que se acabe y suene.</p>
            <img src="../img/zeko.png" alt="Imagen tarjeta 1">
        </div>
    </div>
    <!-- Tarjeta 2 -->
    <div class="tarjeta">
        <div class="texto-info">
            <h2>Mantenete en concentración, completá tu trabajo.</h2>
            <p>Dale a tu trabajo toda tu atención. El mundo puede esparar 25 minutos a que terminés tus deberes.</p>
            <img src="../img/oto.png" alt="Imagen tarjeta 2">
        </div>
    </div>
    <!-- Tarjeta 3 -->
    <div class="tarjeta">
        <div class="texto-info">
            <h2>Luego, ¡Tomáte un receso!</h2>
            <p>Tomate un receso corto, de cinco minutos. Podrías caminar o tomar algo de aire fresco. Este receso está diseñado para dejarte recuperar energías.</p>
            <img src="../img/perrobalde.png" alt="Imagen tarjeta 3">
        </div>
    </div>
    <!-- Tarjeta 4 -->
    <div class="tarjeta">
        <div class="texto-info">
            <h2>Repetí este ciclo</h2>
            <p>Se recomienda repetir este ciclo 4 veces y luego tomar un descanso largo. Entre más hágas esto, te vas a tornar más productivo, porque tu cuerpo se acostumbrará a este método y ritmo.</p>
            <img src="../img/cholo.png" alt="Imagen tarjeta 4">
        </div>
</div>

<?php include 'footer.html'; ?>

</body>
</html>
