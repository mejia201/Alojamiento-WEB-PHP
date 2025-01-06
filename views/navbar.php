<?php

require_once __DIR__ . '/../helpers/baseURL.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid px-4">
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>">Inicio</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>views/admin.php">Panel de Administración</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>views/cuenta.php">Mi Cuenta</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>helpers/logout.php">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>views/login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>views/register.php">Crear Cuenta</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

