<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar salida</title>
</head>
<body>
    <h1> Eliminar Salida</h1>

    <form action="index.php?action=deletesalida" method="POST">
        <input type="hidden" name="action" value="deletesalida">
        <label for="idsalida"> Id Salida :</label>
        <input type="text" name="idsalida" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($salidas) && count($salidas) > 0): ?>  

        <h2>Lista Salida:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id Salida</th>
                    <th> Id prducto </th>
                     <th>Fecha Salida</th>
                    <th> Cantidad </th>
                    
                </tr>
            </thead>

            <tbody>
                <?php foreach ($salidas as $salida): ?>
                    <tr>
                        <td><?= $salida["idsalida"]; ?></td>
                        <td><?= $salida['idproducto']; ?></td>
                        <td><?= $salida["fechasalida"]; ?></td>
                        <td><?= $salida['cantidad']; ?></td>
                     

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