<?php
ini_set('display_errors', 1); // Muestra los errores
ini_set('display_startup_errors', 1); // Muestra los errores al iniciar PHP
error_reporting(E_ALL); // Informa sobre todos los tipos de errores

require '../database/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $id_alojamiento = $_POST['id_alojamiento'];

    // Evitar duplicados
    $stmt = $pdo->prepare("SELECT * FROM usuario_alojamiento WHERE id_usuario = ? AND id_alojamiento = ?");
    $stmt->execute([$user_id, $id_alojamiento]);

    if ($stmt->rowCount() === 0) {
        $stmt = $pdo->prepare("INSERT INTO usuario_alojamiento (id_usuario, id_alojamiento) VALUES (?, ?)");
        $stmt->execute([$user_id, $id_alojamiento]);

        $_SESSION['message'] = "Alojamiento seleccionado exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Este alojamiento ya está seleccionado.";
        $_SESSION['message_type'] = "warning";
    }
}

header("Location: cuenta.php");
exit();
