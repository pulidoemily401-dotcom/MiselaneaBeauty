<?php
session_start();
date_default_timezone_set('America/Bogota');

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
require_once "./controllers/rolController.php";



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
$rolController = new RolController();



$action = $_GET["action"] ?? "tienda";

switch ($action) {
    


   case 'insertUsuario':
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuarioController->insertUsuario();
    
    } else {
        $roles = $rolController->listRol();
        $tipos = $idtipodocuController->listTipoDocum();
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $devolucionController->insertDevolucion();
        $_SESSION['mensaje_ok'] = '✅ Devolución registrada correctamente.';
        
        if ($_SESSION['idrol'] == 3) {
            header("Location: ./php/productos.php");
        } else {
            header("Location: index.php?action=listDevolucion");
        }
        exit();
    } else {
        $productos = $productoController->listProducto();
        $facturas  = $facturaController->listFactura();
        include "./views/devolucion.php";
    }
    break;
    break;

        case "insertDetalle":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $detalleController->insertDetalle();
            include "./views/dashBoard.php";
        }else{
            $productos =  $productoController->listProducto();
               $facturas =  $facturaController->listFactura();
            include "./views/detalle.php";
        }
        break;

        

         case "insertEntrada":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $users = $entradaController->insertEntrada();
        include "./views/dashBoard.php";
    } else {
        $usuarios  = $usuarioController->listUsuariosPorRol(1); // Solo admins ✅
        $productos = $productoController->listProducto();
        include "./views/entrada.php";
    }
    break;






           case "insertFactura":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $facturaController->insertFactura();
            include "./views/dashBoard.php";
        }else{
              $usuarios =  $usuarioController->listUsuario();
            include "./views/factura.php";
        }
        break;



         case "insertProducto":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $productoController->insertProducto();
            include "./views/dashBoard.php";
        }else{
              $categorias =  $categoriaController->listCategoria();
              $marcas =  $marcaController->listMarca();
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

        case "insertRol":
            if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $rolController->insertRol();
            include "./views/dashBoard.php";
        }else{
            include "./views/rol.php";
        }
        break;

           case "insertSalida":
             if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $users = $salidaController->insertSalida();
            include "./views/dashBoard.php";
        }else{
             $productos =  $productoController->listProducto();
            include "./views/salida.php";
        }
        break;


      case "listCategoria":
    $controller = new categoriaController();
    $categoria = $controller->listCategoria();
    require "./views/listCategoria.php";
