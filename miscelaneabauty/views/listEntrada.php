<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Entradas | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-box-arrow-in-down-right"></i> Lista de Entradas</h3>
      
        <div class="search-container">
            <form action="index.php?action=listentrada" method="GET" class="search-form">
                <input type="hidden" name="action" value="listentrada">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="numerodocumen" 
                        id="searchInput"
                        placeholder="Buscar por ID de usuario (número de documento)..." 
                        value="<?= htmlspecialchars($_GET['numerodocumen'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['numerodocumen']) && !empty($_GET['numerodocumen'])): ?>
                        <a href="index.php?action=listentrada" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            
            <?php if (isset($_GET['numerodocumen']) && !empty($_GET['numerodocumen'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por usuario: <strong><?= htmlspecialchars($_GET['numerodocumen']); ?></strong>
                    <?php if (isset($entrada)): ?>
                        (<?= count($entrada); ?> resultado<?= count($entrada) != 1 ? 's' : ''; ?>)
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
        
        <?php if (isset($entrada) && count($entrada) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID Entrada</th>
                            <th><i class="bi bi-box-seam-fill"></i> ID Producto</th>
                            <th><i class="bi bi-person-badge-fill"></i> Nº Documento</th>
                            <th><i class="bi bi-stack"></i> Cantidad</th>
                            <th><i class="bi bi-calendar-event"></i> Fecha Entrada</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entrada as $entra): ?>
                            <tr>
                                <td><?= htmlspecialchars($entra["identrada"]); ?></td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="bi bi-box-seam"></i> <?= htmlspecialchars($entra["idproducto"]); ?>
                                    </span>
                                </td>
                                <td><strong><?= htmlspecialchars($entra["numerodocumen"]); ?></strong></td>
                                <td>
                                    <?php if ($entra["cantidad"] > 50): ?>
                                        <span class="badge badge-success">
                                            <i class="bi bi-check-circle"></i> <?= htmlspecialchars($entra["cantidad"]); ?>
                                        </span>
                                    <?php elseif ($entra["cantidad"] > 10): ?>
                                        <span class="badge badge-warning">
                                            <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($entra["cantidad"]); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-error">
                                            <i class="bi bi-arrow-down-circle"></i> <?= htmlspecialchars($entra["cantidad"]); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($entra["fechaentrada"]); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=actualizarentrada&identrada=<?= urlencode($entra['identrada']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar entrada">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deleteentrada" 
                                              method="post" 
                                              style="display: inline;"
                                           onsubmit="return confirm('¿Estás seguro de eliminar la entrada #<?= htmlspecialchars($entra['identrada']); ?>?');">
                                            <input type="hidden" name="identrada" value="<?= htmlspecialchars($entra['identrada']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar entrada">
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
                    <?php if (isset($_GET['numerodocumen']) && !empty($_GET['numerodocumen'])): ?>
                        No se encontraron entradas para el usuario <strong>"<?= htmlspecialchars($_GET['numerodocumen']); ?>"</strong>
                    <?php else: ?>
                        No hay entradas registradas en el sistema.
                    <?php endif; ?>
                </p>
                <?php if (isset($_GET['numerodocumen']) && !empty($_GET['numerodocumen'])): ?>
                    <a href="index.php?action=listentrada" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
                        <i class="bi bi-arrow-left"></i> Ver todas las entradas
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