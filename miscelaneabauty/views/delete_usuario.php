<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
</head>
<body>
    <h1>Eliminar Usuario</h1>

    <form action="index.php?action=deleteusuario" method="POST">
        <input type="hidden" name="action" value="deleteusuario">
        <label for="numerodocumen">Número de Documento:</label>
        <input type="text" name="numerodocumen" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($usuarios) && count($usuarios) > 0): ?>  

        <h2>Lista de Usuarios:</h2>

        <table border="1">
    <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Número Documento</th>
            <th>Tipo Género</th>
            <th>Tipo Documento</th>
            <th>Rol</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
               
                <td><?= $usuario["nombrecompleto"] ?></td>
                <td><?= $usuario["correoelectronic"] ?></td>
                <td><?= $usuario["telefono"] ?></td>
                <td><?= $usuario["numerodocumen"] ?></td>
                <td><?= $usuario["tipogenero"] ?></td>
                <td><?= $usuario["documento"] ?></td>
                <td><?= $usuario["nombrerol"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    <?php endif; ?>

    <form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard" class="btn btn-primary">DashBoard</button>
    </form>

</body>
</html>
