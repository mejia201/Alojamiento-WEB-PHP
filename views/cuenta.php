<?php
ini_set('display_errors', 1);  // Muestra los errores
ini_set('display_startup_errors', 1);  // Muestra los errores al iniciar PHP
error_reporting(E_ALL);  // Informa sobre todos los tipos de errores
?>

<?php
require '../database/config.php';
require_once '../helpers/baseURL.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener los alojamientos seleccionados por el usuario
$stmt = $pdo->prepare("SELECT a.id, a.nombre, a.descripcion, a.imagen 
                       FROM usuario_alojamiento ua 
                       JOIN alojamientos a ON ua.id_alojamiento = a.id 
                       WHERE ua.id_usuario = ?");
$stmt->execute([$user_id]);
$alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Bienvenido a tu cuenta</h1>
        <h4 class="text-center mb-4">Alojamientos seleccionados</h4>

         <!-- Mensaje de sesión -->
         <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>


        <div class="row g-4">
            <?php if (empty($alojamientos)): ?>
                <p class="text-center">No has seleccionado ningún alojamiento aún.</p>
            <?php else: ?>
                <?php foreach ($alojamientos as $alojamiento): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100">
                            <img src="<?= $alojamiento['imagen'] ?>" class="card-img-top" alt="<?= htmlspecialchars($alojamiento['nombre']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($alojamiento['nombre']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($alojamiento['descripcion']) ?></p>
                            </div>
                            <div class="card-footer">
                                <form method="POST" action="../views/eliminar.php">
                                    <input type="hidden" name="id_alojamiento" value="<?= $alojamiento['id'] ?>">
                                    <button type="submit" class="btn btn-danger w-100">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?= BASE_URL ?>" class="btn btn-secondary">Regresar al Inicio</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
