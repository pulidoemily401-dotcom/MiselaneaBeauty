<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Buscar Entrada por id de usuario</h1>
<form action="index.php?action=listentrada" method="get">
    <input type="hidden" name="action" value="listentrada">
    <label for="numerodocumen">id de usuario</label>
    <input type="text" name="numerodocumen" required>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($entrada) && count($entrada) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>id entrada</th>
                <th>id de producto</th>
                <th>id de usuario</th>
                <th>cantidad</th>
                <th>fecha entrada</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entrada as $entra):?>
                <tr>
                    <td><?= $entra["identrada"]; ?></td> 
                    <td><?= $entra["idproducto"]; ?></td> 
                    <td><?= $entra["numerodocumen"]; ?></td> 
                    <td><?= $entra["cantidad"]; ?></td> 
                    <td><?= $entra["fechaentrada"]; ?></td>
                      
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($entrada)):?>
    <p>No se encontraron entradas con ese id de usuario</p>
<?php endif; ?>
<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard">dashboard</button>
    </form>
</body>
</html>