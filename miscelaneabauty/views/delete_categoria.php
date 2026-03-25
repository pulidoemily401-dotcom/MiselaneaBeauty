<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Categoría</title>
</head>
<body>
    <h1> Eliminar Categoría </h1>

    <form action="index.php?action=openFormDelete" method="POST">
        <input type="hidden" name="action" value="openFormDelete">
       <label for="idcategoria">Id Categoria:</label>
<input type="text" name="idcategoria" required>

        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($categorias) && count($categorias) > 0): ?>  

        <h2>Lista de Categorías:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id Categoria</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria["idcategoria"]; ?></td>
                        <td><?= $categoria['nombre']; ?></td>
                        <td><?= $categoria['descripcion']; ?></td>
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
