<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>

    <link rel="stylesheet" href="./views/visual.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<h3 class="text-center mb-4 mt-3">Registro de Usuario</h3>



    <label for="nombre" id="nom" >Nombre</label>
    <input type="text" name="nombrecompleto" require><br>

    <label for="email" >Correo electrónico</label>
    <input type="email" name="email" require><br>

    <label for="telefono" >Teléfono</label>
    <input type="text" name="telefono" require><br>

    <label for="numero_documento">Número Documento</label>
    <input type="text"  name="numero_documento" require><br>

    <label for="tipo_genero">Género</label>
    <select class="form-select mb-3" name="tipo_genero">
        <option>Femenino</option>
        <option>Masculino</option>
    </select>

    <label for="password">Contraseña</label>
    <input type="password" name="password" require><br>

    <label for="rol">Rol</label>
    <select class="form-select mb-3" name="rol">
        <option>Usuario</option>
        <option>Proveedor</option>
        <option>Administrador</option>
    </select>

    <label for="email">Tipo Documento</label>
    <input type="text" class="form-control mb-3" name="tipo_documento">

    <button class="btn btn-primary btn-lg w-100">Guardar</button>

</form>

<form action="index.php?action=dashBoard" method="POST" class="p-3">
    <button type="submit" class="btn btn-secondary w-100">Dashboard</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
