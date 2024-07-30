<?php
session_start();
require('../config/config.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['usuario']) || empty($_POST['password'])) {
        $message = 'Por favor, complete todos los campos.';
    } else {
        $records = $conn->prepare('SELECT id, usuario, contraseña, rol FROM registro WHERE usuario=:usuario');
        $records->bindParam(':usuario', $_POST['usuario']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results && password_verify($_POST['password'], $results['contraseña'])) {
            // Verificar si el usuario es "admin"
            if ($results['rol'] === 'admin') {
                $_SESSION['usuarioID'] = $results['id'];
                $_SESSION['rol'] = 'admin'; // Asegúrate de establecer la sesión del rol
                header('Location: ../templates/admin.php'); // Redirigir al usuario administrador a admin.php
                exit();
            } else {
                $_SESSION['usuarioID'] = $results['id'];
                $_SESSION['rol'] = 'usuario'; // Asegúrate de establecer la sesión del rol
                header('Location: ../templates/inicio.php'); // Redirigir a la página de inicio estándar para otros usuarios
                exit();
            }
        } else {
            $message = 'Usuario o contraseña incorrectos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <section class="form-main">
        <div class="form-content">
            <div class="box">
            <?php if (!empty($message)): ?>
                <p><?= $message ?></p>
            <?php endif; ?>
                <h3>Bienvenido</h3>
                <form action="inicioSesion.php" method="POST">
                    <div class="input-box">
                        <input type="text" placeholder="Nombre de usuario" class="input-control" name="usuario"> 
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Contraseña" class="input-control" name="password">
                    </div>
                    <button type="submit" class="btn">Iniciar Sesión</button>
                </form>
                <p>No tienes una cuenta? <a href="registro.php" class="gradient-text">Crear Cuenta</a></p>
            </div>
        </div>
    </section>
</body>
</html>
