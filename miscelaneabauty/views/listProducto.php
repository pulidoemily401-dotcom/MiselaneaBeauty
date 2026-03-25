<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-box-seam-fill"></i> Lista de Productos</h3>
      
        <div class="search-container">
            <form action="index.php?action=listProducto" method="GET" class="search-form">
                <input type="hidden" name="action" value="listProducto">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="nombre" 
                        id="searchInput"
                        placeholder="Buscar por nombre de producto..." 
                        value="<?= htmlspecialchars($_GET['nombre'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['nombre']) && !empty($_GET['nombre'])): ?>
                        <a href="index.php?action=listProducto" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            
            <?php if (isset($_GET['nombre']) && !empty($_GET['nombre'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por: <strong><?= htmlspecialchars($_GET['nombre']); ?></strong>
                    <?php if (isset($producto)): ?>
                        (<?= count($producto); ?> resultado<?= count($producto) != 1 ? 's' : ''; ?>)
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
        
        <?php if (isset($producto) && count($producto) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-image"></i> Imagen</th>
                            <th><i class="bi bi-tag-fill"></i> Nombre</th>
                            <th><i class="bi bi-cash-coin"></i> Precio</th>
                            <th><i class="bi bi-card-text"></i> Descripción</th>
                            <th><i class="bi bi-grid-3x3-gap"></i> Categoría</th>
                            <th><i class="bi bi-boxes"></i> Stock</th>
                            <th><i class="bi bi-calendar-event"></i> Fecha Ingreso</th>
                            <th><i class="bi bi-award"></i> Marca</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($producto as $prod): ?>
                            <tr>
                                <td><?= htmlspecialchars($prod["idproducto"]); ?></td>
                                <td>
                                    <img src="photo/<?= htmlspecialchars($prod["imagen"]); ?>" 
                                         alt="<?= htmlspecialchars($prod["nombre"]); ?>" 
                                         class="product-img">
                                </td>
                                <td><strong><?= htmlspecialchars($prod["nombre"]); ?></strong></td>
                                <td class="price">$<?= number_format($prod["precio"], 0, ',', '.'); ?></td>
                                <td><?= htmlspecialchars($prod["descripcion"]); ?></td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="bi bi-tag"></i> <?= htmlspecialchars($prod["nombre_categoria"]); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($prod["stock"] > 10): ?>
                                        <span class="badge badge-success">
                                            <i class="bi bi-check-circle"></i> <?= htmlspecialchars($prod["stock"]); ?>
                                        </span>
                                    <?php elseif ($prod["stock"] > 0): ?>
                                        <span class="badge badge-warning">
                                            <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($prod["stock"]); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-error">
                                            <i class="bi bi-x-circle"></i> Agotado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($prod["fechaingreso"]); ?></td>
                                <td><?= htmlspecialchars($prod["nombre_marca"]); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=actualizarproducto&idproducto=<?= urlencode($prod['idproducto']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar producto">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deleteproducto" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar el producto <?= htmlspecialchars($prod['nombre']); ?>?');">
                                            <input type="hidden" name="idproducto" value="<?= htmlspecialchars($prod['idproducto']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar producto">
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
                    <?php if (isset($_GET['nombre']) && !empty($_GET['nombre'])): ?>
                        No se encontraron productos con el nombre <strong>"<?= htmlspecialchars($_GET['nombre']); ?>"</strong>
                    <?php else: ?>
                        No hay productos registrados en el sistema.
                    <?php endif; ?>
                </p>
                <?php if (isset($_GET['nombre']) && !empty($_GET['nombre'])): ?>
                    <a href="index.php?action=listProducto" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
                        <i class="bi bi-arrow-left"></i> Ver todos los productos
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
/* Estilos adicionales para productos */
.product-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(158, 201, 155, 0.15);
    transition: transform 0.3s ease;
}

.product-img:hover {
    transform: scale(1.1);
}

.price {
    font-weight: 700;
    color: var(--primary-dark);
    font-size: 1.1rem;
}

.badge-warning {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: white;
}
</style>

</body>
</html>