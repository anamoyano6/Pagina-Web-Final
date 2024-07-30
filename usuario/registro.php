<?php
require('../config/config.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['usuario']) || empty($_POST['password'])) {
        $message = 'Por favor, complete todos los campos.';
    } else {
        // Verificar si el usuario ya existe
        $sql = "SELECT * FROM registro WHERE usuario = :usuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $_POST['usuario']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $message = 'El nombre de usuario ya existe. Por favor, elija otro.';
        } else {
            // Insertar el nuevo usuario
            $sql = "INSERT INTO registro (usuario, contraseña, rol) VALUES (:usuario, :password, :rol)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario', $_POST['usuario']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password);
            $rol = ($_POST['usuario'] === 'admin') ? 'admin' : 'usuario';
            $stmt->bindParam(':rol', $rol);

            if ($stmt->execute()) {
                header('Refresh: 2; URL=inicioSesion.php');
            } else {
                $message = 'Error al crear al usuario.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <section class="form-main">
        <div class="form-content">
            <div class="box">
            <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
                <h3>Crear una cuenta</h3>
                <form action="registro.php" method="POST">
                    <div class="input-box">
                        <input type="text" placeholder="Nombre de usuario" class="input-control" name="usuario"> 
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Contraseña" class="input-control" name="password">
                    </div>
                    <button type="submit" class="btn">Crear Cuenta</button>
                </form>

                <p>Ya tienes una cuenta? <a href="inicioSesion.php" class="gradient-text">Iniciar Sesión</a></p>
            </div>
        </div>
    </section>
</body>
</html>
