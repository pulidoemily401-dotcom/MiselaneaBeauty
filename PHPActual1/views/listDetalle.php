<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table border="1">
        <thead>
            <tr>
                <th>iddetallefactura</th>
                <th>idfactura</th>
                <th>idproducto</th>
                <th>cantidad</th>
                <th>preciouni</th>
                <th>valortotalcadapro</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Detalle as $deta):?>
                <tr>
                    <td><?= $deta["iddetallefactura"]; ?></td> 
                    <td><?= $deta["idfactura"]; ?></td> 
                    <td><?= $deta["idproducto"]; ?></td> 
                    <td><?= $deta["cantidad"]; ?></td> 
                    <td><?= $deta["preciouni"]; ?></td>
                    <td><?= $deta["valortotalcadapro"]; ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>

<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard">dashboard</button>
    </form>
</body>
</html>


