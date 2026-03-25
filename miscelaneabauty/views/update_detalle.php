<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Detalle de Factura | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-pencil-square"></i> Actualizar Detalle de Factura</h3>

        <!-- Alertas -->
        <?php if (isset($_SESSION['mensaje_error']) && !empty($_SESSION['mensaje_error'])): ?>
            <div class="alert alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= $_SESSION['mensaje_error']; ?></span>
            </div>
            <?php unset($_SESSION['mensaje_error']); ?>
        <?php endif; ?>

        <!-- AQUÍ ESTABA EL ERROR: NO debe haber foreach, $detalle ya es UN solo registro -->
        <form action="index.php?action=actualizarDetalle" method="POST">
            
            <input type="hidden" name="iddetallefactura" value="<?= htmlspecialchars($detalle['iddetallefactura'] ?? ''); ?>">

            <div class="form-grid">
                
                <!-- Factura -->
                <div class="form-group">
                    <label for="idfactura">
                        <i class="bi bi-file-earmark-text"></i> Factura
                    </label>
                    <select name="idfactura" id="idfactura" required>
                        <option value="">Seleccione una factura</option>
                        <?php foreach ($facturas as $f): ?>
                            <option value="<?= $f['idfactura']; ?>" 
                                <?= ($f['idfactura'] == ($detalle['idfactura'] ?? '')) ? 'selected' : ''; ?>>
                                Factura #<?= $f['idfactura']; ?> - <?= htmlspecialchars($f['numerodocumen'] ?? 'Sin documento'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Producto -->
                <div class="form-group">
                    <label for="idproducto">
                        <i class="bi bi-box-seam"></i> Producto
                    </label>
                    <select name="idproducto" id="idproducto" required>
                        <option value="">Seleccione un producto</option>
                        <?php foreach ($productos as $p): ?>
                            <option value="<?= $p['idproducto']; ?>" 
                                <?= ($p['idproducto'] == ($detalle['idproducto'] ?? '')) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($p['nombre'] ?? 'Producto ' . $p['idproducto']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Cantidad -->
                <div class="form-group">
                    <label for="cantidad">
                        <i class="bi bi-layers"></i> Cantidad
                    </label>
                    <input 
                        type="number" 
                        id="cantidad" 
                        name="cantidad" 
                        min="1" 
                        step="1"
                        value="<?= htmlspecialchars($detalle['cantidad'] ?? ''); ?>"
                        required
                    >
                </div>

                <!-- Precio Unitario -->
                <div class="form-group">
                    <label for="preciouni">
                        <i class="bi bi-tag"></i> Precio Unitario
                    </label>
                    <input 
                        type="number" 
                        id="preciouni" 
                        name="preciouni" 
                        min="0" 
                        step="1"
                        value="<?= htmlspecialchars(number_format($detalle['preciouni'] ?? 0, 0, '', '')); ?>"
                        required
                    >
                </div>

                <!-- Valor Total -->
                <div class="form-group">
                    <label for="valortotalcadapro">
                        <i class="bi bi-cash-stack"></i> Valor Total
                    </label>
                    <input 
                        type="number" 
                        id="valortotalcadapro" 
                        name="valortotalcadapro" 
                        min="0" 
                        step="1"
                        value="<?= htmlspecialchars(number_format($detalle['valortotalcadapro'] ?? 0, 0, '', '')); ?>"
                        required
                        readonly
                        style="background-color: #f5f5f5;"
                    >
                </div>

                <!-- Botones -->
                <div class="button-group full-width">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Actualizar Detalle
                    </button>
                    
                    <a href="index.php?action=listDetalle" class="btn btn-back">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
// Calcular automáticamente el valor total cuando cambian cantidad o precio
document.getElementById('cantidad').addEventListener('input', calcularTotal);
document.getElementById('preciouni').addEventListener('input', calcularTotal);

function calcularTotal() {
    const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
    const precioUni = parseFloat(document.getElementById('preciouni').value) || 0;
    const total = cantidad * precioUni;
    // Sin decimales para valores enteros
    document.getElementById('valortotalcadapro').value = Math.round(total);
}
</script>

</body>
</html>