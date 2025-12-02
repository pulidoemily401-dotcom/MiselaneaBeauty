<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Buscar Producto por Nombre</h1>
<form action="index.php?action=listProducto" method="get">
    <input type="hidden" name="action" value="listProducto">
    <label for="m">Nombre Producto</label>
    <input type="text" name="nombre" required>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($producto) && count($producto) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>precio</th>
                <th>cantidad</th>
                <th>Nombre</th>
                <th>descripcion</th>
                <th>$idcategoria</th>
                <th>Stock</th>
                <th>Fecha De Ingreso</th>
                <th>Id Marca</th>
                 <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($producto as $prod):?>
                <tr>
                    <td><?= $prod["precio"]; ?></td> 
                    <td><?= $prod["cantidad"]; ?></td> 
                    <td><?= $prod["nombre"]; ?></td> 
                    <td><?= $prod["descripcion"]; ?></td> 
                    <td><?= $prod["idcategoria"]; ?></td>
                    <td><?= $prod["stock"]; ?></td>
                    <td><?= $prod["fechaingreso"]; ?></td>
                    <td><?= $prod["idmarca"]; ?></td>
                    <td><img src="photo/<?= $prod["imagen"]; ?>" width="200" alt="Foto"></td>  
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($producto)):?>
    <p>No se encontraron usuarios con ese nombre</p>
<?php endif; ?>
<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard">dashboard</button>
    </form>
</body>
</html>