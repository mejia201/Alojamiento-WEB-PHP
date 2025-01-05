<?php
ini_set('display_errors', 1); // Muestra los errores
ini_set('display_startup_errors', 1); // Muestra los errores al iniciar PHP
error_reporting(E_ALL);

require '../database/config.php';
require_once '../helpers/baseURL.php';

session_start();

// Verificación de acceso de administrador
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $stmt = $pdo->prepare("INSERT INTO alojamientos (nombre, descripcion, imagen) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $imagen]);

    header("Location: " . BASE_URL);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title text-center">Agregar Alojamiento</h5>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del alojamiento" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" placeholder="Descripción del alojamiento" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">URL de la Imagen</label>
                        <input type="text" name="imagen" class="form-control" placeholder="URL de la imagen" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Agregar</button>
                </form>

                <div class="text-center mt-3">
                <a href="<?= BASE_URL ?>" class="btn btn-secondary">Regresar al Inicio</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
