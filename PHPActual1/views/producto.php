<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Producto</title>
    <link rel="stylesheet" href="./views/vformularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
    <h3 class="text-center mb-3">Registro de Producto</h3>

    <form action="index.php?action=insertProducto" method="POST" enctype="multipart/form-data">


        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion"></textarea>
        </div>


            <div>
      <label class="form-label">Marca</label>
<select class="form-select" name="idmarca">
    <option value="1">Nivea</option>
    <option value="2">Pond's</option>
    <option value="3">Hugo Boss</option>
    <option value="4">Calvin Klein</option>
   
</select>
</div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio Venta</label>
            <input type="number" step="0.01" class="form-control" name="precio">
        </div>


        <div>
      <label class="form-label">Categoría</label>
<select class="form-select" name="idcategoria">
    <option value="1">Lociones</option>
    <option value="2">Cremas corporales </option>
    <option value="3">Shampoo</option>
    <option value="4">Acondicionador</option>
    <option value="5">Desodorante</option>
    <option value="6">Jabones de tocador</option>
    <option value="7">Maquillaje básico</option>
    <option value="8">Accesorios de cuidado personal</option>
    <option value="9">Productos para bebé</option>
    <option value="10"> Artículos de regalo </option>
</select>
</div>

 <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input type="number" class="form-control" name="cantidad">
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock">
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha Ingreso</label>
            <input type="date" class="form-control" name="fechaingreso">
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


