<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Detalles de Factura | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- RUTA CORRECTA SIN css/ -->
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-receipt"></i> Lista de Detalles de Factura</h3>
      
        <div class="search-container">
            <form action="index.php" method="GET" class="search-form">
                <input type="hidden" name="action" value="listDetalle">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="number" 
                        name="idfactura" 
                        id="searchInput"
                        placeholder="Buscar por ID de factura..." 
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
                    Filtrando por factura ID: <strong><?= htmlspecialchars($_GET['idfactura']); ?></strong>
                    <?php if (isset($Detalle)): ?>
                        (<?= count($Detalle); ?> resultado<?= count($Detalle) != 1 ? 's' : ''; ?>)
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Alertas -->
        <?php if (isset($_SESSION['mensaje_ok']) && !empty($_SESSION['mensaje_ok'])): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span><?= $_SESSION['mensaje_ok']; ?></span>
            </div>
            <?php unset($_SESSION['mensaje_ok']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensaje_error']) && !empty($_SESSION['mensaje_error'])): ?>
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
                            <th><i class="bi bi-hash"></i> #</th>
                            <th><i class="bi bi-receipt"></i> ID Detalle</th>
                            <th><i class="bi bi-file-earmark-text"></i> Factura</th>
                            <th><i class="bi bi-box-seam"></i> Producto</th>
                            <th><i class="bi bi-layers"></i> Cantidad</th>
                            <th><i class="bi bi-tag"></i> Precio Unitario</th>
                            <th><i class="bi bi-cash-stack"></i> Valor Total</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $contador = 1;
                        foreach ($Detalle as $deta): 
                        ?>
                            <tr>
                                <td><?= $contador++; ?></td>
                                <td><strong><?= htmlspecialchars($deta["iddetallefactura"]); ?></strong></td>
                                
                                <td>
                                    <span class="badge badge-info">
                                        <i class="bi bi-file-earmark"></i>
                                        Factura #<?= htmlspecialchars($deta["idfactura"]); ?>
                                    </span>
                                </td>
                                
                                <td><strong><?= htmlspecialchars($deta["nombreproducto"]); ?></strong></td>
                                
                                <td>
                                    <span class="badge badge-success">
                                        <?= htmlspecialchars($deta["cantidad"]); ?> uds.
                                    </span>
                                </td>
                                
                                <td>
                                    $<?= number_format($deta["preciouni"], 0, ',', '.'); ?>
                                </td>
                                
                                <td>
                                    <strong>$<?= number_format($deta["valortotalcadapro"], 0, ',', '.'); ?></strong>
                                </td>
                                
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=editarDetalle&id=<?= urlencode($deta['iddetallefactura']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar detalle">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=eliminarDetalle" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Eliminar el detalle #<?= $deta['iddetallefactura']; ?> del producto <?= htmlspecialchars(addslashes($deta['nombreproducto'])); ?>?');">
                                            <input type="hidden" name="iddetallefactura" value="<?= $deta['iddetallefactura']; ?>">
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
            
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>
                    <?php if (isset($_GET['idfactura']) && !empty($_GET['idfactura'])): ?>
                        No se encontraron detalles para la factura <strong>#<?= htmlspecialchars($_GET['idfactura']); ?></strong>
                    <?php else: ?>
                        No hay detalles de factura registrados.
                    <?php endif; ?>
                </p>
                <?php if (isset($_GET['idfactura']) && !empty($_GET['idfactura'])): ?>
                    <a href="index.php?action=listDetalle" class="btn btn-back" style="margin-top: 1rem; display: inline-flex;">
                        <i class="bi bi-arrow-left"></i> Ver todos los detalles
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

</body>
</html>