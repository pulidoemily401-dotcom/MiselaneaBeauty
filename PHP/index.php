<?php
require_once "./controllers/usuarioController.php";
require_once "./controllers/devolucionController.php";
require_once "./controllers/categoriaController.php";
require_once "./controllers/detalleController.php";
require_once "./controllers/entradaController.php";
require_once "./controllers/facturaController.php";
require_once "./controllers/idtipodocuController.php";
require_once ",/controllers/productoController.php";

$UsuarioController = new usuarioController();{
$CategoriaController = new categoriaController();
$DetalleController = new detalleController();
$DevolucionController = new devolucionController();
$EntradaController = new entradaController();
$FacturaController = new facturaController();
$IdtipodocuController = new idtipodocuController();
$ProductoController = new productoController();
}

$action = $_GET["action"] ?? "dashBoard" ;
switch ($action) {

    case 'insertUsuario':
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $UsuarioController->insertUsuario();
            include "./views/dashBoard.php";
        }else{
            include "./views/usuario.php";
        }
        break;

         case "insertCategoria":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $CategoriaController->insertCategoria();
            include "./views/dashBoard.php";
        }else{
            include "./views/categoria.php";
        }
        break;

        case "insertDevolucion":
              if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $DevolucionController->insertDevolucion();
            include "./views/dashBoard.php";
        }else{
            include "./views/devolucion.php";
        }
        break;

        case "insertDetalle":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $DetalleController->insertDetalle();
            include "./views/dashBoard.php";
        }else{
            include "./views/detalle.php";
        }
        break;

        

         case "insertEntrada":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $EntradaController->insertEntrada();
            include "./views/dashBoard.php";
        }else{
            include "./views/entrada.php";
        }
        break;



           case "insertFactura":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $FacturaController->insertFactura();
            include "./views/dashBoard.php";
        }else{
            include "./views/factura.php";
        }
        break;



         case "insertProducto":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $ProductoController->insertProducto();
            include "./views/dashBoard.php";
        }else{
            include "./views/producto.php";
        }
        break;

          
        case "insertIdtipodocu":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $IdtipodocuController->insertIdtipodocu();
            include "./views/dashBoard.php";
        }else{
            include "./views/idtipodocu.php";
        }
        break;




        case "dashBoard":
            include "./views/dashBoard.php";
            break;  
    
    
    
}