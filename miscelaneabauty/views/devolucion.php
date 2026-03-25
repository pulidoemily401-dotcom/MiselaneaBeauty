<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Devolución | MISCELANEA BEAUTY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-arrow-counterclockwise"></i> 
            <?= $_SESSION['idrol'] == 3 ? 'Mis Devoluciones' : 'Registro de Devolución' ?>
        </h3>

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

        <form action="index.php?action=insertDevolucion" method="POST" class="form-grid">

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
                    <?php foreach ($facturas as $fac): ?>
                        <option value="<?= htmlspecialchars($fac['idfactura']); ?>">
                            Factura #<?= htmlspecialchars($fac['idfactura']); ?>
                            <?= $_SESSION['idrol'] == 1 ? ' - Doc: ' . htmlspecialchars($fac['numerodocumen']) : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcionmotivo"><i class="bi bi-chat-text-fill"></i> Motivo / Descripción</label>
                <input type="text" name="descripcionmotivo" id="descripcionmotivo" required
                       placeholder="Ingrese el motivo de la devolución">
            </div>

            <!-- Cantidad -->
            <div class="form-group">
                <label for="cantidad"><i class="bi bi-stack"></i> Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required
                       placeholder="Ingrese la cantidad">
            </div>

            <!-- Fecha Ingreso -->
            <div class="form-group">
                <label for="fechaingreso"><i class="bi bi-calendar-event"></i> Fecha de Ingreso</label>
                <input type="date" name="fechaingreso" id="fechaingreso" required
                       value="<?= date('Y-m-d'); ?>">
            </div>

            <!-- Botones -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy-fill"></i> Guardar Devolución
                </button>
                <a href="index.php?action=<?= $_SESSION['idrol'] == 3 ? 'dashBoardu' : 'listDevolucion' ?>" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>

        </form>

        <!-- ── HISTORIAL SOLO PARA USUARIO ── -->
        <?php if ($_SESSION['idrol'] == 3 && isset($devolucion) && count($devolucion) > 0): ?>
            <hr style="margin: 2rem 0; border-color: #e8f0e6;">
            <h4 style="font-family:'Playfair Display',serif; color:#1a1208; margin-bottom:1rem;">
                <i class="bi bi-clock-history" style="color:#4caf50;"></i> Historial de mis devoluciones
            </h4>
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
        <?php elseif ($_SESSION['idrol'] == 3): ?>
            <hr style="margin: 2rem 0; border-color: #e8f0e6;">
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>No tienes devoluciones registradas aún.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>