<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Marca</title>
</head>
<body>
    <h1> Eliminar Marca</h1>

    <form action="index.php?action=deletemarca" method="POST">
        <input type="hidden" name="action" value="deletemarca">
        <label for="idmarca"> Id Marca :</label>
        <input type="text" name="idmarca" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($marcas) && count($marcas) > 0): ?>  

        <h2>Lista Marcas:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th> Marca </th>
                    
                   
                </tr>
            </thead>

            <tbody>
                <?php foreach ($marcas as $marca): ?>
                    <tr>
                        <td><?= $marca["idmarca"]; ?></td>
                        <td><?= $marca['marca']; ?></td>

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