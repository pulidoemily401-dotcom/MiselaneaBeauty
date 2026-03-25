<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-pencil-square"></i> Actualizar Producto</h3>
        
        <!-- Alertas -->
        <?php if (isset($_SESSION['mensaje_error'])): ?>
            <div class="alert alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= $_SESSION['mensaje_error']; ?></span>
            </div>
            <?php unset($_SESSION['mensaje_error']); ?>
        <?php endif; ?>
        
        <?php if (isset($productoActualizar) && $productoActualizar): ?>
            
            <form action="index.php?action=actualizarproducto" method="POST" enctype="multipart/form-data" class="form-grid">
                
                <input type="hidden" name="idproducto" value="<?= htmlspecialchars($productoActualizar['idproducto']); ?>">
                
                <div class="form-group">
                    <label for="nombre">
                        <i class="bi bi-tag-fill"></i> Nombre del Producto *
                    </label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        value="<?= htmlspecialchars($productoActualizar['nombre']); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="precio">
                        <i class="bi bi-cash-coin"></i> Precio *
                    </label>
                    <input 
                        type="number" 
                        id="precio" 
                        name="precio" 
                        step="0.01"
                        min="0"
                        value="<?= htmlspecialchars($productoActualizar['precio']); ?>"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label for="descripcion">
                        <i class="bi bi-card-text"></i> Descripción *
                    </label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion" 
                        rows="4"
                        required
                    ><?= htmlspecialchars($productoActualizar['descripcion']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="idcategoria">
                        <i class="bi bi-grid-3x3-gap"></i> Categoría *
                    </label>
                    <select id="idcategoria" name="idcategoria" required>
                        <option value="">Seleccionar categoría</option>
                        <?php if (isset($categorias)): ?>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= htmlspecialchars($cat['idcategoria']); ?>"
                                    <?= ($cat['idcategoria'] == $productoActualizar['idcategoria']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($cat['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idmarca">
                        <i class="bi bi-award"></i> Marca *
                    </label>
                    <select id="idmarca" name="idmarca" required>
                        <option value="">Seleccionar marca</option>
                        <?php if (isset($marcas)): ?>
                            <?php foreach ($marcas as $marca): ?>
                                <option value="<?= htmlspecialchars($marca['idmarca']); ?>"
                                    <?= ($marca['idmarca'] == $productoActualizar['idmarca']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($marca['marca']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">
                        <i class="bi bi-boxes"></i> Stock *
                    </label>
                    <input 
                        type="number" 
                        id="stock" 
                        name="stock" 
                        min="0"
                        value="<?= htmlspecialchars($productoActualizar['stock']); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="fechaingreso">
                        <i class="bi bi-calendar-event"></i> Fecha de Ingreso *
                    </label>
                    <input 
                        type="date" 
                        id="fechaingreso" 
                        name="fechaingreso" 
                        value="<?= htmlspecialchars($productoActualizar['fechaingreso']); ?>"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label>
                        <i class="bi bi-image"></i> Imagen Actual
                    </label>
                    <div style="margin-bottom: 1rem;">
                        <img src="photo/<?= htmlspecialchars($productoActualizar['imagen']); ?>" 
                             alt="<?= htmlspecialchars($productoActualizar['nombre']); ?>"
                             class="product-img-preview">
                    </div>
                    <input type="hidden" name="imagen_actual" value="<?= htmlspecialchars($productoActualizar['imagen']); ?>">
                </div>

                <div class="form-group full-width">
                    <label for="imagen">
                        <i class="bi bi-cloud-upload"></i> Cambiar Imagen (opcional)
                    </label>
                    <input 
                        type="file" 
                        id="imagen" 
                        name="imagen"
                        accept="image/*"
                    >
                    <small style="color: #666; display: block; margin-top: 0.5rem;">
                        Dejar vacío si no deseas cambiar la imagen
                    </small>
                </div>

                <div class="button-group full-width">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Guardar Cambios
                    </button>
                    <a href="index.php?action=listProducto" class="btn btn-back">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
                
            </form>
            
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-exclamation-triangle"></i>
                <p>No se encontró el producto a actualizar.</p>
                <a href="index.php?action=listProducto" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        <?php endif; ?>
        
    </div>

</div>



</body>
</html>
