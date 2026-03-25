<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-people-fill"></i> Lista de Usuarios</h3>
      
        <div class="search-container">
            <form action="index.php?action=listUsuario" method="GET" class="search-form">
                <input type="hidden" name="action" value="listUsuario">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="numerodocumen" 
                        id="searchInput"
                        placeholder="Buscar por número de documento..." 
                        value="<?= htmlspecialchars($_GET['numerodocumen'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['numerodocumen']) && !empty($_GET['numerodocumen'])): ?>
                        <a href="index.php?action=listUsuario" class="clear-search" title="Limpiar búsqueda">
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
                    Filtrando por: <strong><?= htmlspecialchars($_GET['numerodocumen']); ?></strong>
                    <?php if (isset($usuario)): ?>
                        (<?= count($usuario); ?> resultado<?= count($usuario) != 1 ? 's' : ''; ?>)
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
        
        <?php if (isset($usuario) && count($usuario) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> Id Usuario</th>
                            <th><i class="bi bi-person"></i> Nombre Completo</th>
                            <th><i class="bi bi-envelope"></i> Correo</th>
                            <th><i class="bi bi-telephone"></i> Teléfono</th>
                            <th><i class="bi bi-credit-card"></i> N° Documento</th>
                            <th><i class="bi bi-file-text"></i> Tipo Doc.</th>
                            <th><i class="bi bi-gender-ambiguous"></i> Género</th>
                            <th><i class="bi bi-shield-check"></i> Rol</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $contador = 1;
                        foreach ($usuario as $user): 
                        ?>
                            <tr>
                                <td><?= $contador++; ?></td>
                                <td><?= htmlspecialchars($user["nombrecompleto"]); ?></td>
                                <td><?= htmlspecialchars($user["correoelectronic"]); ?></td>
                                <td><?= htmlspecialchars($user["telefono"]); ?></td>
                                <td><strong><?= htmlspecialchars($user["numerodocumen"]); ?></strong></td>
                                <td><?= htmlspecialchars($user["documento"]); ?></td>
                                <td>
                                    <?php if ($user["tipogenero"] == "Femenino"): ?>
                                        <span class="badge badge-success">
                                            <i class="bi bi-gender-female"></i> Femenino
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-info">
                                            <i class="bi bi-gender-male"></i> Masculino
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user["idrol"] == 1): ?>
                                        <span class="badge badge-admin">
                                            <i class="bi bi-shield-fill-check"></i> Administrador
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-client">
                                            <i class="bi bi-person-check"></i> Cliente
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=actualizarusuario&numerodocumen=<?= urlencode($user['numerodocumen']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar usuario">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deleteusuario" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar a <?= htmlspecialchars($user['nombrecompleto']); ?>?');">
                                            <input type="hidden" name="numerodocumen" value="<?= htmlspecialchars($user['numerodocumen']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar usuario">
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
                        No se encontraron usuarios con el documento <strong>"<?= htmlspecialchars($_GET['numerodocumen']); ?>"</strong>
                    <?php else: ?>
                        No hay usuarios registrados en el sistema.
                    <?php endif; ?>
                </p>
                <?php if (isset($_GET['numerodocumen']) && !empty($_GET['numerodocumen'])): ?>
                    <a href="index.php?action=listUsuario" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
                        <i class="bi bi-arrow-left"></i> Ver todos los usuarios
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