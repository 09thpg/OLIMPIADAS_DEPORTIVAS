<?php

class Usuario
{
    private $conn;
    private $tabla = "usuarios";

    public $id;
    public $nombre;
    public $correo;
    public $contrasena;
    public $avatar;
    public $rol;


    public function __construct($db)
    {
        $this->conn = $db;
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTRAR USUARIO
    |--------------------------------------------------------------------------
    */

    public function registrar()
    {
        $query = "INSERT INTO " . $this->tabla . "
                  (nombre, correo, contrasena, avatar, rol)
                  VALUES
                  (:nombre, :correo, :contrasena, :avatar, :rol)";

        $stmt = $this->conn->prepare($query);


        $this->nombre = htmlspecialchars(
            strip_tags($this->nombre)
        );

        $this->correo = htmlspecialchars(
            strip_tags($this->correo)
        );


        $contrasena_hash = password_hash(
            $this->contrasena,
            PASSWORD_DEFAULT
        );


        // Todo usuario que se registre será usuario normal
        $this->rol = "usuario";


        $stmt->bindParam(
            ":nombre",
            $this->nombre
        );

        $stmt->bindParam(
            ":correo",
            $this->correo
        );

        $stmt->bindParam(
            ":contrasena",
            $contrasena_hash
        );

        $stmt->bindParam(
            ":avatar",
            $this->avatar
        );

        $stmt->bindParam(
            ":rol",
            $this->rol
        );


        return $stmt->execute();
    }


    /*
    |--------------------------------------------------------------------------
    | COMPROBAR SI EXISTE EL CORREO
    |--------------------------------------------------------------------------
    */

    public function existeCorreo()
    {
        $query = "SELECT id
                  FROM " . $this->tabla . "
                  WHERE correo = :correo
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(
            ":correo",
            $this->correo
        );

        $stmt->execute();


        return $stmt->rowCount() > 0;
    }


    /*
    |--------------------------------------------------------------------------
    | BUSCAR USUARIO POR CORREO
    |--------------------------------------------------------------------------
    */

    public function buscarPorCorreo()
    {
        $query = "SELECT
                    id,
                    nombre,
                    correo,
                    contrasena,
                    avatar,
                    rol
                  FROM " . $this->tabla . "
                  WHERE correo = :correo
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(
            ":correo",
            $this->correo
        );

        $stmt->execute();


        if ($stmt->rowCount() > 0) {

            return $stmt->fetch(
                PDO::FETCH_ASSOC
            );
        }


        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR AVATAR
    |--------------------------------------------------------------------------
    */

    public function actualizarAvatar($id, $avatar)
    {
        $query = "UPDATE " . $this->tabla . "
                  SET avatar = :avatar
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(
            ":avatar",
            $avatar
        );

        $stmt->bindParam(
            ":id",
            $id
        );


        return $stmt->execute();
    }
}