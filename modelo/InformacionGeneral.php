<?php

class InformacionGeneral
{
    private $conn;
    private $tabla = "informacion_general";

    public $id;
    public $titulo;
    public $subtitulo;
    public $descripcion;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // ==========================================
    // OBTENER INFORMACIÓN
    // ==========================================

    public function obtener()
    {
        $query = "SELECT
                    id,
                    titulo,
                    subtitulo,
                    descripcion,
                    fecha_actualizacion
                  FROM " . $this->tabla . "
                  ORDER BY id ASC
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado;
        }

        return false;
    }


    // ==========================================
    // ACTUALIZAR INFORMACIÓN
    // ==========================================

    public function actualizar()
    {
        $query = "UPDATE " . $this->tabla . "
                  SET
                    titulo = :titulo,
                    subtitulo = :subtitulo,
                    descripcion = :descripcion
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);


        $titulo = trim($this->titulo);

        $subtitulo = trim($this->subtitulo);

        $descripcion = trim($this->descripcion);


        $stmt->bindParam(
            ":titulo",
            $titulo
        );

        $stmt->bindParam(
            ":subtitulo",
            $subtitulo
        );

        $stmt->bindParam(
            ":descripcion",
            $descripcion
        );

        $stmt->bindParam(
            ":id",
            $this->id,
            PDO::PARAM_INT
        );


        return $stmt->execute();
    }
}