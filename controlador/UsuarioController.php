<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../modelo/Usuario.php';


class UsuarioController
{
    private $db;
    private $usuario;


    public function __construct()
    {
        $database = new Database();

        $this->db = $database->conectar();

        $this->usuario = new Usuario($this->db);
    }


    /*
    |--------------------------------------------------------------------------
    | INICIAR SESIÓN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        $errores = [];


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $correo = trim($_POST["correo"] ?? "");
            $contrasena = $_POST["contrasena"] ?? "";


            if (empty($correo) || empty($contrasena)) {

                $errores[] =
                    "Debes ingresar correo y contraseña.";

            } else {

                $this->usuario->correo = $correo;

                $usuario = $this->usuario->buscarPorCorreo();


                if (!$usuario) {

                    $errores[] =
                        "El correo o la contraseña son incorrectos.";

                } elseif (
                    !password_verify(
                        $contrasena,
                        $usuario["contrasena"]
                    )
                ) {

                    $errores[] =
                        "El correo o la contraseña son incorrectos.";

                } else {

                    session_regenerate_id(true);


                    $_SESSION["usuario_id"] = $usuario["id"];

                    $_SESSION["nombre"] = $usuario["nombre"];

                    $_SESSION["correo"] = $usuario["correo"];

                    $_SESSION["avatar"] = $usuario["avatar"];

                    $_SESSION["rol"] = $usuario["rol"];


                    /*
                    |--------------------------------------------------------------------------
                    | REDIRECCIÓN SEGÚN EL ROL
                    |--------------------------------------------------------------------------
                    */

                    if ($usuario["rol"] === "administrador") {

                        header("Location: dashboard.php");
                        exit;

                    } else {

                        header("Location: index.php");
                        exit;
                    }
                }
            }
        }


        require_once __DIR__ . '/../vista/login.php';
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTRAR USUARIO
    |--------------------------------------------------------------------------
    */

    public function registrar()
    {
        $errores = [];

        $nombre = "";
        $correo = "";


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $nombre = trim($_POST["nombre"] ?? "");

            $correo = trim($_POST["correo"] ?? "");

            $contrasena = $_POST["contrasena"] ?? "";

            $confirmarContrasena =
                $_POST["confirmar_contrasena"] ?? "";

            $avatar = $_POST["avatar"] ?? "avatar1";


            /*
            |--------------------------------------------------------------------------
            | VALIDAR NOMBRE
            |--------------------------------------------------------------------------
            */

            if (empty($nombre)) {

                $errores[] =
                    "Debes ingresar tu nombre.";

            }


            /*
            |--------------------------------------------------------------------------
            | VALIDAR CORREO
            |--------------------------------------------------------------------------
            */

            if (empty($correo)) {

                $errores[] =
                    "Debes ingresar tu correo.";

            } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

                $errores[] =
                    "El correo electrónico no es válido.";

            }


            /*
            |--------------------------------------------------------------------------
            | VALIDAR CONTRASEÑA
            |--------------------------------------------------------------------------
            */

            if (empty($contrasena)) {

                $errores[] =
                    "Debes ingresar una contraseña.";

            } elseif (strlen($contrasena) < 6) {

                $errores[] =
                    "La contraseña debe tener mínimo 6 caracteres.";

            }


            /*
            |--------------------------------------------------------------------------
            | CONFIRMAR CONTRASEÑA
            |--------------------------------------------------------------------------
            */

            if ($contrasena !== $confirmarContrasena) {

                $errores[] =
                    "Las contraseñas no coinciden.";

            }


            /*
            |--------------------------------------------------------------------------
            | COMPROBAR CORREO EXISTENTE
            |--------------------------------------------------------------------------
            */

            if (empty($errores)) {

                $this->usuario->correo = $correo;

                if ($this->usuario->existeCorreo()) {

                    $errores[] =
                        "El correo electrónico ya está registrado.";
                }
            }


            /*
            |--------------------------------------------------------------------------
            | CREAR USUARIO
            |--------------------------------------------------------------------------
            */

            if (empty($errores)) {

                $this->usuario->nombre = $nombre;

                $this->usuario->correo = $correo;

                $this->usuario->contrasena = $contrasena;

                $this->usuario->avatar = $avatar;


                /*
                | El modelo establece automáticamente:
                |
                | rol = usuario
                |
                | Nunca recibimos el rol desde el formulario.
                */


                if ($this->usuario->registrar()) {

                    header("Location: login.php?registrado=1");

                    exit;

                } else {

                    $errores[] =
                        "No fue posible crear la cuenta.";
                }
            }
        }


        require_once __DIR__ . '/../vista/registro.php';
    }


    /*
    |--------------------------------------------------------------------------
    | CERRAR SESIÓN
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        $_SESSION = [];

        session_destroy();


        header("Location: index.php");

        exit;
    }
}