<?php

require_once "./model/usuarioModel.php";
require_once "./config/database.php";

class UsuarioController
{
    private $db;
    private $usuarioModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuarioModel = new UsuarioModel($this->db);
    }

    public function insertUsuario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nombrecompleto = $_POST["nombrecompleto"];
            $correoelectronic = $_POST["correoelectronic"];
            $telefono = $_POST["telefono"];
            $numerodocumen = $_POST["numerodocumen"];
            $tipogenero = $_POST["tipogenero"];
            $contra = $_POST["contra"];
            $idtipo = $_POST["idtipo"];

            $idrol = (!empty($_POST["idrol"])) ? $_POST["idrol"] : 3;

            $this->usuarioModel->insertUsuario(
                $nombrecompleto,
                $correoelectronic,
                $telefono,
                $tipogenero,
                $contra,
                $idrol,
                $idtipo,
                $numerodocumen
            );

            if (isset($_SESSION["idrol"]) && $_SESSION["idrol"] == 1) {
                header("Location: index.php?action=dashBoard");
            } else {
                header("Location: index.php?action=login");
            }
            exit();
        }
    }

    public function listUsuario()
    {
        $numerodocumen = $_GET["numerodocumen"] ?? "";
        $numerodocumen = trim($numerodocumen);
        return $this->usuarioModel->getUsuariosConDetalles($numerodocumen, true);
    }

    public function Eliminar()
    {
        $numerodocumen = $_POST["numerodocumen"] ?? "";

        if (!$numerodocumen) {
            $_SESSION["mensaje_error"] = "❌ No se proporcionó un número de documento válido.";
            header("Location: index.php?action=listUsuario");
            exit();
        }

        if ($this->usuarioModel->tieneFacturas($numerodocumen)) {
            $_SESSION["mensaje_error"] = "⚠️ No se puede eliminar el usuario porque tiene facturas asociadas. Debe eliminarlas primero.";
            header("Location: index.php?action=listUsuario&numerodocumen=" . urlencode($numerodocumen));
            exit();
        }

        $resultado = $this->usuarioModel->Eliminar($numerodocumen);

        if ($resultado) {
            $_SESSION["mensaje_ok"] = "✅ Usuario eliminado correctamente.";
        } else {
            $_SESSION["mensaje_error"] = "❌ Error al eliminar el usuario. Intente nuevamente.";
        }

        header("Location: index.php?action=listUsuario");
        exit();
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombrecompleto   = $_POST["nombrecompleto"];
            $correoelectronic = $_POST["correoelectronic"];
            $telefono         = $_POST["telefono"];
            $tipogenero       = $_POST["tipogenero"];
            $contra           = $_POST["contra"] ?? '';
            $idrol            = $_POST["idrol"];
            $idtipo           = $_POST["idtipo"];
            $numerodocumen    = $_POST["numerodocumen"];

            $this->usuarioModel->actualizar(
                $nombrecompleto,
                $correoelectronic,
                $telefono,
                $tipogenero,
                $contra,
                $idrol,
                $idtipo,
                $numerodocumen
            );

            if (isset($_SESSION["idrol"]) && $_SESSION["idrol"] == 1) {
                header("Location: index.php?action=listUsuario");
            } else {
                header("Location: ../php/productos.php");
            }
            exit();
        }
    }

    public function enviarRecuperacion()
    {
        require_once './views/recuperar_password.php';
    }

    public function generarToken()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        ob_clean();
        header('Content-Type: application/json');

        $email = $_POST['correoelectronic'] ?? '';

        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email requerido']);
            exit;
        }

        try {
            $existe = $this->usuarioModel->buscarPorEmail($email);

            if (!$existe) {
                echo json_encode(['success' => false, 'message' => 'Si el email existe, recibirás un correo']);
                exit;
            }

            $token = bin2hex(random_bytes(32));
            $expira = date('Y-m-d H:i:s', strtotime('+5 hours'));
            $this->usuarioModel->guardarTokenRecuperacion($email, $token, $expira);

            echo json_encode(['success' => true, 'token' => $token]);
            exit;

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            exit;
        }
    }

    public function nuevaClave()
    {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            echo "<script>alert('Token inválido'); window.location='index.php?action=login';</script>";
            return;
        }

        $valido = $this->usuarioModel->verificarToken($token);

        if (!$valido) {
            echo "<script>alert('El enlace ha expirado o es inválido'); window.location='index.php?action=login';</script>";
            return;
        }

        require_once './views/nueva_password.php';
    }

    public function guardarNuevaClave()
    {
        $token = $_POST['token'] ?? '';
        $nueva = $_POST['nueva'] ?? '';

        if (empty($token) || empty($nueva)) {
            echo "<script>alert('Datos incompletos'); window.history.back();</script>";
            return;
        }

        if (strlen($nueva) < 6) {
            echo "<script>alert('La contraseña debe tener al menos 6 caracteres'); window.history.back();</script>";
            return;
        }

        $actualizado = $this->usuarioModel->actualizarPassword($token, $nueva);

        if ($actualizado) {
            echo "<script>alert('¡Contraseña actualizada exitosamente!'); window.location='index.php?action=login';</script>";
        } else {
            echo "<script>alert('Error al actualizar. El enlace puede haber expirado.'); window.location='index.php?action=enviarRecuperacion';</script>";
        }
    }

   public function login1()
{
    $correoelectronic = $_POST["correoelectronic"];
    $contra = $_POST["contra"];

    $user = $this->usuarioModel->login1($correoelectronic, $contra);

    if ($user) {
        $_SESSION["idrol"]          = $user["idrol"];
        $_SESSION["nombrecompleto"] = $user["nombrecompleto"];
        $_SESSION["numerodocumen"]  = $user["numerodocumen"];

        if ($user["idrol"] == 1) {
            header("Location: index.php?action=dashBoard");
        } else {
            header("Location: ../php/productos.php"); 
        }
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}

    public function listUsuariosPorRol($idrol)
{
    return $this->usuarioModel->listUsuariosPorRol($idrol);
}
}