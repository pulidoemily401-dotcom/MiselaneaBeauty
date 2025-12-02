<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Factura</title>
    <link rel="stylesheet" href="./views/vformularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
  <h3>Registro de Factura</h3>

  <form action="index.php?action=insertFactura" method="POST">

      <div>
      <label class="form-label">Usuario</label>
<select class="form-select" name="numerodocumen">
    <option value="124566">Veronica Galindo</option>
    <option value="125431">Pedro Pascal</option>
    <option value="125431">Sara Galindo</option>
    <option value="144466">Rocio Pulido</option>
     <option value="234234">Camilo Fuentes</option>
    <option value="234456">Valeria Sanchez</option>
    <option value="234994">Mishel Arias</option>
    <option value="443212">Sandra Ramirez</option>
    
</select>
</div>

      <div class="mb-3">
          <label class="form-label">Fecha y Hora</label>
          <input type="datetime-local" class="form-control" name="fechayhora">
      </div>

      <div class="mb-3">
          <label class="form-label">Total Factura</label>
          <input type="text" class="form-control" name="totalfactura">
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
