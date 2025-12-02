<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Buscar Usuarios por Documento</h1>
<form action="index.php?action=listUsuario" method="get">
    <input type="hidden" name="action" value="listUsuario">
    <label for="numerodocumen">Numero De Documento</label>
    <input type="text" name="numerodocumen" required>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($usuario) && count($usuario) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Correo Electronico</th>
                <th>Telefono</th>
                <th>Numero De Documento</th>
                <th>Tipo De Genero</th>
                <th>Contraseña </th>
                <th>Rol</th>
                <th>Tipo De Documento</th>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuario as $user):?>
                <tr>
                    <td><?= $user["nombrecompleto"]; ?></td> 
                    <td><?= $user["correoelectronic"]; ?></td> 
                    <td><?= $user["telefono"]; ?></td> 
                    <td><?= $user["numerodocumen"]; ?></td> 
                    <td><?= $user["tipogenero"]; ?></td>
                    <td><?= $user["contra"]; ?></td>
                    <td><?= $user["rol"]; ?></td>
                    <td><?= $user["idtipo"]; ?></td>
                 
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($usuario)):?>
    <p>No se encontraron usuarios con ese nombre</p>
<?php endif; ?>
<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard">dashboard</button>
    </form>
</body>
</html>