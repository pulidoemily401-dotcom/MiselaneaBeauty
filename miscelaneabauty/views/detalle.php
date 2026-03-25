<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Detalle de Factura | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-list-check"></i> Registro Detalle de Factura</h3>

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

        <form action="index.php?action=insertDetalle" method="POST" class="form-grid">

            <!-- Producto -->
            <div class="form-group">
                <label for="idproducto"><i class="bi bi-box-seam-fill"></i> Producto</label>
                <select name="idproducto" id="idproducto" required>
                    <option value="">Seleccione un producto</option>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= htmlspecialchars($producto['idproducto']); ?>">
                            <?= htmlspecialchars($producto['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Factura -->
            <div class="form-group">
                <label for="idfactura"><i class="bi bi-receipt"></i> Factura</label>
                <select name="idfactura" id="idfactura" required>
                    <option value="">Seleccione una factura</option>
                    <?php foreach ($facturas as $factura): ?>
                        <option value="<?= htmlspecialchars($factura['idfactura']); ?>">
                            <?= htmlspecialchars($factura['numerodocumen']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Cantidad -->
            <div class="form-group">
                <label for="cantidad"><i class="bi bi-stack"></i> Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required
                       placeholder="Ingrese la cantidad">
            </div>

            <!-- Precio Unitario -->
            <div class="form-group">
                <label for="preciouni"><i class="bi bi-cash-coin"></i> Precio Unitario</label>
                <input type="number" name="preciouni" id="preciouni" step="0.01" min="0" required
                       placeholder="0.00">
            </div>

            <!-- Valor Total -->
            <div class="form-group">
                <label for="valortotalcadapro"><i class="bi bi-calculator-fill"></i> Valor Total</label>
                <input type="number" name="valortotalcadapro" id="valortotalcadapro" step="0.01" min="0" required
                       placeholder="0.00">
            </div>

            <!-- Botones -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy-fill"></i> Guardar Detalle
                </button>
                <a href="index.php?action=listDetalle" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>