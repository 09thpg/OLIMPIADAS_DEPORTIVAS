<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ==================================================
// SEGURIDAD
// ==================================================

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

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Panel de administrador | Olimpiadas Deportivas
    </title>


    <link
        rel="stylesheet"
        href="/OLIMPIADAS_DEPORTIVAS/vista/css/styles.css"
    >

</head>


<body class="pagina-auth">


<div class="auth-contenedor">


    <div class="auth-card">


        <!-- LOGO -->

        <div class="auth-logo">

            ⚽

        </div>


        <!-- TÍTULO -->

        <h2>

            Olimpiadas Deportivas

        </h2>


        <h3>

            Panel de administrador

        </h3>


        <!-- BIENVENIDA -->

        <p>

            Bienvenido,

            <strong>

                <?php

                echo htmlspecialchars(
                    $_SESSION['nombre'] ?? 'Administrador'
                );

                ?>

            </strong>

        </p>


        <br>


        <!-- EDITAR INFORMACIÓN -->

        <a
            href="/OLIMPIADAS_DEPORTIVAS/admin_informacion.php"
            class="btn btn-primary btn-block"
        >

            Editar información general

        </a>


        <br>

        <br>


        <!-- ENLACES -->

        <div class="auth-links">


            <a
                href="/OLIMPIADAS_DEPORTIVAS/index.php"
            >

                Ver página pública

            </a>


            <a
                href="/OLIMPIADAS_DEPORTIVAS/logout.php"
            >

                Cerrar sesión

            </a>


        </div>


    </div>


</div>


</body>

</html>