break;


        
        case "listTipoDocum":
        $tipo= $idtipodocuController->listTipoDocum(); 
         include "./views/listTipoDocum.php"; 
        break; 


        case "listMarca":
        $marca= $marcaController->listMarca(); 
         include "./views/listMarca.php"; 
        break; 

         case "listRol":
        $rol= $rolController->listRol(); 
         include "./views/listRol.php"; 
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

                case 'openFormDelete':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categorias=$categoriaController->Eliminar();
            $categorias=$categoriaController->listCategoria();
            include "./views/dashBoard.php"; 
        }else{
            $categorias=$categoriaController->listCategoria();
            include "./views/delete_categoria.php";
        }
        break;


          case 'eliminarDetalle':
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $detalleController->Eliminar();
        header("Location: index.php?action=listDetalle");
        exit;
    } else {
        header('Location: index.php?action=listDetalle');
        exit;
    }
    break;

               case 'deletedevolucion':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $devoluciones=$devolucionController->Eliminar();
            include "./views/dashBoard.php"; 
        }else{
            $devoluciones=$devolucionController->listDevolu();
            include "./views/delete_devolucion.php";
        }
        break;


                 case 'deleteentrada':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $entradas=$entradaController->Eliminar();
            $entradas=$entradaController->listentrada();
            include "./views/dashBoard.php"; 
        }else{
            $entradas=$entradaController->listentrada();
            include "./views/delete_entrada.php";
        }
        break;

                case 'deletefactura':
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $facturaController->Eliminar();
    } else {
        header("Location: index.php?action=listFactura");
        exit();
    }
    break;


            case 'deleteidtipodocu':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tipos=$idtipodocuController->Eliminar();
            $tipos=$idtipodocuController->listTipoDocum();
            include "./views/dashBoard.php"; 
        }else{
            $tipos=$idtipodocuController->listTipoDocum();
            include "./views/delete_idtipodocu.php";
        }
        break;

        
         case 'deletemarca':
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $marcaController->Eliminar(); 
    } else {
        header("Location: index.php?action=listMarca");
        exit();
    }
    break;

          case 'deleterol':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $roles=$rolController->Eliminar();
            $roles=$rolController->listRol();
            include "./views/dashBoard.php"; 
        }else{
            $roles=$rolController->listRol();
            include "./views/delete_rol.php";
        }
        break;

        
            case 'deleteproducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productos=$productoController->Eliminar();
            $productos=$productoController->listProducto();
            include "./views/dashBoard.php"; 
        }else{
            $productos=$productoController->listProducto();
            include "./views/delete_producto.php";
        }
        break;

            case 'deletesalida':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $salidas=$salidaController->Eliminar();
            $salidas=$salidaController->listsalida();
             include "./views/delete_salida.php"; 
        }else{
            $salidas=$salidaController->listsalida();
            include "./views/delete_salida.php";
        }
        break;

          case 'deleteusuario':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuarios=$usuarioController->Eliminar();
            $usuarios=$usuarioController->listUsuario();
             include "./views/delete_usuario.php"; 
        }else{
            $usuarios=$usuarioController->listUsuario();
            include "./views/delete_usuario.php";
        }
        break;


    //Actualizar 
case "editarcategoria":
    
    $idcategoria = $_GET['id'] ?? null;
    
    if (!$idcategoria) {
        $_SESSION['mensaje_error'] = 'ID de categoría no válido';
        header('Location: index.php?action=listCategoria');
        exit;
    }
    
    
    $categoria = $categoriaController->obtenerCategoriaPorId($idcategoria);
    
    if (!$categoria) {
        $_SESSION['mensaje_error'] = 'Categoría no encontrada';
        header('Location: index.php?action=listCategoria');
        exit;
    }
    
    include "./views/update_categoria.php"; 
    break;
        case "actualizarcategoria":
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $categoriaController->actualizar();
        
        $_SESSION['mensaje_ok'] = 'Categoría actualizada exitosamente';
        header("Location: index.php?action=listCategoria");
        exit;
    } else {
        
        header('Location: index.php?action=listCategoria');
        exit;
    }
    break;

          case "editarDetalle":
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['mensaje_error'] = 'ID de detalle no válido';
        header('Location: index.php?action=listDetalle');
        exit;
    }

    $detalle = $detalleController->getDetalleById($id);

    if (!$detalle) {
        $_SESSION['mensaje_error'] = 'Detalle no encontrado';
        header('Location: index.php?action=listDetalle');
        exit;
    }

    $facturas  = $facturaController->listFactura();
    $productos = $productoController->listProducto();
    include "./views/update_detalle.php";
    break;

