<?php
session_start();
require_once 'helpers/baseURL.php';

?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">Alojamientos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>views/cuenta.php">Mi Cuenta</a>
                        </li>
                        
                        <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>views/admin.php">Panel de Administración</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>helpers/logout.php">Cerrar Sesión</a>

                        </li>
                        
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>views/login.php">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>views/register.php">Crear Cuenta</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav> -->

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
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>views/cuenta.php">Mi Cuenta</a>
                    </li>
                    
                    <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill px-3" href="<?= BASE_URL ?>views/admin.php">Panel de Administración</a>
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
