<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Devoluciones | Miscelánea Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>
<div class="container">
    <div class="results-section fade-in">
        <h3><i class="bi bi-arrow-return-left"></i> Mis Devoluciones</h3>

        <?php if (isset($_SESSION['mensaje_ok'])): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <?= $_SESSION['mensaje_ok']; ?>
            </div>
            <?php unset($_SESSION['mensaje_ok']); ?>
        <?php endif; ?>

        <?php if (isset($devolucion) && count($devolucion) > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-receipt"></i> Factura</th>
                            <th><i class="bi bi-bag-heart"></i> Producto</th>
                            <th><i class="bi bi-123"></i> Cantidad</th>
                            <th><i class="bi bi-calendar"></i> Fecha</th>
                            <th><i class="bi bi-chat-text"></i> Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($devolucion as $dev): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($dev['iddevolucion']) ?></strong></td>
                            <td>#<?= htmlspecialchars($dev['idfactura']) ?></td>
                            <td><?= htmlspecialchars($dev['nombreproducto']) ?></td>
                            <td><?= htmlspecialchars($dev['cantidad']) ?></td>
                            <td><?= htmlspecialchars(date('d/m/Y', strtotime($dev['fechaingreso']))) ?></td>
                            <td><?= htmlspecialchars($dev['descripcionmotivo']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>No tienes devoluciones registradas aún.</p>
            </div>
        <?php endif; ?>

        <div class="button-group" style="margin-top:2rem;">
            <a href="../../FRONTEND/php/productos.php" class="btn btn-back">
                <i class="bi bi-arrow-left-circle"></i> Volver a la Tienda
            </a>
        </div>
    </div>
</div>
</body>
</html>