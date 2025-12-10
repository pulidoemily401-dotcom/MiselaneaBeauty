
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Marca</title>

    <link rel="stylesheet" href="./views/vformularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="./views/visual.css">
</head>
<body>


        <h3 class="text-center mb-4">Registrar Marca</h3>

        <form action="index.php?action=insertMarca" method="POST">

            <div class="mb-3">
                <label class="form-label">Nombre de la Marca</label>
                <input type="text" class="form-control" name="marca" required>
            </div>

            <button type="submit" >Guardar</button>
        </form>

        <form action="index.php?action=dashBoard" method="POST" class="mt-3">
            <button type="submit" >Dashboard</button>
        </form>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
