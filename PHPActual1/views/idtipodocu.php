<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Tipo Documento</title>
    <link rel="stylesheet" href="./views/vformularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
  <h3>Registro Tipo de Documento</h3>

  <form action="index.php?action=insertIdtipodocu" method="POST">

      <div class="mb-3">
          <label class="form-label">Documento</label>
          <input type="text" class="form-control" name="documento">
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
