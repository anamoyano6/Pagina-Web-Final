<?php
// Verificar si se ha proporcionado un ID de usuario para eliminar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require('../config/config.php');

    // Eliminar el usuario de la base de datos
    $stmt = $conn->prepare("DELETE FROM registro WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    
    if ($stmt->execute()) {
        // Redirigir de vuelta a la página de administrador después de eliminar el usuario
        header("Location: admin.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    // Si no se proporciona un ID de usuario, redirigir a la página de administrador
    header("Location: admin.php");
    exit();
}
?>
