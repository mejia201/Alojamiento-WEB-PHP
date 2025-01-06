<?php

require '../database/config.php';
require_once '../helpers/baseURL.php';
require_once 'template.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener los alojamientos seleccionados por el usuario
$stmt = $pdo->prepare("SELECT a.id, a.nombre, a.descripcion, a.imagen 
                       FROM usuario_alojamiento ua 
                       JOIN alojamientos a ON ua.id_alojamiento = a.id 
                       WHERE ua.id_usuario = ?");
$stmt->execute([$user_id]);
$alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

renderHeader('Mi cuenta');
?>

<div class="container my-5">
    <h1 class="text-center mb-2">Bienvenido a tu cuenta</h1>
    <h4 class="text-center mb-4 text-muted">Alojamientos seleccionados</h4>

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
        <div class="col-12">
            <p class="text-center fs-5 text-muted">No has seleccionado ningún alojamiento aún.</p>
        </div>
        <?php else: ?>
        <?php foreach ($alojamientos as $alojamiento): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <img src="<?= $alojamiento['imagen'] ?>" class="card-img-top" alt="<?= htmlspecialchars($alojamiento['nombre']) ?>" />
                <div class="card-body p-3">
                    <h5 class="card-title fw-bold mb-1"><?= htmlspecialchars($alojamiento['nombre']) ?></h5>
                    <p class="card-text text-muted small mb-2"><?= htmlspecialchars($alojamiento['descripcion']) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$XX por noche</span>
                        <span class="text-muted small">
                            <i class="bi bi-star-fill text-warning"></i>
                            4.5 (XX reseñas)
                        </span>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 p-3">
                    <form method="POST" action="../views/eliminar.php">
                        <input type="hidden" name="id_alojamiento" value="<?= $alojamiento['id'] ?>" />
                        <button type="submit" class="btn btn-danger w-100 rounded-pill">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php renderFooter();?>