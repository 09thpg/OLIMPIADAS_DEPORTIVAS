<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| Verificar que haya una sesión iniciada
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Verificar que el usuario sea administrador
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION['rol']) ||
    $_SESSION['rol'] !== 'administrador'
) {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Cargar panel de administrador
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/vista/admin/dashboard.php';