<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Buscar Factura por Id De Usuario</h1>
<form action="index.php?action=listFactura" method="get">
    <input type="hidden" name="action" value="listFactura">
    <label for="idusuario">Id De Usuario</label>
    <input type="text" name="idusuario" required>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($factura) && count($factura) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Id De Factura</th>
                <th>Fecha y Hora</th>
                <th>Id De Usuario</th>
                <th>Total De la Factura</th>
            
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($factura as $fact):?>
                <tr>
                    <td><?= $fact["idfactura"]; ?></td> 
                    <td><?= $fact["fechayhora"]; ?></td> 
                    <td><?= $fact["numerodocumen"]; ?></td> 
                    <td><?= $fact["totalfactura"]; ?></td> 
                 
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($factura)):?>
    <p>No se encontro factura con ese Id de usuario</p>
<?php endif; ?>
<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard">dashboard</button>
    </form>
</body>
</html>