<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Categoría</title>
   <link rel="stylesheet" href="./views/vformularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
    <h3 class="text-center mb-3">Registro de Categoría</h3>

    <form action="index.php?action=insertCategoria" method="POST">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion">
        </div>

        <div>
            <button >Guardar</button>
        </div>

    </form>

    <form action="index.php?action=dashBoard" method="POST" class="mt-3">
        <button type="submit" >Dashboard</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
