<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./views/formularioContacto.css">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Id Categoria</th>
                <th>Nombre</th>
                <th>Descripcion</th>
           
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoria as $cate):?>
                <tr>
                    <td><?= $cate["idcategoria"]; ?></td> 
                    <td><?= $cate["nombre"]; ?></td> 
                     <td><?= $cate["descripcion"]; ?></td>
                   
                     
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>

<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard" class="btn btn-primary">dashboard</button>
    </form>
</body>
</html>