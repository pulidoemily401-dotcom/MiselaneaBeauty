



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>

 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">




  <link rel="stylesheet" href="./views/visual.css">

</head>

<body>

  <div class="center-wrapper">
    <div class="wrapper-box">

    
      <div class="dashboard-header">
        <img src="img/logo.png" alt="Logo" class="dashboard-logo">
        <h1 class="dashboard-title">MISELANEA BEAUTY</h1>
      </div>

      
      <div class="button-column">

       
        <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#usuarioMenu">
          <i class="bi bi-person-fill"></i>
          <span>Usuario</span>
        </button>

        <div id="usuarioMenu" class="collapse">

          <form action="index.php?action=insertUsuario" method="get">
            <button type="submit" name="action" value="insertUsuario" class="btn-dashboard sub-btn">
              <i class="bi bi-person-plus-fill"></i>
              <span>Ingresar Usuario</span>
            </button>
          </form>

          <form action="index.php?action=listUsuario" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listUsuario" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Usuario </span>
            </button>
          </form>

          <form action="index.php" method="get" style="margin-top:8px;">
    <button type="submit" name="action" value="deleteusuario" class="btn-dashboard sub-btn">
        <i class="bi bi-trash-fill"></i>
        <span>Eliminar Usuario</span>
    </button>
</form>


        </div>


       
        <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#productoMenu">
          <i class="bi bi-box-seam"></i>
          <span>Producto</span>
        </button>

        <div id="productoMenu" class="collapse">

          <form action="index.php?action=insertProducto" method="get">
            <button type="submit" name="action" value="insertProducto" class="btn-dashboard sub-btn">
              <i class="bi bi-box-seam"></i>
              <span>Ingresar el Producto </span>
            </button>
          </form>

          <form action="index.php?action=listUsuario" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listProducto" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Producto</span>
            </button>
          </form>

 
  
       <form action="index.php" method="get" style="margin-top:8px;"> 
       <button type="submit" name="action" value="deleteproducto" class="btn-dashboard sub-btn">
        <i class="bi bi-trash-fill"></i>
        <span>Eliminar Producto</span>
       </button>
       </form>

        </div>

      

        <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#categoriaMenu">
    <i class="bi bi-briefcase-fill"></i>
    <span>Categoría</span>
</button>

<div id="categoriaMenu" class="collapse">

    <form action="index.php?action=insertCategoria" method="get">
        <button type="submit" name="action" value="insertCategoria" class="btn-dashboard sub-btn">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Ingresar Categoría</span>
        </button>
    </form>

    <form action="index.php?action=listCategoria" method="get" style="margin-top:8px;">
        <button type="submit" name="action" value="listCategoria" class="btn-dashboard sub-btn">
            <i class="bi bi-list-ul"></i>
            <span>Consultar Categoría</span>
        </button>
    </form>

</div>



        
        <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#devoluciónMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Devolución</span>
        </button>

        <div id="devoluciónMenu" class="collapse">

          <form action="index.php?action=insertDevolucion" method="get">
            <button type="submit" name="action" value="insertDevolucion" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Devolución</span>
            </button>
          </form>

          <form action="index.php?action=listDevolucion" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listDevolucion" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Devolución</span>
            </button>
          </form>
          </div>



          <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#detalleMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Detalle de Factura</span>
        </button>

        <div id="detalleMenu" class="collapse">

          <form action="index.php?action=insertDetalle" method="get">
            <button type="submit" name="action" value="insertDetalle" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Detalle de Factura</span>
            </button>
          </form>

          <form action="index.php?action=listDetalle" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listDetalle" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Detalle de Factura</span>
            </button>
          </form>
          </div>




          <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#entradaMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Entrada</span>
        </button>

        <div id="entradaMenu" class="collapse">

          <form action="index.php?action=insertEntrada" method="get">
            <button type="submit" name="action" value="insertEntrada" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Entrada</span>
            </button>
          </form>

          <form action="index.php?action=listentrada" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listentrada" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Entrada</span>
            </button>
          </form>
          </div>



            <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#salidaMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Salida</span>
        </button>

        <div id="salidaMenu" class="collapse">

          <form action="index.php?action=insertSalida" method="get">
            <button type="submit" name="action" value="insertSalida" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Salida</span>
            </button>
          </form>

          <form action="index.php?action=listsalida" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listsalida" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Salida</span>
            </button>
          </form>
          </div>



           <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#facturaMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Factura</span>
        </button>

        <div id="facturaMenu" class="collapse">

          <form action="index.php?action=insertFactura" method="get">
            <button type="submit" name="action" value="insertFactura" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Factura</span>
            </button>
          </form>

          <form action="index.php?action=listFactura" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listFactura" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Factura</span>
            </button>
          </form>
          </div>



           <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#tipodocumentoMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Tipo Documento</span>
        </button>

        <div id="tipodocumentoMenu" class="collapse">

          <form action="index.php?action=insertIdtipodocu" method="get">
            <button type="submit" name="action" value="insertIdtipodocu" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Tipo Documento</span>
            </button>
          </form>

          <form action="index.php?action=listTipoDocum" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listTipoDocum" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Tipo de Documento</span>
            </button>
          </form>
          </div>





           <button class="btn-dashboard" data-bs-toggle="collapse" data-bs-target="#marcaMenu">
          <i class="bi bi-tags-fill"></i>
          <span> Marca</span>
        </button>

        <div id="marcaMenu" class="collapse">

          <form action="index.php?action=insertMarca" method="get">
            <button type="submit" name="action" value="insertMarca" class="btn-dashboard sub-btn">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Ingresar Marca</span>
            </button>
          </form>

          <form action="index.php?action=listMarca" method="get" style="margin-top:8px;">
            <button type="submit" name="action" value="listMarca" class="btn-dashboard sub-btn">
              <i class="bi bi-list-ul"></i>
              <span>Consultar Marca</span>
            </button>
          </form>
          </div>

        </div>

        


      

      </div>

    </div>

  
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>