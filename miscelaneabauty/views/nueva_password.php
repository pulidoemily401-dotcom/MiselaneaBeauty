<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
   <link rel="stylesheet" href="views/css/nuevacon.css">
</head>
<body>
    <div class="container">
        <div class="icon">🔑</div>
        <h2>Nueva Contraseña</h2>
        <p class="subtitle">Crea una contraseña segura para tu cuenta</p>
        
        <div class="info">
            ℹ️ Tu contraseña debe tener al menos 6 caracteres.
        </div>

        <form action="index.php?action=guardarNuevaClave" method="post" id="formPassword">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? ''); ?>">
            
            <div class="form-group">
                <label for="nueva">Nueva Contraseña</label>
                <input 
                    type="password" 
                    id="nueva" 
                    name="nueva" 
                    placeholder="Ingresa tu nueva contraseña" 
                    required 
                    minlength="6"
                >
                <span class="toggle-password" onclick="togglePassword('nueva')"></span>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="confirmar">Confirmar Contraseña</label>
                <input 
                    type="password" 
                    id="confirmar" 
                    name="confirmar" 
                    placeholder="Confirma tu nueva contraseña" 
                    required 
                    minlength="6"
                >
                <span class="toggle-password" onclick="togglePassword('confirmar')"></span>
                <div class="error-message" id="errorMessage">
                    ❌ Las contraseñas no coinciden
                </div>
            </div>

            <button type="submit">Guardar Nueva Contraseña</button>
        </form>
    </div>

    <script>
        // Toggle mostrar/ocultar contraseña
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.type === 'password' ? 'text' : 'password';
            field.type = type;
        }

        // Validar fortaleza de contraseña
        document.getElementById('nueva').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBar = document.getElementById('strengthBar');
            
            // Resetear
            strengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                return;
            }
            
            // Calcular fortaleza
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            // Aplicar clase
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 3) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });

        // Validar que las contraseñas coincidan
        document.getElementById('formPassword').addEventListener('submit', function(e) {
            const nueva = document.getElementById('nueva').value;
            const confirmar = document.getElementById('confirmar').value;
            const errorMessage = document.getElementById('errorMessage');
            
            if (nueva !== confirmar) {
                e.preventDefault();
                errorMessage.style.display = 'block';
                document.getElementById('confirmar').style.borderColor = '#f44336';
                alert('❌ Las contraseñas no coinciden');
            } else {
                errorMessage.style.display = 'none';
                document.getElementById('confirmar').style.borderColor = '#e0e0e0';
            }
        });

        // Ocultar mensaje de error cuando el usuario escribe
        document.getElementById('confirmar').addEventListener('input', function() {
            document.getElementById('errorMessage').style.display = 'none';
            this.style.borderColor = '#e0e0e0';
        });
    </script>
</body>
</html>