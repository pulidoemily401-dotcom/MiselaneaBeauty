<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Buscar salida de  Producto por fecha</h1>
<form action="index.php?action=listsalida" method="get">
    <input type="hidden" name="action" value="listsalida">
    <label for="fechasalida">Fecha</label>
    <input type="text" name="fechasalida" required>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($salida) && count($salida) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>id de salida</th>
                <th>id Producto</th>
                <th>fecha salida</th>
                <th>cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salida as $sali):?>
                <tr>
                    <td><?= $sali["idsalida"]; ?></td> 
                    <td><?= $sali["idproducto"]; ?></td> 
                    <td><?= $sali["fechasalida"]; ?></td> 
                    <td><?= $sali["cantidad"]; ?></td> 
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($salida)):?>
    <p>No se encontraron salidas con esa fecha</p>
<?php endif; ?>
<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard">dashboard</button>
    </form>
</body>
</html>