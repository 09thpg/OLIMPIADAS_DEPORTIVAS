<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../modelo/InformacionGeneral.php';

class InformacionController
{
    private $db;
    private $informacion;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->conectar();

        $this->informacion = new InformacionGeneral($this->db);
    }

    private function comprobarAdministrador()
    {
        if (!isset($_SESSION['usuario_id'])) {

            header(
                "Location: /OLIMPIADAS_DEPORTIVAS/login.php"
            );

            exit;
        }

        if (
            !isset($_SESSION['rol']) ||
            $_SESSION['rol'] !== 'administrador'
        ) {

            header(
                "Location: /OLIMPIADAS_DEPORTIVAS/index.php"
            );

            exit;
        }
    }

    public function editar()
    {
        $this->comprobarAdministrador();

        $datos = $this->informacion->obtener();

        $mensaje = "";
        $tipoMensaje = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $this->informacion->id =
                $_POST["id"] ?? "";

            $this->informacion->titulo =
                $_POST["titulo"] ?? "";

            $this->informacion->subtitulo =
                $_POST["subtitulo"] ?? "";

            $this->informacion->descripcion =
                $_POST["descripcion"] ?? "";


            if (
                empty($this->informacion->titulo) ||
                empty($this->informacion->subtitulo) ||
                empty($this->informacion->descripcion)
            ) {

                $mensaje =
                    "Todos los campos son obligatorios.";

                $tipoMensaje = "error";

            } else {

                if ($this->informacion->actualizar()) {

                    $mensaje =
                        "La información se actualizó correctamente.";

                    $tipoMensaje = "exito";

                    $datos =
                        $this->informacion->obtener();

                } else {

                    $mensaje =
                        "No fue posible actualizar la información.";

                    $tipoMensaje = "error";
                }
            }
        }

        require_once __DIR__ .
            '/../vista/admin/informacion.php';
    }
}