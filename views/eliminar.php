<?php
ini_set('display_errors', 1);  // Muestra los errores
ini_set('display_startup_errors', 1);  // Muestra los errores al iniciar PHP
error_reporting(E_ALL);  // Informa sobre todos los tipos de errores
?>

<?php
require '../database/config.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verificar si se ha enviado el ID del alojamiento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_alojamiento'])) {
    $user_id = $_SESSION['user_id'];
    $id_alojamiento = $_POST['id_alojamiento'];

    // Validar que el id_alojamiento sea un número entero positivo
    if (filter_var($id_alojamiento, FILTER_VALIDATE_INT) === false || $id_alojamiento <= 0) {
        $_SESSION['message'] = "ID de alojamiento inválido.";
        $_SESSION['message_type'] = "danger";
        header("Location: cuenta.php");
        exit;
    }

    // Eliminar el alojamiento seleccionado por el usuario
    $stmt = $pdo->prepare("DELETE FROM usuario_alojamiento WHERE id_usuario = ? AND id_alojamiento = ?");
    $stmt->execute([$user_id, $id_alojamiento]);

    // Verificar si la eliminación fue exitosa
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Alojamiento eliminado con éxito.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "No se pudo eliminar el alojamiento. Intenta nuevamente.";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: cuenta.php");
    exit;
}
?>