case "actualizarDetalle":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $detalleController->actualizar();
        $_SESSION['mensaje_ok'] = 'Detalle actualizado exitosamente';
        header("Location: index.php?action=listDetalle");
        exit;
    } else {
        header('Location: index.php?action=listDetalle');
        exit;
    }
    break;


        case "editarDevolucion":
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['mensaje_error'] = 'ID de devolución no válido';
        header('Location: index.php?action=listDevolucion');
        exit;
    }

    $devolucion = $devolucionController->getDevolucionById($id);

    if (!$devolucion) {
        $_SESSION['mensaje_error'] = 'Devolución no encontrada';
        header('Location: index.php?action=listDevolucion');
        exit;
    }

    $facturas  = $facturaController->listFactura();
    $productos = $productoController->listProducto();
    include "./views/update_devolucion.php";
    break;

     case "actualizarDevolucion":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $devolucionController->actualizar();
        $_SESSION['mensaje_ok'] = 'Devolución actualizada exitosamente';
        header("Location: index.php?action=listDevolucion");
        exit;
    } else {
        header('Location: index.php?action=listDevolucion');
        exit;
    }
    break;

  case "actualizarentrada":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entradaController->actualizar();
    } else {
        $identrada = $_GET['identrada'] ?? null;

        if (!$identrada) {
            $_SESSION['mensaje_error'] = 'ID de entrada no válido';
            header('Location: index.php?action=listentrada');
            exit;
        }

        $entrada = $entradaController->getEntradaById($identrada); 

        if (!$entrada) {
            $_SESSION['mensaje_error'] = 'Entrada no encontrada';
            header('Location: index.php?action=listentrada');
            exit;
        }

        $usuarios  = $usuarioController->listUsuario();
        $productos = $productoController->listProducto();

        include "./views/update_entrada.php";
    }
    break;

 case "editarFactura":
    $id = $_GET['id'] ?? null;
    
    if (!$id) {
        $_SESSION['mensaje_error'] = 'ID de factura no válido';
        header('Location: index.php?action=listFactura');
        exit;
    }
    
    $factura = $facturaController->getFacturaById($id);
    
    if (!$factura) {
        $_SESSION['mensaje_error'] = 'Factura no encontrada';
        header('Location: index.php?action=listFactura');
        exit;
    }
    
    include "./views/update_factura.php";
    break;

case "actualizarFactura":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $facturaController->actualizar();
        header("Location: index.php?action=listFactura");
        exit;
    } else {
        header('Location: index.php?action=listFactura');
        exit;
    }
    break;

  case "misFacturas":
    if (!isset($_SESSION["idrol"]) || $_SESSION["idrol"] != 3) {
        header("Location: index.php");
        exit();
    }
    $factura = $facturaController->listFacturaByUsuario($_SESSION["numerodocumen"]);
    include "./views/listFactura.php";
    break;

    case "editartipo":
    $idtipo = $_GET['id'] ?? null;
    
    if (!$idtipo) {
        $_SESSION['mensaje_error'] = 'ID de tipo de documento no valido';
        header('Location: index.php?action=listTipoDocum');
        exit;
    }
    
    $tipo = $idtipodocuController->getTipoById($idtipo);
    
    if (!$tipo) {
        $_SESSION['mensaje_error'] = 'Tipo de documento no encontrado';
        header('Location: index.php?action=listTipoDocum');
        exit;
    }
    
    include "./views/update_idtipodocu.php"; 
    break;

case "actualizaridtipodocu":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idtipodocuController->actualizar();
        
        $_SESSION['mensaje_ok'] = 'Tipo de documento actualizado exitosamente';
        header("Location: index.php?action=listTipoDocum");
        exit;
    } else {
        header('Location: index.php?action=listTipoDocum');
        exit;
    }
    break;

  
case "actualizarmarca":
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $marcaController->actualizar();
        
        $_SESSION['mensaje_ok'] = 'Marca actualizada exitosamente';
        header("Location: index.php?action=listMarca");
        exit;
    } else {
       
        header('Location: index.php?action=listMarca');
        exit;
    }
    break;


case "editarmarca":
   
    $idmarca = $_GET['id'] ?? null;
    
    if (!$idmarca) {
        $_SESSION['mensaje_error'] = 'ID de marca no válido';
        header('Location: index.php?action=listMarca');
        exit;
    }
    
  
    $marca = $marcaController->obtenerMarcaPorId($idmarca);
    
    if (!$marca) {
        $_SESSION['mensaje_error'] = 'Marca no encontrada';
        header('Location: index.php?action=listMarca');
        exit;
    }
    
    include "./views/update_marca.php"; 
    break;

    case "actualizarproducto":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $productoController->actualizar();
        
        $_SESSION['mensaje_ok'] = 'Producto actualizado exitosamente';
        header("Location: index.php?action=listProducto");
        exit;
    } else {
        
        $idproducto = $_GET['idproducto'] ?? null;
        
        if (!$idproducto) {
            $_SESSION['mensaje_error'] = 'ID de producto no válido';
            header('Location: index.php?action=listProducto');
            exit;
        }
        
       
        $productoActualizar = $productoController->obtenerProductoParaActualizar();
        
       
        $categorias = $categoriaController->listCategoria(); 
        $marcas = $marcaController->listMarca(); 
        
        include "./views/update_producto.php"; 
    }
    break;

