<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MISELANEA BEAUTY | Login</title>
 <link rel="stylesheet" href="views/css/login.css">


</head>
<body>
<form action="index.php?action=ingreso" method="post">

    <h3>MISELANEA BEAUTY</h3>
    <h3>Iniciar sesión</h3>

    <input type="email" name="correoelectronic" placeholder="Correo electrónico" required>

    <input type="password" name="contra" placeholder="Contraseña" required>

    <div class="forgot-password">
        <a href="index.php?action=enviarRecuperacion">¿Olvidaste tu contraseña?</a>
    </div>

    <input type="submit" value="Entrar">

</form>

<p>¿No tienes cuenta?
    <a href="index.php?action=insertUsuario">Regístrate aquí</a>
</p>


</body>
</html>

