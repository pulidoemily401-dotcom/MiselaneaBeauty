<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-box-seam-fill"></i> Registro de Producto</h3>

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

        <form action="index.php?action=insertProducto" method="POST" enctype="multipart/form-data" class="form-grid">

            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre"><i class="bi bi-tag-fill"></i> Nombre</label>
                <input type="text" name="nombre" id="nombre" required
                       placeholder="Ingrese el nombre del producto">
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion"><i class="bi bi-card-text"></i> Descripción</label>
                <textarea name="descripcion" id="descripcion" required
                          placeholder="Ingrese una descripción del producto"
                          rows="3"></textarea>
            </div>

            <!-- Marca -->
            <div class="form-group">
                <label for="idmarca"><i class="bi bi-award-fill"></i> Marca</label>
                <select name="idmarca" id="idmarca" required>
                    <option value="">Seleccione una marca</option>
                    <?php foreach ($marcas as $marca): ?>
                        <option value="<?= htmlspecialchars($marca['idmarca']); ?>">
                            <?= htmlspecialchars($marca['marca']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Imagen -->
            <div class="form-group">
                <label for="imagen"><i class="bi bi-image-fill"></i> Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
            </div>

            <!-- Precio -->
            <div class="form-group">
                <label for="precio"><i class="bi bi-cash-coin"></i> Precio Venta</label>
                <input type="number" name="precio" id="precio" step="0.01" min="0" required
                       placeholder="0.00">
            </div>

            <!-- Categoría -->
            <div class="form-group">
                <label for="idcategoria"><i class="bi bi-grid-3x3-gap-fill"></i> Categoría</label>
                <select name="idcategoria" id="idcategoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria['idcategoria']); ?>">
                            <?= htmlspecialchars($categoria['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock"><i class="bi bi-boxes"></i> Stock</label>
                <input type="number" name="stock" id="stock" min="0" required
                       placeholder="Cantidad disponible">
            </div>

            <!-- Fecha Ingreso -->
            <div class="form-group">
                <label for="fechaingreso"><i class="bi bi-calendar-event"></i> Fecha Ingreso</label>
                <input type="date" name="fechaingreso" id="fechaingreso" required>
            </div>

            <!-- Botones -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy-fill"></i> Guardar Producto
                </button>
                <a href="index.php?action=listProducto" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>