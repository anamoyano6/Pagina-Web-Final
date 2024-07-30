<?php
// Verificar si se ha proporcionado un ID de usuario para editar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require('../config/config.php');

    // Obtener la información del usuario
    $stmt = $conn->prepare("SELECT id, usuario, rol FROM registro WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // Si no se encuentra el usuario, redirigir a la página de administrador
        header("Location: admin.php");
        exit();
    }
} else {
    // Si no se proporciona un ID de usuario, redirigir a la página de administrador
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="actualizarUsuario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <div>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>">
            </div>
            <div>
                <label for="rol">Rol:</label>
                <select id="rol" name="rol">
                    <option value="usuario" <?php if ($usuario['rol'] === 'usuario') echo 'selected'; ?>>Usuario</option>
                    <option value="admin" <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
                </select>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
