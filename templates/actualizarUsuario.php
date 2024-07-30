<?php
session_start();

// Verificar si se ha iniciado sesión y si el usuario tiene el rol de administrador
if (!isset($_SESSION['usuarioID']) || empty($_SESSION['usuarioID']) || $_SESSION['rol'] !== 'admin') {
    // Si no se cumple la condición, redirigir a la página de administrador
    header("Location: admin.php");
    exit();
}

// Verificar si se han proporcionado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han proporcionado todos los datos necesarios
    if (isset($_POST['id']) && isset($_POST['usuario']) && isset($_POST['rol'])) {
        // Obtener los datos del formulario
        $id = $_POST['id'];
        $usuario = $_POST['usuario'];
        $rol = $_POST['rol'];

        // Realizar la actualización en la base de datos
        require('../config/config.php');

        $stmt = $conn->prepare("UPDATE registro SET usuario = :usuario, rol = :rol WHERE id = :id");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Redirigir a la página de administrador con un mensaje de éxito
            header("Location: admin.php?mensaje=Usuario actualizado correctamente");
            exit();
        } else {
            // En caso de error, redirigir a la página de administrador con un mensaje de error
            header("Location: admin.php?mensaje=Error al actualizar el usuario");
            exit();
        }
    } else {
        // Si faltan datos, redirigir a la página de administrador con un mensaje de error
        header("Location: admin.php?mensaje=Faltan datos del formulario");
        exit();
    }
} else {
    // Si no se reciben datos por POST, redirigir a la página de administrador
    header("Location: admin.php");
    exit();
}
?>
