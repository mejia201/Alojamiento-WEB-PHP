<?php

require '../database/config.php';
require_once '../helpers/baseURL.php';
require_once 'template.php';

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

renderHeader('Panel de Administración');
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <h2 class="card-title text-center mb-4">Agregar Alojamiento</h2>

                    <form method="POST">
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" placeholder="Ej: Apartamento acogedor en el centro" required />
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control form-control-lg" rows="4" placeholder="Describe tu alojamiento..." required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="imagen" class="form-label fw-bold">URL de la Imagen</label>
                            <input type="text" name="imagen" id="imagen" class="form-control form-control-lg" placeholder="https://ejemplo.com/imagen.jpg" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">Agregar alojamiento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php renderFooter();?>