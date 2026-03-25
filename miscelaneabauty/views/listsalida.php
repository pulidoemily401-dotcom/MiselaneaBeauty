<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Salidas | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-box-arrow-up-right"></i> Lista de Salidas</h3>
      
        <div class="search-container">
            <form action="index.php?action=listsalida" method="GET" class="search-form">
                <input type="hidden" name="action" value="listsalida">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="fechasalida" 
                        id="searchInput"
                        placeholder="Buscar por fecha de salida (ej: 2024-01)..." 
                        value="<?= htmlspecialchars($_GET['fechasalida'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['fechasalida']) && !empty($_GET['fechasalida'])): ?>
                        <a href="index.php?action=listsalida" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            
            <?php if (isset($_GET['fechasalida']) && !empty($_GET['fechasalida'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por fecha: <strong><?= htmlspecialchars($_GET['fechasalida']); ?></strong>
                    <?php if (isset($salida)): ?>
                        (<?= count($salida); ?> resultado<?= count($salida) != 1 ? 's' : ''; ?>)
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
        
        <?php if (isset($salida) && count($salida) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID Salida</th>
                            <th><i class="bi bi-box-seam-fill"></i> ID Producto</th>
                            <th><i class="bi bi-calendar-event"></i> Fecha Salida</th>
                            <th><i class="bi bi-stack"></i> Cantidad</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salida as $sali): ?>
                            <tr>
                                <td><?= htmlspecialchars($sali["idsalida"]); ?></td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="bi bi-box-seam"></i> <?= htmlspecialchars($sali["idproducto"]); ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($sali["fechasalida"]); ?></td>
                                <td>
                                    <?php if ($sali["cantidad"] > 50): ?>
                                        <span class="badge badge-success">
                                            <i class="bi bi-check-circle"></i> <?= htmlspecialchars($sali["cantidad"]); ?>
                                        </span>
                                    <?php elseif ($sali["cantidad"] > 10): ?>
                                        <span class="badge badge-warning">
                                            <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($sali["cantidad"]); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-error">
                                            <i class="bi bi-arrow-up-circle"></i> <?= htmlspecialchars($sali["cantidad"]); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=actualizarsalida&idsalida=<?= urlencode($sali['idsalida']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar salida">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deletesalida" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar la entrada #<?= htmlspecialchars($sali['idsalida']); ?>?');">
                                            <input type="hidden" name="idsalida" value="<?= htmlspecialchars($sali['idsalida']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar salida">
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
            
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>
                    <?php if (isset($_GET['fechasalida']) && !empty($_GET['fechasalida'])): ?>
                        No se encontraron salidas para la fecha <strong>"<?= htmlspecialchars($_GET['fechasalida']); ?>"</strong>
                    <?php else: ?>
                        No hay salidas registradas en el sistema.
                    <?php endif; ?>
                </p>
                <?php if (isset($_GET['fechasalida']) && !empty($_GET['fechasalida'])): ?>
                    <a href="index.php?action=listsalida" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
                        <i class="bi bi-arrow-left"></i> Ver todas las salidas
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="button-group" style="margin-top: 2rem;">
            <a href="index.php?action=dashBoard" class="btn btn-back">
                <i class="bi bi-arrow-left-circle"></i> Volver al Dashboard
            </a>
        </div>
        
    </div>

</div>

<style>
.badge-warning {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: white;
}
</style>

</body>
</html>