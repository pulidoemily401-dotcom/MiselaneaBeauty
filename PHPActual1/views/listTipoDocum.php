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
                <th>Id Tipo De Documento</th>
                <th>Documento</th>
                
           
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipo as $ti):?>
                <tr>
                    <td><?= $ti["idtipo"]; ?></td> 
                    <td><?= $ti["documento"]; ?></td> 
                     
                     
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>

<form action="index.php?action=dashBoard" method="post">
        <button type="submit" name="action" value="dashBoard" class="btn btn-primary">dashboard</button>
    </form>
</body>
</html>