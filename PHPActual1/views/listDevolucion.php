<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>

<h1>Buscar Devolucion por el id de la factura</h1>
<form action="index.php?action=listDevolucion" method="post">
    <input type="hidden" name="action" value="listDevolucion">
    <label for="idfactura">Numero de Factura:</label>
    <input type="text" name="idfactura" required>
    <input type="submit" value="Buscar">
</form>


<?php if (isset($devolucion) && count($devolucion) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Id De Devolucion</th>
                <th>Id De Producto</th>
                 <th>Cantidad</th>
                <th>Fecha De Devolucion</th>
                <th>Id De Factura</th>
                <th>Motivo De Devolucion</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devolucion as $devolu):?>
                <tr>
                    <td><?= $devolu["iddevolucion"]; ?></td> 
                    <td><?= $devolu["idproducto"]; ?></td> 
                    <td><?= $devolu["cantidad"]; ?></td> 
                    <td><?= $devolu["fechaingreso"]; ?></td>
                    <td><?= $devolu["idfactura"]; ?></td>
                    <td><?= $devolu["descripcionmotivo"]; ?></td>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($devolucion)):?>
    <p>No se encontro devoluciones con ese id de factura</p>
<?php endif; ?>
<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard" class="btn btn-primary">dashboard</button>
    </form>
</body>
</html>