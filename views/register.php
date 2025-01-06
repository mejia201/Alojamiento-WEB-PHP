<?php

require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validación básica de entrada
        if (empty($nombre) || empty($email) || empty($password)) {
            echo "Todos los campos son requeridos.";
            exit();
        }

        // Validación del formato del correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Correo electrónico inválido.";
            exit();
        }

        // Verificar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo "El correo electrónico ya está registrado.";
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $hashedPassword]);

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/style.css" />
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">Regístrate</h2>
                        <form method="POST">
                            <div class="mb-4">
                                <label for="nombre" class="form-label fw-bold">Nombre Completo</label>
                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Tu Nombre" required />
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Tu Correo Electrónico" required />
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Contraseña</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Tu Contraseña" required />
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Registrar</button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>