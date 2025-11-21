<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Devolución</title>
    <link rel="stylesheet" href="./views/visual.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
  <h3>Registro de Devolución</h3>

  <form action="index.php?action=insertDevolucion" method="POST">


      <div class="mb-3">
          <label class="form-label">Cantidad</label>
          <input type="number" class="form-control" name="cantidad">
      </div>

      <div class="mb-3">
          <label class="form-label">Fecha de Ingreso</label>
          <input type="date" class="form-control" name="fechaingreso">
      </div>
   

      <div class="mb-3">
          <label class="form-label">Descripción</label>
          <input type="text" class="form-control" name="descripcionmotivo">
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
