<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="views/css/contraseña.css">
</head>
<body>
    <div class="container">
        <div class="icon">🔐</div>
        <h2>Recuperar Contraseña</h2>
        <p class="subtitle">Te enviaremos un enlace para restablecer tu contraseña</p>
        <form id="formRecuperar">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input 
                    type="email" 
                    id="email" 
                    name="correoelectronic" 
                    placeholder="ejemplo@correo.com" 
                    required
                    autocomplete="email"
                >
            </div>
            <button type="submit" id="btnEnviar">
                Enviar enlace de recuperación
            </button>
        </form>
        <div class="back-link">
            <a href="index.php?action=login">← Volver al inicio de sesión</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <script>
        const EMAILJS_PUBLIC_KEY  = '62-ynGRwl0nfDrBrP';
        const EMAILJS_SERVICE_ID  = 'service_zt453pr';
        const EMAILJS_TEMPLATE_ID = 'template_lrozi0f';

        emailjs.init(EMAILJS_PUBLIC_KEY);

        document.getElementById('formRecuperar').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const btn   = document.getElementById('btnEnviar');

            btn.disabled  = true;
            btn.innerHTML = 'Enviando<span class="loading"></span>';

            try {
                const response = await fetch('index.php?action=generarToken', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'correoelectronic=' + encodeURIComponent(email)
                });

                const data = await response.json();

                if (data.success) {
                    const base = window.location.href.replace(/\/[^\/]*$/, '/');
                    const resetLink = base + 'index.php?action=nuevaClave&token=' + data.token;

                    await emailjs.send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, {
                        to_email:   email,
                        reset_link: resetLink
                    });

                    alert('✅ Correo enviado exitosamente! Revisa tu bandeja de entrada.');
                    window.location = 'index.php?action=login';

                } else {
                    alert('❌ ' + data.message);
                }

            } catch (error) {
                console.error('Error:', error);
                alert('❌ Error al enviar el correo. Por favor intenta de nuevo.');
            } finally {
                btn.disabled  = false;
                btn.innerHTML = 'Enviar enlace de recuperación';
            }
        });
    </script>
</body>
</html>