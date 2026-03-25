<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Facturas | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-receipt-cutoff"></i> 
            <?= $_SESSION["idrol"] == 1 ? 'Buscar Facturas' : 'Mis Facturas' ?>
        </h3>

        <?php if ($_SESSION["idrol"] == 1): ?>
        <div class="search-container">
            <form action="index.php?action=listFactura" method="GET" class="search-form">
                <input type="hidden" name="action" value="listFactura">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="idusuario" 
                        id="searchInput"
                        placeholder="Buscar por número de documento del usuario..." 
                        value="<?= htmlspecialchars($_GET['idusuario'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['idusuario']) && !empty($_GET['idusuario'])): ?>
                        <a href="index.php?action=listFactura" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            
            <?php if (isset($_GET['idusuario']) && !empty($_GET['idusuario'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por documento: <strong><?= htmlspecialchars($_GET['idusuario']); ?></strong>
                    <?php if (isset($factura)): ?>
                        (<?= count($factura); ?> resultado<?= count($factura) != 1 ? 's' : ''; ?>)
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
            <div class="search-results-info">
                <i class="bi bi-funnel-fill"></i>
                Mostrando <strong><?= isset($factura) ? count($factura) : 0 ?></strong> 
                factura<?= (isset($factura) && count($factura) != 1) ? 's' : '' ?> de tu cuenta
            </div>
        <?php endif; ?>
      
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
        
        <?php if (isset($factura) && count($factura) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID Factura</th>
                            <th><i class="bi bi-calendar-event"></i> Fecha y Hora</th>
                            <th><i class="bi bi-person-vcard"></i> Documento Usuario</th>
                            <?php if ($_SESSION["idrol"] == 1): ?>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($factura as $fact): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($fact["idfactura"]); ?></strong></td>
                                <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($fact["fechayhora"]))); ?></td>
                                <td><?= htmlspecialchars($fact["numerodocumen"]); ?></td>
                                <?php if ($_SESSION["idrol"] == 1): ?>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=editarFactura&id=<?= urlencode($fact['idfactura']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar factura">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deletefactura" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar la factura #<?= htmlspecialchars($fact['idfactura']); ?>?');">
                                            <input type="hidden" name="idfactura" value="<?= htmlspecialchars($fact['idfactura']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar factura">
                                                <i class="bi bi-trash-fill"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        <?php elseif (isset($factura)): ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>
                    <?php if ($_SESSION["idrol"] == 1): ?>
                        No se encontraron facturas para el documento <strong>"<?= htmlspecialchars($_GET['idusuario'] ?? ''); ?>"</strong>
                    <?php else: ?>
                        No tienes facturas registradas aún.
                    <?php endif; ?>
                </p>
                <?php if ($_SESSION["idrol"] == 1): ?>
                <a href="index.php?action=listFactura" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
                    <i class="bi bi-arrow-left"></i> Nueva búsqueda
                </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <p>Ingrese un número de documento para buscar facturas</p>
            </div>
        <?php endif; ?>
        
        <div class="button-group" style="margin-top: 2rem;">
            <a href="index.php?action=<?= $_SESSION['idrol'] == 1 ? 'dashBoard' : 'dashBoardu' ?>" class="btn btn-back">
                <i class="bi bi-arrow-left-circle"></i> Volver al Panel
            </a>
        </div>
        
    </div>

</div>

</body>
</html>