<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!isset($_SESSION['usuarioID']) || empty($_SESSION['usuarioID']) || $_SESSION['rol'] !== 'admin') {
    // Redireccionar a la página de inicio de sesión si no hay una sesión activa o el rol no es de administrador
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administrador</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<header>
    <!-- Logo -->
    <div class="logo">
        <a class="logo title-bold">Administrador</a>
    </div>
    
    <!-- Botón de cerrar sesión -->
    <ul>
        <li>
            <a href="../../pagina/index.html" class="logout-btn">Cerrar Sesión</a>


        </li>
    </ul>
</header>
    <div class="container">
        <h1>Bienvenido, Administrador</h1>
        <h2>Usuarios Registrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php
            require('../config/config.php');
            $stmt = $conn->prepare("SELECT id, usuario, rol FROM registro");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['rol'] . "</td>";
                echo "<td><a href='eliminarUsuario.php?id=" . $row['id'] . "'>Eliminar</a> | <a href='editarUsuario.php?id=" . $row['id'] . "'>Editar Rol</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>


    <?php include 'footer.html'; ?>
</body>
</html>
