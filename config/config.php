<?php 
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'agenda';
    
    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $e) {
        die('Fallo la Conexion: '.$e->getMessage());

    }
?>
