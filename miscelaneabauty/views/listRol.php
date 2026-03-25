<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Roles | MISCELANEA BEAUTY</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/vformularios.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    
    <div class="results-section fade-in">
        
        <h3><i class="bi bi-person-badge-fill"></i> Lista de Roles</h3>
      
        <div class="search-container">
            <form action="index.php?action=listRol" method="GET" class="search-form">
                <input type="hidden" name="action" value="listRol">
                
                <div class="search-input-wrapper">
                    <i class="bi bi-search"></i>
                    <input 
                        type="text" 
                        name="nombrerol" 
                        id="searchInput"
                        placeholder="Buscar por nombre de rol..." 
                        value="<?= htmlspecialchars($_GET['nombrerol'] ?? ''); ?>"
                        class="search-input"
                    >
                    
                    <?php if (isset($_GET['nombrerol']) && !empty($_GET['nombrerol'])): ?>
                        <a href="index.php?action=listRol" class="clear-search" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            
            <?php if (isset($_GET['nombrerol']) && !empty($_GET['nombrerol'])): ?>
                <div class="search-results-info">
                    <i class="bi bi-funnel-fill"></i>
                    Filtrando por: <strong><?= htmlspecialchars($_GET['nombrerol']); ?></strong>
                    <?php if (isset($rol)): ?>
                        (<?= count($rol); ?> resultado<?= count($rol) != 1 ? 's' : ''; ?>)
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
        
        <?php if (isset($rol) && count($rol) > 0): ?>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-person-badge"></i> Nombre Rol</th>
                            <th><i class="bi bi-gear"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rol as $ro): ?>
                            <tr>
                                <td><?= htmlspecialchars($ro["idrol"]); ?></td>
                                <td><strong><?= htmlspecialchars($ro["nombrerol"]); ?></strong></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?action=editarrol&id=<?= urlencode($ro['idrol']); ?>" 
                                           class="btn-action btn-update"
                                           title="Actualizar rol">
                                            <i class="bi bi-pencil-square"></i> Actualizar
                                        </a>
                                        
                                        <form action="index.php?action=deleterol" 
                                              method="post" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar el rol <?= htmlspecialchars($ro['nombrerol']); ?>?');">
                                            <input type="hidden" name="idrol" value="<?= htmlspecialchars($ro['idrol']); ?>">
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    title="Eliminar rol">
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
                    <?php if (isset($_GET['nombrerol']) && !empty($_GET['nombrerol'])): ?>
                        No se encontraron roles con el nombre <strong>"<?= htmlspecialchars($_GET['nombrerol']); ?>"</strong>
                    <?php else: ?>
                        No hay roles registrados en el sistema.
                    <?php endif; ?>
                </p>
                <?php if (isset($_GET['nombrerol']) && !empty($_GET['nombrerol'])): ?>
                    <a href="index.php?action=listRol" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
                        <i class="bi bi-arrow-left"></i> Ver todos los roles
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