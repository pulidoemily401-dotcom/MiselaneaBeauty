<?php
require_once "./controllers/usuarioController.php";
require_once "./controllers/devolucionController.php";
require_once "./controllers/categoriaController.php";
require_once "./controllers/detalleController.php";
require_once "./controllers/entradaController.php";
require_once "./controllers/facturaController.php";
require_once "./controllers/idtipodocuController.php";
require_once "./controllers/productoController.php";
require_once "./controllers/marcaController.php";
require_once "./controllers/salidaController.php";


$usuarioController = new UsuarioController();
$categoriaController = new CategoriaController();
$detalleController = new DetalleController();
$devolucionController = new DevolucionController();
$entradaController = new EntradaController();
$facturaController = new FacturaController();
$idtipodocuController = new IdtipodocuController();
$productoController = new ProductoController();
$marcaController = new MarcaController();
$salidaController = new SalidaController();


$action = $_GET["action"] ?? "dashBoard" ;
switch ($action) {

    case 'insertUsuario':
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $usuarioController->insertUsuario();
            include "./views/dashBoard.php";
        }else{
            include "./views/usuario.php";
        }
        break;

         case "insertCategoria":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $categoriaController->insertCategoria();
            include "./views/dashBoard.php";
        }else{
            include "./views/categoria.php";
        }
        break;

        case "insertDevolucion":
              if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $devolucionController->insertDevolucion();
            include "./views/dashBoard.php";
        }else{
            include "./views/devolucion.php";
        }
        break;

        case "insertDetalle":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $detalleController->insertDetalle();
            include "./views/dashBoard.php";
        }else{
            include "./views/detalle.php";
        }
        break;

        

         case "insertEntrada":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $entradaController->insertEntrada();
            include "./views/dashBoard.php";
        }else{
            include "./views/entrada.php";
        }
        break;



           case "insertFactura":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $facturaController->insertFactura();
            include "./views/dashBoard.php";
        }else{
            include "./views/factura.php";
        }
        break;



         case "insertProducto":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $productoController->insertProducto();
            include "./views/dashBoard.php";
        }else{
            include "./views/producto.php";
        }
        break;

          
        case "insertIdtipodocu":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $idtipodocuController->insertIdtipodocu();
            include "./views/dashBoard.php";
        }else{
            include "./views/idtipodocu.php";
        }
        break;

             case "insertMarca":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $marcaController->insertMarca();
            include "./views/dashBoard.php";
        }else{
            include "./views/marca.php";
        }
        break;

           case "insertSalida":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $salidaController->insertSalida();
            include "./views/dashBoard.php";
        }else{
            include "./views/salida.php";
        }
        break;


        case "listCategoria":
        $categoria= $categoriaController->listCategoria(); 
         include "./views/listCategoria.php"; 
        break; 

        
        case "lisTipoDocum":
        $tipo= $idtipodocuController->lisTipoDocum(); 
         include "./views/listTipoDocum.php"; 
        break; 


        case "listMarca":
        $marca= $marcaController->listMarca(); 
         include "./views/listMarca.php"; 
        break; 

        case "listUsuario":
        $usuario = $usuarioController->listUsuario(); 
         include "./views/listUsuario.php"; 
        break; 


        
        case "listProducto":
        $producto= $productoController->listProducto(); 
         include "./views/listProducto.php"; 
        break; 

 
         case "listDetalle":
        $Detalle = $detalleController->listDetalle(); 
         include "./views/listDetalle.php"; 
        break; 


        
         case "listFactura":
        $factura = $facturaController->listFactura(); 
         include "./views/listFactura.php"; 
        break; 

        
        
         case "listentrada":
        $entrada = $entradaController->listentrada(); 
         include "./views/listEntrada.php"; 
        break; 

           case "listsalida":
        $salida = $salidaController->listsalida(); 
         include "./views/listsalida.php"; 
        break; 


   case "listDevolucion":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $devolucion = $devolucionController->listDevolucion();
            include "./views/listDevolucion.php";
        }else{
            $devolucion = $devolucionController->listDevolu(); 
            include "./views/listDevolucion.php";
        }
        break;



        case "dashBoard":
            include "./views/dashBoard.php";
            break;  
    
    
    
}