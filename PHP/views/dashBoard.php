<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./views/visual.css">
</head>
<body>
    <section class="Usuario" >
        <h1> DashBoard </h1>
        
        <form action="index.php?action=insertUsuario" method="GET">
        <button type="submit" name="action" value="insertUsuario" class="btn"> Ingresar Usuario </button>
        </form>

        <form action="index.php?action=insertDevolucion" method="GET">
        <button type="submit" name="action" value="insertDevolucion" class="btn"> Ingresar Devolución </button>
        </form>

         <form action="index.php?action=insertDetalle" method="GET">
        <button type="submit" name="action" value="insertDetalle" class="btn"> Ingresar Detalle de Factura </button>
        </form>

        <form action="index.php?action=insertCategoria" method="GET">
        <button type="submit" name="action" value="insertCategoria" class="btn"> Ingresar la Categoria </button>
        </form>

         <form action="index.php?action=insertEntrada" method="GET">
        <button type="submit" name="action" value="insertEntrada" class="btn"> Ingresar la Entrada </button>
        </form>

        <form action="index.php?action=insertProducto" method="GET">
        <button type="submit" name="action" value="insertProducto" class="btn"> Ingresar el Producto </button>
        </form>

         <form action="index.php?action=insertFactura" method="GET">
        <button type="submit" name="action" value="insertFactura" class="btn"> Ingresar la Factura</button>
        </form>

         <form action="index.php?action=insertIdtipodocu" method="GET">
        <button type="submit" name="action" value="insertIdtipodocu" class="btn"> Ingresar Tipo Documento</button>
        </form>

</body>
</html>