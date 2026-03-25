<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Factura | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-pencil-square"></i> Actualizar Factura</h3>

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

        <?php if (isset($factura) && $factura): ?>
            <form action="index.php?action=actualizarFactura" method="POST" class="form-grid">

                <input type="hidden" name="idfactura" value="<?= htmlspecialchars($factura['idfactura']); ?>">

                <div class="form-group">
                    <label for="fechayhora">
                        <i class="bi bi-calendar-event"></i> Fecha y Hora
                    </label>
                    <input
                        type="datetime-local"
                        id="fechayhora"
                        name="fechayhora"
                        value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($factura['fechayhora']))); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="numerodocumen">
                        <i class="bi bi-person-vcard"></i> Número de Documento
                    </label>
                    <input
                        type="text"
                        id="numerodocumen"
                        name="numerodocumen"
                        value="<?= htmlspecialchars($factura['numerodocumen']); ?>"
                        required
                        maxlength="20"
                    >
                </div>

               

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-floppy-fill"></i> Guardar Cambios
                    </button>

                    <a href="index.php?action=listFactura" class="btn btn-back">
                        <i class="bi bi-arrow-left-circle"></i> Cancelar
                    </a>
                </div>

            </form>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-exclamation-triangle"></i>
                <p>No se encontró la factura solicitada.</p>
                <a href="index.php?action=listFactura" class="btn btn-back" style="margin-top: 1rem; display: inline-flex;">
                    <i class="bi bi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>