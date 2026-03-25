<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
</head>
<body>
    <h1> Eliminar Producto</h1>

    <form action="index.php?action=deleteproducto" method="POST">
        <input type="hidden" name="action" value="deleteproducto">
        <label for="idproducto"> Id Producto :</label>
        <input type="text" name="idproducto" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($productos) && count($productos) > 0): ?>  

        <h2>Lista Productos:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id Producto</th>
                    <th> Nombre </th>
                     <th>Precio</th>
                     <th>Descripción</th>
                    <th> Imagen </th>
                     <th>Id Categoria</th>
                    <th> Stock </th>
                     <th>Fecha Ingreso</th>
                    <th> Id Marca </th>
                    
                </tr>
            </thead>

            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto["idproducto"]; ?></td>
                        <td><?= $producto['nombre']; ?></td>
                        <td><?= $producto["precio"]; ?></td>
                        <td><?= $producto["descripcion"]; ?></td>
                        <td><?= $producto['imagen']; ?></td>
                        <td><?= $producto["idcategoria"]; ?></td>
                        <td><?= $producto['stock']; ?></td>
                        <td><?= $producto["fechaingreso"]; ?></td>
                        <td><?= $producto['idmarca']; ?></td>

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