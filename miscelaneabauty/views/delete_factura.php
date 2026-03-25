<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Factura </title>
</head>
<body>
    <h1> Eliminar Factura</h1>

    <form action="index.php?action=deletefactura" method="POST">
        <input type="hidden" name="action" value="deletefactura">
        <label for="idfactura"> Id Factura :</label>
        <input type="text" name="idfactura" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($facturas) && count($facturas) > 0): ?>  

        <h2>Lista Facturas:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id Factura</th>
                    <th> Fecha y Hora</th>
                    <th> Numero Documento</th>
                     <th> Total Factura</th>
                   
                </tr>
            </thead>

            <tbody>
                <?php foreach ($facturas as $factura): ?>
                    <tr>
                        <td><?= $factura["idfactura"]; ?></td>
                        <td><?= $factura['fechayhora']; ?></td>
                        <td><?= $factura['numerodocumen']; ?></td>
                        <td><?= $factura['totalfactura']; ?></td>
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