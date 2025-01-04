<?php include 'views/navbar.php'; ?>

<?php
require 'database/config.php';

$stmt = $pdo->query("SELECT * FROM alojamientos");
$alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alojamientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">

</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Lista de Alojamientos</h1>
        <div class="row g-4">
            <?php foreach ($alojamientos as $alojamiento): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <img src="<?= $alojamiento['imagen'] ?>" class="card-img-top" alt="<?= htmlspecialchars($alojamiento['nombre']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($alojamiento['nombre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($alojamiento['descripcion']) ?></p>
                        </div>
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['is_admin'] == 0): ?>
                            <div class="card-footer">
                                <form method="POST" action="./views/seleccionar.php">
                                    <input type="hidden" name="id_alojamiento" value="<?= $alojamiento['id'] ?>">
                                    <button type="submit" class="btn btn-primary w-100">Seleccionar</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
