<?php

require '../database/config.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario con el email proporcionado
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Almacenar información del usuario en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        // Redirigir según el rol del usuario
        if ($user['is_admin'] == 1) {
            // Si es administrador, redirigir al panel de administración
            header("Location: admin.php");
            exit();
        } else {
            // Si no es administrador, redirigir a la cuenta normal
            header("Location: cuenta.php");
            exit();
        }
    } else {
        // Si las credenciales son incorrectas
        $error = "Credenciales incorrectas.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Iniciar Sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../styles/style.css" />
    </head>
    <body>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>

                            <?php if (!empty($error)): ?>
                            <div class="error mb-4"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Tu Correo Electrónico" required />
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">Contraseña</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Tu Contraseña" required />
                                </div>
                                <button type="submit" class="btn btn-primary w-100 rounded-pill">Iniciar Sesión</button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="mb-0">¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>