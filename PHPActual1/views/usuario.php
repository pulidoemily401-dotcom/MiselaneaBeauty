<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="./views/vformularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div >
  <h3>Registro de Usuario</h3>

    
     <form action="index.php?action=insertUsuario" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombrecompleto">
        </div>

        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono">
        </div>

        <div>
      <label class="form-label">Tipo Documento</label>
<select class="form-select" name="tipo_documento">
    <option value="1">Registro Civil</option>
    <option value="2">Tarjeta de identidad</option>
    <option value="3">Cédula de Ciudadanía</option>
    <option value="4">Permiso por Protección Temporal</option>
    <option value="5">Cédula Extranjería</option>
    <option value="6">Visa</option>
     <option value="7">Pasaporte</option>
</select>
</div>

        <div class="mb-3">
            <label class="form-label">Número Documento</label>
            <input type="text" class="form-control" name="numero_documento">
        </div>

        <div class="mb-3">
            <label class="form-label">Género</label>
            <select class="form-select" name="tipo_genero">
                <option>Femenino</option>
                <option>Masculino</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select class="form-select" name="rol">
                <option>Usuario</option>
                <option>Proveedor</option>
                <option>Administrador</option>
            </select>
        </div>

<br>
<div>
        <button >Guardar</button>
</div>
    </form>

    
    <form action="index.php?action=dashBoard" method="POST" class="mt-3">
        <button type="submit" >Dashboard</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
