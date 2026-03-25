<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Entrada </title>
</head>
<body>
    <h1> Eliminar Entrada Producto</h1>

    <form action="index.php?action=deleteentrada" method="POST">
        <input type="hidden" name="action" value="deleteentrada">
        <label for="identrada"> Id Entrada :</label>
        <input type="text" name="identrada" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($entradas) && count($entradas) > 0): ?>  

        <h2>Lista Entradas:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id Entrada</th>
                    <th> Id Producto</th>
                    <th> Numero Documento</th>
                     <th> Cantidad</th>
                    <th> Fecha Entrada</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($entradas as $entrada): ?>
                    <tr>
                        <td><?= $entrada["identrada"]; ?></td>
                        <td><?= $entrada['idproducto']; ?></td>
                        <td><?= $entrada['numerodocumen']; ?></td>
                        <td><?= $entrada['cantidad']; ?></td>
                        <td><?= $entrada['fechaentrada']; ?></td>
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