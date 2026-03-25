<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-person-fill-add"></i> Registro de Usuario</h3>

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

        <?php
           
            $origen = $_GET['origen'] ?? 'publico';
            $cancelarUrl = ($origen === 'admin')
                ? 'index.php?action=listUsuario'
                : 'index.php';
        ?>

        <form action="index.php?action=insertUsuario" method="POST" enctype="multipart/form-data" class="form-grid">

            <div class="form-group">
                <label for="nombrecompleto"><i class="bi bi-person-fill"></i> Nombre Completo</label>
                <input type="text" name="nombrecompleto" id="nombrecompleto" required
                       placeholder="Ingrese el nombre completo">
            </div>

            <div class="form-group">
                <label for="correoelectronic"><i class="bi bi-envelope-fill"></i> Correo Electrónico</label>
                <input type="email" name="correoelectronic" id="correoelectronic" required
                       placeholder="correo@ejemplo.com">
            </div>

            <div class="form-group">
                <label for="telefono"><i class="bi bi-telephone-fill"></i> Teléfono</label>
                <input type="text" name="telefono" id="telefono" required
                       placeholder="Ingrese el número de teléfono">
            </div>

            <div class="form-group">
                <label for="idtipo"><i class="bi bi-file-earmark-person-fill"></i> Tipo Documento</label>
                <select name="idtipo" id="idtipo" required>
                    <option value="">Seleccione un tipo de documento</option>
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?= htmlspecialchars($tipo['idtipo']); ?>">
                            <?= htmlspecialchars($tipo['documento']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="numerodocumen"><i class="bi bi-card-text"></i> Número Documento</label>
                <input type="text" name="numerodocumen" id="numerodocumen" required
                       placeholder="Ingrese el número de documento">
            </div>

            <div class="form-group">
                <label for="tipogenero"><i class="bi bi-gender-ambiguous"></i> Género</label>
                <select name="tipogenero" id="tipogenero" required>
                    <option value="">Seleccione un género</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </div>

            <?php if ($origen === 'admin'): ?>
       
            <div class="form-group">
                <label for="idrol"><i class="bi bi-shield-fill-check"></i> Rol</label>
                <select name="idrol" id="idrol" required>
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= htmlspecialchars($rol['idrol']); ?>">
                            <?= htmlspecialchars($rol['nombrerol']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php else: ?>
            
            <input type="hidden" name="idrol" value="">
            <?php endif; ?>

            <div class="form-group">
                <label for="contra"><i class="bi bi-lock-fill"></i> Contraseña</label>
                <input type="password" name="contra" id="contra" required
                       placeholder="Ingrese una contraseña">
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-fill-add"></i> Registrar Usuario
                </button>
                <a href="<?= $cancelarUrl; ?>" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>