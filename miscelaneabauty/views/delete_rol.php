<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Rol</title>
</head>
<body>
    <h1> Eliminar Rol</h1>

    <form action="index.php?action=deleterol" method="POST">
        <input type="hidden" name="action" value="deleterol">
        <label for="idrol"> Id Rol :</label>
        <input type="text" name="idrol" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($roles) && count($roles) > 0): ?>  

        <h2>Lista Rol:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id rol</th>
                    <th> Nombre Rol </th>
                    
                   
                </tr>
            </thead>

            <tbody>
                <?php foreach ($roles as $rol): ?>
                    <tr>
                        <td><?= $rol["idrol"]; ?></td>
                        <td><?= $rol['nombrerol']; ?></td>

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