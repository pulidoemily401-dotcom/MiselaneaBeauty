<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin | MISCELANEA BEAUTY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="views/css/admin.css">
</head>
<body>

<?php
if ($_SESSION["idrol"] !== 1) {
    header("Location: ../index.php?action=login");
    exit();
}

require_once "./config/database.php";
$dbNoti   = new Database();
$connNoti = $dbNoti->getConnection();

if (isset($_GET['action']) && $_GET['action'] === 'marcarNotificaciones') {
    header('Content-Type: application/json');
    try {
        $connNoti->exec("UPDATE notificacion SET visto = 1 WHERE visto = 0");
        echo json_encode(['ok' => true]);
    } catch (Exception $e) {
        echo json_encode(['ok' => false, 'msg' => $e->getMessage()]);
    }
    exit();
}

$stmtNoti = $connNoti->query("SELECT * FROM notificacion ORDER BY fechacreacion DESC LIMIT 50");
$notificaciones = $stmtNoti->fetchAll(PDO::FETCH_ASSOC);
$sinVer = count(array_filter($notificaciones, fn($n) => $n['visto'] == 0));
?>

<div class="admin-container">

    <aside class="sidebar">
        <h2 class="logo">MISCELANEA<br>BEAUTY</h2>
        <nav>
            <a href="../index.php?action=logout" class="logout">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </a>
        </nav>
    </aside>

    <main class="main-content">

        <header class="top-bar">
            <h1>PANEL DE CONTROL</h1>
            <div class="user-info" style="display:flex;align-items:center;gap:1rem;">
                <button class="notif-btn" onclick="abrirNotificaciones()" title="Notificaciones">
                    <i class="bi bi-bell-fill"></i>
                    <?php if ($sinVer > 0): ?>
                        <span class="notif-badge" id="notifBadge"><?= $sinVer ?></span>
                    <?php endif; ?>
                </button>
                <div class="user-avatar">
                    <?php
                    $nombres = explode(' ', $_SESSION["nombrecompleto"]);
                    echo strtoupper(substr($nombres[0], 0, 1));
                    if (isset($nombres[1])) echo strtoupper(substr($nombres[1], 0, 1));
                    ?>
                </div>
                <span class="user-name"><?= $_SESSION["nombrecompleto"] ?></span>
            </div>
        </header>

        <section class="welcome">
            <h2>Administración del Sistema</h2>
            <p>Bienvenido al panel de control de MISCELANEA BEAUTY. Desde aquí puedes gestionar todos los aspectos de tu negocio de manera eficiente.</p>

            <div class="cards-section-title">Gestión Principal</div>
            <div class="quick-actions">
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-people"></i><span>Usuario</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertUsuario&origen=admin"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listUsuario"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-box-seam"></i><span>Producto</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertProducto"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listProducto"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-tags"></i><span>Categoría</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertCategoria"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listCategoria"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-award"></i><span>Marca</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertMarca"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listMarca"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
            </div>

            <div class="cards-section-title">Configuración</div>
            <div class="quick-actions">
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-shield-lock"></i><span>Rol</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertRol"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listRol"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-file-earmark-text"></i><span>Tipo Documento</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertIdtipodocu"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listTipoDocum"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
            </div>

            <div class="cards-section-title">Ventas &amp; Facturación</div>
            <div class="quick-actions">
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-receipt"></i><span>Factura</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertFactura"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listFactura"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-list-check"></i><span>Detalle Factura</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertDetalle"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listDetalle"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
            </div>

            <div class="cards-section-title">Inventario</div>
            <div class="quick-actions">
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-box-arrow-in-down"></i><span>Entrada</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertEntrada"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listentrada"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-box-arrow-up"></i><span>Salida</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertSalida"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listsalida"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
                <div class="quick-card">
                    <button class="quick-card-btn">
                        <div class="quick-card-left"><i class="bi bi-arrow-counterclockwise"></i><span>Devolución</span></div>
                        <i class="bi bi-chevron-down quick-chevron"></i>
                    </button>
                    <div class="quick-submenu">
                        <a href="../index.php?action=insertDevolucion"><i class="bi bi-plus-circle"></i> Insertar</a>
                        <a href="../index.php?action=listDevolucion"><i class="bi bi-list-ul"></i> Listar</a>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>

