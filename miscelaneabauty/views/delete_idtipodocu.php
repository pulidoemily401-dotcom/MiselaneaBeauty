<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Tipo Documento</title>
</head>
<body>
    <h1> Eliminar Tipo Documento</h1>

    <form action="index.php?action=deleteidtipodocu" method="POST">
        <input type="hidden" name="action" value="deleteidtipodocu">
        <label for="idtipo"> Id Tipo Documento :</label>
        <input type="text" name="idtipo" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($tipos) && count($tipos) > 0): ?>  

        <h2>Lista Documentos:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th> Tipo Documento </th>
                    
                   
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tipos as $tipo): ?>
                    <tr>
                        <td><?= $tipo["idtipo"]; ?></td>
                        <td><?= $tipo['documento']; ?></td>

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