<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Salida | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-pencil-square"></i> Actualizar Salida #<?= htmlspecialchars($salida['idsalida']); ?></h3>

        <!-- Alertas -->
        <?php if (isset($_SESSION['mensaje_ok'])): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span><?= $_SESSION['mensaje_ok']; ?></span>
            </div>
            <?php unset($_SESSION['mensaje_ok']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensaje_error'])): ?>
            <div class="alert alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= $_SESSION['mensaje_error']; ?></span>
            </div>
            <?php unset($_SESSION['mensaje_error']); ?>
        <?php endif; ?>

        <form action="index.php?action=actualizarsalida" method="post" class="form-grid">

            <!-- ID oculto -->
            <input type="hidden" name="idsalida" value="<?= htmlspecialchars($salida['idsalida']); ?>">

            <!-- Producto -->
            <div class="form-group">
                <label for="idproducto"><i class="bi bi-box-seam-fill"></i> Producto</label>
                <select name="idproducto" id="idproducto" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= htmlspecialchars($producto['idproducto']); ?>"
                            <?= ($producto['idproducto'] == $salida['idproducto']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($producto['nombre'] ?? "Producto " . $producto['idproducto']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Fecha Salida -->
            <div class="form-group">
                <label for="fechasalida"><i class="bi bi-calendar-event"></i> Fecha Salida</label>
                <input type="date" name="fechasalida" id="fechasalida" required
                       value="<?= htmlspecialchars($salida['fechasalida']); ?>">
            </div>

            <!-- Cantidad -->
            <div class="form-group">
                <label for="cantidad"><i class="bi bi-stack"></i> Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required
                       value="<?= htmlspecialchars($salida['cantidad']); ?>">
            </div>

            <!-- Botones -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy-fill"></i> Guardar Cambios
                </button>
                <a href="index.php?action=listsalida" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>