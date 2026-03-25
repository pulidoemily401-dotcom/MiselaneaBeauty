<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Devolucion</title>
</head>
<body>
    <h1> Eliminar Devolución </h1>

    <form action="index.php?action=deletedevolucion" method="POST">
        <input type="hidden" name="action" value="deletedevolucion">
        <label for="iddevolucion"> Id Devolución :</label>
        <input type="text" name="iddevolucion" required>
        <input type="submit" value="Eliminar">
    </form>

    <?php if (isset($devoluciones) && count($devoluciones) > 0): ?>  

        <h2>Lista Devolución:</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Id Devolución</th>
                    <th> Id Producto</th>
                    <th> Descripción</th>
                    <th> Cantidad </th>
                    <th> Id Factura </th>
                     <th> Fecha Ingreso</th>
                   
                </tr>
            </thead>

            <tbody>
                <?php foreach ($devoluciones as $devolucion): ?>
                    <tr>
                        <td><?= $devolucion["iddevolucion"]; ?></td>
                        <td><?= $devolucion['idproducto']; ?></td>
                          <td><?= $devolucion['descripcionmotivo']; ?></td>
                        <td><?= $devolucion['idfactura']; ?></td>
                        <td><?= $devolucion['cantidad']; ?></td>
                        <td><?= $devolucion['fechaingreso']; ?></td>
                      
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