<?php
require('../config/config.php');
$message = '';

if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO registro (usuario, contraseña, rol) VALUES (:usuario, :password, :rol)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    
    // Asignar el rol "admin" si el usuario es "admin", de lo contrario, asignar el rol "usuario"
    $rol = ($_POST['usuario'] === 'admin') ? 'admin' : 'usuario';
    $stmt->bindParam(':rol', $rol);

    if ($stmt->execute()) {
        header('Location: inicioSesion.php');
    } else {
        $message = 'Error al crear al usuario.';
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
