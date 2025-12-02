<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Salida</title>
<link rel="stylesheet" href="./views/vformularios.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
    <h3 class="text-center mb-3">Registro de Salida de Producto</h3>

    <form action="index.php?action=insertSalida" method="POST">

       

           <div>
      <label class="form-label">Producto</label>
<select class="form-select" name="idproducto">
    <option value="1">Loción Hugo Boss</option>
    <option value="2">Perfume CK One</option>
    <option value="3">Crema Nivea</option>
    <option value="4">Crema Pond's</option>
    
</select>
</div>
        <div class="mb-3">
            <label class="form-label">Fecha Salida</label>
            <input type="date" class="form-control" name="fechasalida">
        </div>

        <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="cantidad">
        </div>

        <div>
            <button>Guardar</button>
        </div>

    </form>

    <form action="index.php?action=dashBoard" method="POST" class="mt-3">
        <button type="submit">Dashboard</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

