<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario | MISCELANEA BEAUTY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="results-section fade-in">

        <h3><i class="bi bi-person-fill-gear"></i> Actualizar Usuario</h3>

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
        $numerodocumen = $_GET['numerodocumen'] ?? null;
        $usuarioEditar = null;
        foreach ($usuarios as $user) {
            if ($user['numerodocumen'] == $numerodocumen) {
                $usuarioEditar = $user;
                break;
            }
        }

        if (!$usuarioEditar): ?>
            <div class="alert alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>⚠️ Usuario no encontrado</span>
            </div>
            <?php if (isset($_SESSION['idrol']) && $_SESSION['idrol'] == 1): ?>
                <a href="index.php?action=listUsuario" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Volver a la lista
                </a>
            <?php else: ?>
                <a href="index.php?action=dashBoardu" class="btn btn-back">
                    <i class="bi bi-arrow-left-circle"></i> Volver al panel
                </a>
            <?php endif; ?>
        <?php else: ?>

        <form action="index.php?action=actualizarusuario" method="post" class="form-grid">

            <input type="hidden" name="numerodocumen" value="<?= htmlspecialchars($usuarioEditar['numerodocumen']); ?>">

            <div class="form-group">
                <label for="nombrecompleto"><i class="bi bi-person-fill"></i> Nombre Completo</label>
                <input type="text" name="nombrecompleto" id="nombrecompleto" required
                       value="<?= htmlspecialchars($usuarioEditar['nombrecompleto']); ?>">
            </div>

            <div class="form-group">
                <label for="correoelectronic"><i class="bi bi-envelope-fill"></i> Correo Electrónico</label>
                <input type="email" name="correoelectronic" id="correoelectronic" required
                       value="<?= htmlspecialchars($usuarioEditar['correoelectronic']); ?>">
            </div>

            <div class="form-group">
                <label for="telefono"><i class="bi bi-telephone-fill"></i> Teléfono</label>
                <input type="text" name="telefono" id="telefono" required
                       value="<?= htmlspecialchars($usuarioEditar['telefono']); ?>">
            </div>

            <div class="form-group">
                <label><i class="bi bi-card-text"></i> Número Documento <small style="color:#aaa;">(no editable)</small></label>
                <input type="text"
                       value="<?= htmlspecialchars($usuarioEditar['numerodocumen']); ?>"
                       readonly
                       style="background-color: #f5f5f5; cursor: not-allowed; opacity: 0.7;">
            </div>

            <div class="form-group">
                <label for="idtipo"><i class="bi bi-file-earmark-person-fill"></i> Tipo Documento</label>
                <select name="idtipo" id="idtipo" required>
                    <?php foreach ($docums as $docu): ?>
                        <option value="<?= htmlspecialchars($docu['idtipo']); ?>"
                            <?= ($docu['idtipo'] == $usuarioEditar['idtipo']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($docu['documento']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tipogenero"><i class="bi bi-gender-ambiguous"></i> Género</label>
                <select name="tipogenero" id="tipogenero" required>
                    <option value="Femenino"  <?= ($usuarioEditar['tipogenero'] == 'Femenino')  ? 'selected' : ''; ?>>Femenino</option>
                    <option value="Masculino" <?= ($usuarioEditar['tipogenero'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                </select>
            </div>

            <div class="form-group">
                <label for="idrol"><i class="bi bi-shield-fill-check"></i> Rol</label>
                <?php if (isset($_SESSION['idrol']) && $_SESSION['idrol'] == 1): ?>
                    <select name="idrol" id="idrol" required>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= htmlspecialchars($rol['idrol']); ?>"
                                <?= ($rol['idrol'] == $usuarioEditar['idrol']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($rol['nombrerol']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <!-- Usuario normal: no puede cambiar su rol -->
                    <input type="hidden" name="idrol" value="<?= htmlspecialchars($usuarioEditar['idrol']); ?>">
                    <input type="text" value="<?php
                        foreach ($roles as $r) {
                            if ($r['idrol'] == $usuarioEditar['idrol']) { echo htmlspecialchars($r['nombrerol']); break; }
                        }
                    ?>" readonly style="background-color: #f5f5f5; cursor: not-allowed; opacity: 0.7;">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="contra"><i class="bi bi-lock-fill"></i> Contraseña <small style="color:#aaa;">(dejar en blanco para mantener la actual)</small></label>
                <input type="password" name="contra" id="contra"
                       placeholder="Nueva contraseña (opcional)">
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy-fill"></i> Guardar Cambios
                </button>
                <?php if (isset($_SESSION['idrol']) && $_SESSION['idrol'] == 1): ?>
                    <a href="index.php?action=listUsuario" class="btn btn-back">
                        <i class="bi bi-arrow-left-circle"></i> Cancelar
                    </a>
                <?php else: ?>
                    <a href="index.php?action=dashBoardu" class="btn btn-back">
                        <i class="bi bi-arrow-left-circle"></i> Cancelar
                    </a>
                <?php endif; ?>
            </div>

        </form>

        <?php endif; ?>

    </div>
</div>

</body>
</html>