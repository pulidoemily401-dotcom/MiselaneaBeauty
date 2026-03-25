<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Detalles | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">

    <div class="results-section">

        <h3><i class="bi bi-list-check"></i> Buscar Detalle de Factura</h3>

        <div class="search-container">
            <form action="index.php?action=listDetalle" method="GET" class="search-form">
                <input type="hidden" name="action" value="listDetalle">

                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        name="idfactura"
                        id="searchInput"
                        placeholder="Buscar por número de factura..."
                        value="<?= htmlspecialchars($_GET['idfactura'] ?? ''); ?>"
                        class="search-input"
                    >

                    <?php if (isset($_GET['idfactura']) && !empty($_GET['idfactura'])): ?>
                        <a href="index.php?action=listDetalle" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>

            <?php if (isset($_GET['idfactura']) && !empty($_GET['idfactura'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por factura: <strong><?= htmlspecialchars($_GET['idfactura']); ?></strong>
                    <?php if (isset($Detalle)): ?>
                        (<?= count($Detalle); ?> resultado<?= count($Detalle) != 1 ? 's' : ''; ?>)
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

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

        <?php if (isset($Detalle) && count($Detalle) > 0): ?>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID Detalle</th>
                            <th><i class="bi bi-box-seam"></i> Producto</th>
                            <th><i class="bi bi-receipt"></i> N° Documento</th>
                            <th><i class="bi bi-123"></i> Cantidad</th>
                            <th><i class="bi bi-tag"></i> Precio Unitario</th>
                            <th><i class="bi bi-currency-dollar"></i> Valor Total</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Detalle as $detalle): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($detalle["iddetallefactura"]); ?></strong></td>
                                <td><?= htmlspecialchars($detalle["nombreproducto"] ?? $detalle["idproducto"]); ?></td>
                                <td><?= htmlspecialchars($detalle["numerodocumen"] ?? $detalle["idfactura"]); ?></td>
                                <td><?= htmlspecialchars($detalle["cantidad"]); ?></td>
                                <td>$<?= number_format($detalle["preciouni"], 0, ',', '.'); ?></td>
                                <td><strong>$<?= number_format($detalle["valortotalcadapro"], 0, ',', '.'); ?></strong></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=editarDetalle&id=<?= urlencode($detalle['iddetallefactura']); ?>"
                                           class="btn-action btn-update"
                                           title="Actualizar detalle">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>

                                        <form action="index.php?action=deleteDetalle"
                                              method="post"
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar el detalle #<?= htmlspecialchars($detalle['iddetallefactura']); ?>?');">
                                            <input type="hidden" name="iddetallefactura" value="<?= htmlspecialchars($detalle['iddetallefactura']); ?>">
                                            <button type="submit"
                                                    class="btn-action btn-delete"
                                                    title="Eliminar detalle">
                                                <i class="bi bi-trash-fill"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif (isset($Detalle)): ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>No se encontraron detalles para la factura <strong>"<?= htmlspecialchars($_GET['idfactura'] ?? ''); ?>"</strong></p>
                <a href="index.php?action=listDetalle" class="btn btn-back" style="margin-top: 1rem; display: inline-flex;">
                    <i class="bi bi-arrow-left"></i> Nueva búsqueda
                </a>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <p>Ingrese un número de factura para buscar detalles</p>
            </div>
        <?php endif; ?>

        <div class="button-group">
            <a href="index.php?action=dashBoard" class="btn btn-back">
                <i class="bi bi-arrow-left-circle"></i> Volver al Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>