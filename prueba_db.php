<?php

require_once __DIR__ . '/config/database.php';

$database = new Database();

$db = $database->conectar();

if (!$db) {
    die("NO SE PUDO CONECTAR A LA BASE DE DATOS");
}

echo "<h1>CONEXIÓN CORRECTA</h1>";

try {

    $query = "SELECT * FROM informacion_general";

    $stmt = $db->prepare($query);

    $stmt->execute();

    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Registros encontrados: " . count($datos) . "</h2>";

    if (count($datos) > 0) {

        echo "<pre>";

        print_r($datos);

        echo "</pre>";

    } else {

        echo "<h2>LA TABLA ESTÁ VACÍA</h2>";

    }

} catch (PDOException $e) {

    echo "<h2>ERROR SQL</h2>";

    echo "<p>";
    echo $e->getMessage();
    echo "</p>";

}