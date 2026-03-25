<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Devoluciones | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section">
        
        <h3><i class="bi bi-arrow-return-left"></i> Buscar Devoluciones</h3>
      
        <div class="search-container">
            <form action="index.php?action=listDevolucion" method="GET" class="search-form">
                <input type="hidden" name="action" value="listDevolucion">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="iddevolucion" 
                        id="searchInput"
                        placeholder="Buscar por número de Documento..." 
                        value="<?= htmlspecialchars($_GET['iddevolucion'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['iddevolucion']) && !empty($_GET['iddevolucion'])): ?>
                        <a href="index.php?action=listDevolucion" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            
            <?php if (isset($_GET['iddevolucion']) && !empty($_GET['iddevolucion'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por factura: <strong><?= htmlspecialchars($_GET['iddevolucion']); ?></strong>
                    <?php if (isset($devolucion)): ?>
                        (<?= count($devolucion); ?> resultado<?= count($devolucion) != 1 ? 's' : ''; ?>)
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
        
        <?php if (isset($devolucion) && count($devolucion) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID Devolución</th>
                            <th><i class="bi bi-box-seam"></i> Producto</th>
                            <th><i class="bi bi-123"></i> Cantidad</th>
                            <th><i class="bi bi-calendar-event"></i> Fecha Devolución</th>
                            <th><i class="bi bi-receipt"></i> N° Documento</th>
                            <th><i class="bi bi-chat-text"></i> Motivo</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($devolucion as $devolu): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($devolu["iddevolucion"]); ?></strong></td>
                                <td><?= htmlspecialchars($devolu["nombreproducto"] ?? $devolu["idproducto"]); ?></td>
                                <td><?= htmlspecialchars($devolu["cantidad"]); ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($devolu["fechaingreso"]))); ?></td>
                                <td><?= htmlspecialchars($devolu["numerodocumen"] ?? $devolu["idfactura"]); ?></td>
                                <td><?= htmlspecialchars($devolu["descripcionmotivo"]); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=editarDevolucion&id=<?= urlencode($devolu['iddevolucion']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar devolución">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deletedevolucion" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar la devolución #<?= htmlspecialchars($devolu['iddevolucion']); ?>?');">
                                            <input type="hidden" name="iddevolucion" value="<?= htmlspecialchars($devolu['iddevolucion']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar devolución">
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
            
        <?php elseif (isset($devolucion)): ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>No se encontraron devoluciones para la factura <strong>"<?= htmlspecialchars($_GET['iddevolucion'] ?? ''); ?>"</strong></p>
                <a href="index.php?action=listDevolucion" class="btn btn-back" style="margin-top: 1rem; display: inline-flex;">
                    <i class="bi bi-arrow-left"></i> Nueva búsqueda
                </a>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <p>Ingrese un número de factura para buscar devoluciones</p>
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