<!-- OVERLAY -->
<div class="notif-overlay" id="notifOverlay" onclick="cerrarNotificaciones()"></div>

<!-- DRAWER NOTIFICACIONES -->
<div class="notif-drawer" id="notifDrawer">
    <div class="notif-drawer-header">
        <h3><i class="bi bi-bell-fill"></i> Notificaciones de Compra</h3>
        <button class="notif-close" onclick="cerrarNotificaciones()"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="notif-list" id="notifList">
        <?php if (empty($notificaciones)): ?>
            <div class="notif-empty">
                <i class="bi bi-bell-slash"></i>
                <p>No hay notificaciones aún</p>
            </div>
        <?php else: ?>
            <?php foreach ($notificaciones as $n): ?>
            <div class="notif-item <?= $n['visto'] == 0 ? 'nueva' : '' ?>">
                <?php if ($n['visto'] == 0): ?>
                    <span class="notif-tag-nueva">Nueva</span>
                <?php endif; ?>
                <div class="notif-top">
                    <i class="bi bi-bag-check-fill"></i>
                    <span class="notif-cliente"><?= htmlspecialchars($n['cliente']) ?></span>
                </div>
                <div class="notif-info">
                    <i class="bi bi-receipt"></i> Factura #<?= htmlspecialchars($n['idfactura']) ?>
                    &nbsp;·&nbsp;
                    <i class="bi bi-person-vcard"></i> Doc: <?= number_format($n['numerodocumen'], 0, ',', '.') ?>
                </div>
                <div class="notif-info">
                    <i class="bi bi-bag"></i> <?= htmlspecialchars($n['productos']) ?>
                </div>
                <div class="notif-total">$<?= number_format($n['total'], 0, ',', '.') ?></div>
                <div>
                    <span class="notif-metodo">
                        <i class="bi bi-credit-card"></i>
                        <?= ucfirst(htmlspecialchars($n['metodopago'])) ?>
                    </span>
                </div>
                <div class="notif-fecha">
                    <i class="bi bi-clock"></i>
                    <?= date('d/m/Y H:i', strtotime($n['fechacreacion'])) ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if (!empty($notificaciones) && $sinVer > 0): ?>
    <div class="notif-footer" id="notifFooter">
        <button class="btn-marcar-todas" onclick="marcarTodas()">
            <i class="bi bi-check-all"></i> Marcar todas como vistas
        </button>
    </div>
    <?php endif; ?>
</div>

<script>
function abrirNotificaciones() {
    document.getElementById('notifDrawer').classList.add('show');
    document.getElementById('notifOverlay').classList.add('show');
}
function cerrarNotificaciones() {
    document.getElementById('notifDrawer').classList.remove('show');
    document.getElementById('notifOverlay').classList.remove('show');
}
function marcarTodas() {
    fetch('../index.php?action=marcarNotificaciones')
        .then(r => r.json())
        .then(data => {
            if (data.ok) {
                document.querySelectorAll('.notif-item.nueva').forEach(el => {
                    el.classList.remove('nueva');
                    const tag = el.querySelector('.notif-tag-nueva');
                    if (tag) tag.remove();
                });
                const badge = document.getElementById('notifBadge');
                if (badge) badge.remove();
                const footer = document.getElementById('notifFooter');
                if (footer) footer.remove();
            }
        })
        .catch(() => alert('Error al marcar notificaciones'));
}

document.querySelectorAll('.quick-card-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const submenu = btn.nextElementSibling;
        const isOpen  = submenu.classList.contains('show');
        document.querySelectorAll('.quick-submenu').forEach(s => s.classList.remove('show'));
        document.querySelectorAll('.quick-card-btn').forEach(b => b.classList.remove('active'));
        if (!isOpen) {
            submenu.classList.add('show');
            btn.classList.add('active');
        }
    });
});

const createMobileToggle = () => {
    if (window.innerWidth <= 1024) {
        if (document.querySelector('.mobile-toggle')) return;
        const toggle = document.createElement('button');
        toggle.className = 'mobile-toggle';
        toggle.innerHTML = '<i class="bi bi-list"></i>';
        document.body.appendChild(toggle);
        toggle.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    }
};
createMobileToggle();
window.addEventListener('resize', createMobileToggle);
</script>

</body>
</html>