<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./views/formularioContacto.css">
    <title>Document</title>
</head>
<body>

<h1>Buscar Marca</h1>
<form action="index.php?action=listMarca" method="get">
    <input type="hidden" name="action" value="listMarca">
    <label for="marca">Marca</label>
    <input type="text" name="marca" required>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($marca) && count($marca) >0):?>
    <h2>Resultado de la busqueda:</h2>
    <table border="1">  
        <thead>
            <tr>
                <th>Id Tipo De Marca</th>
                <th>Marca</th>
                
           
            </tr>
        </thead>
        <tbody>
            <?php foreach ($marca as $mar):?>
                <tr>
                    <td><?= $mar["idmarca"]; ?></td> 
                    <td><?= $mar["marca"]; ?></td> 
                     
                     
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php elseif (isset($marca)):?>
    <p>No se encontraron usuarios con ese nombre</p>
<?php endif; ?>

<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard" class="btn btn-primary">dashboard</button>
    </form>
</body>
</html>