case "editarrol":

    $idrol = $_GET['id'] ?? null;
    
    if (!$idrol) {
        $_SESSION['mensaje_error'] = 'ID de rol no válido';
        header('Location: index.php?action=listRol');
        exit;
    }

    $rol = $rolController->obtenerRolPorId($idrol);
    
    if (!$rol) {
        $_SESSION['mensaje_error'] = 'Rol no encontrado';
        header('Location: index.php?action=listRol');
        exit;
    }
    
    include "./views/update_rol.php"; 
    break;

case "misDevolucion":
    if (!isset($_SESSION["idrol"]) || $_SESSION["idrol"] != 3) {
        header("Location: index.php");
        exit();
    }
    $productos  = $productoController->listProducto();
    $facturas   = $facturaController->listFacturaByUsuario($_SESSION["numerodocumen"]);
    $devolucion = $devolucionController->listDevolucionByUsuario($_SESSION["numerodocumen"]);
    include "./views/devolucion.php";
    break;

case "actualizarrol":

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rolController->actualizar();
        
        $_SESSION['mensaje_ok'] = 'Rol actualizado exitosamente';
        header("Location: index.php?action=listRol");
        exit;
    } else {
        
        header('Location: index.php?action=listRol');
        exit;
    }
    break;

   case "actualizarsalida":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $salidaController->actualizar();
    } else {
        $idsalida = $_GET['idsalida'] ?? null;

        if (!$idsalida) {
            $_SESSION['mensaje_error'] = 'ID de salida no válido';
            header('Location: index.php?action=listsalida');
            exit;
        }

        $salida = $salidaController->getSalidaById($idsalida);

        if (!$salida) {
            $_SESSION['mensaje_error'] = 'Salida no encontrada';
            header('Location: index.php?action=listsalida');
            exit;
        }

        $productos = $productoController->listProducto();

        include "./views/update_salida.php";
    }
    break;

case "actualizarusuario":
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuarioController->actualizar();
    } else {
        $usuarios = $usuarioController->listUsuario();
        $roles = $rolController->listRol();
        $docums = $idtipodocuController->listTipoDocum();

        if (!isset($_GET['numerodocumen'])) {
            $_GET['numerodocumen'] = $_SESSION['numerodocumen'];
        }

        include "./views/update_usuario.php";
    }
    break;

    case "marcarNotificaciones":
    header('Content-Type: application/json');
    require_once "./config/database.php";
    $db2 = new Database();
    $conn2 = $db2->getConnection();
    $conn2->exec("UPDATE notificacion SET visto = 1 WHERE visto = 0");
    echo json_encode(['ok' => true]);
    exit();
    break;




case "ingreso":
    $usuarioController->login1();
    break;

case "enviarRecuperacion":
    $usuarioController->enviarRecuperacion();
break;

case "generarToken":
    $usuarioController->generarToken();
break;

case "nuevaClave":
    $usuarioController->nuevaClave();
break;

case "guardarNuevaClave":
    $usuarioController->guardarNuevaClave();
break;





       case "dashBoard":
    if (isset($_SESSION["idrol"]) && $_SESSION["idrol"] == 1) {
        include "./views/dashBoard.php";
    } else {
        header("Location: index.php");
        exit();
    }
    break;


case "dashBoardu":
    if (isset($_SESSION["idrol"]) && $_SESSION["idrol"] == 3) {
       
        header("Location: ./php/productos.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
    break;
 
case "logout":
    session_destroy();
   
    
    header("Location: ./php/index.php");
    exit();



case "tienda":
    header("Location: ./php/index.php");
    exit();
    break;


        default:
            include "./views/login.php";
            break;  
    
    
    
}