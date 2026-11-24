<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ==================================================
// CONEXIÓN A LA BASE DE DATOS
// ==================================================

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../modelo/InformacionGeneral.php';

$database = new Database();

$db = $database->conectar();

$informacionModel = new InformacionGeneral($db);

$informacion = $informacionModel->obtener();


// ==================================================
// INFORMACIÓN GENERAL
// ==================================================

if ($informacion) {

    $titulo = $informacion['titulo'];

    $subtitulo = $informacion['subtitulo'];

    $descripcion = $informacion['descripcion'];

} else {

    $titulo = 'Olimpiadas Deportivas';

    $subtitulo = 'Fútbol Colombiano';

    $descripcion = 'Celebramos el esfuerzo, la disciplina, el trabajo en equipo y la pasión por superarnos cada día.';
}


// ==================================================
// SESIÓN DEL USUARIO
// ==================================================

$usuarioLogueado = isset($_SESSION['usuario_id']);

$nombreUsuario = $_SESSION['nombre'] ?? '';

$rolUsuario = $_SESSION['rol'] ?? '';

$avatarUsuario = $_SESSION['avatar'] ?? 'avatar1';


// ==================================================
// AVATAR
// ==================================================

$avatarLimpio = preg_replace(
    '/[^a-zA-Z0-9_]/',
    '',
    $avatarUsuario
);

$rutaAvatar = 'vista/img/' . $avatarLimpio . '.png';

if (
    !file_exists(
        __DIR__ . '/img/' . $avatarLimpio . '.png'
    )
) {

    $rutaAvatar = 'vista/img/avatar1.png';

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
        <?php echo htmlspecialchars($titulo); ?>
    </title>

    <link
        rel="stylesheet"
        href="/OLIMPIADAS_DEPORTIVAS/vista/css/styles.css"
    >

</head>


<body>


<!-- ==================================================
     NAVBAR
================================================== -->

<header class="navbar">


    <div class="navbar-logo">

        <img
            src="/OLIMPIADAS_DEPORTIVAS/vista/img/logo_football.png"
            class="logo-nav"
            alt="Logo"
        >

        <?php echo htmlspecialchars($titulo); ?>

    </div>


    <button
        class="menu-toggle"
        id="menu-toggle"
    >

        ☰

    </button>


    <nav
        class="navbar-links"
        id="navbar-links"
    >


        <a href="#indice">
            Índice
        </a>


        <a href="#introduccion">
            Introducción
        </a>


        <a href="#estadio">
            Estadio
        </a>


        <a href="#equipos">
            Equipos
        </a>


        <a href="#valores">
            Valores
        </a>


        <a href="#campeonatos">
            Campeonatos
        </a>


        <a href="#enfrentamientos">
            Enfrentamientos
        </a>


        <a href="#entrenamientos">
            Entrenamientos
        </a>


        <?php if ($usuarioLogueado): ?>


            <div class="navbar-usuario">


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/<?php echo htmlspecialchars($rutaAvatar); ?>"
                    class="avatar-nav"
                    alt="Avatar"
                >


                <span class="nombre-usuario">

                    <?php

                    echo htmlspecialchars(
                        $nombreUsuario
                    );

                    ?>

                </span>


                <?php if ($rolUsuario === 'administrador'): ?>

                    <a
                        href="/OLIMPIADAS_DEPORTIVAS/dashboard.php"
                        class="btn-nav"
                    >
                        Panel administrador
                    </a>

                <?php endif; ?>


                <a
                    href="/OLIMPIADAS_DEPORTIVAS/logout.php"
                    class="btn-nav"
                >
                    Salir
                </a>


            </div>


        <?php else: ?>


            <div class="navbar-usuario">


                <a
                    href="/OLIMPIADAS_DEPORTIVAS/login.php"
                    class="btn-nav"
                >
                    Iniciar sesión
                </a>


                <a
                    href="/OLIMPIADAS_DEPORTIVAS/registro.php"
                    class="btn-nav"
                >
                    Registrarse
                </a>


            </div>


        <?php endif; ?>


    </nav>


</header>



<!-- ==================================================
     HERO
================================================== -->

<section class="hero hero-deportes">


    <h1>

        <?php

        echo htmlspecialchars($titulo);

        ?>

    </h1>


    <p>

        <?php

        echo htmlspecialchars($subtitulo);

        ?>

        —

        <?php

        echo htmlspecialchars($descripcion);

        ?>

    </p>


</section>



<!-- ==================================================
     ÍNDICE
================================================== -->

<section
    id="indice"
    class="seccion"
>


    <h2 class="seccion-titulo">

        Índice

    </h2>


    <div class="acto-grupo">


        <p class="acto-etiqueta">

            Acto 1 · Bienvenida

        </p>


        <div class="indice-grid">


            <a
                href="#introduccion"
                class="indice-item"
            >

                <span class="indice-num">
                    01
                </span>

                Introducción

            </a>


            <a
                href="#estadio"
                class="indice-item"
            >

                <span class="indice-num">
                    02
                </span>

                Estadio

            </a>


        </div>


    </div>



    <div class="acto-grupo">


        <p class="acto-etiqueta">

            Acto 2 · Los Protagonistas

        </p>


        <div class="indice-grid">


            <a
                href="#equipos"
                class="indice-item"
            >

                <span class="indice-num">
                    03
                </span>

                Equipos

            </a>


            <a
                href="#valores"
                class="indice-item"
            >

                <span class="indice-num">
                    04
                </span>

                Valores del Campeonato

            </a>


        </div>


    </div>



    <div class="acto-grupo">


        <p class="acto-etiqueta">

            Acto 3 · El Camino al Título

        </p>


        <div class="indice-grid">


            <a
                href="#campeonatos"
                class="indice-item"
            >

                <span class="indice-num">
                    05
                </span>

                Campeonatos Anteriores

            </a>


            <a
                href="#enfrentamientos"
                class="indice-item"
            >

                <span class="indice-num">
                    06
                </span>

                Enfrentamientos

            </a>


        </div>


    </div>



    <div class="acto-grupo">


        <p class="acto-etiqueta">

            Acto 4 · Detrás de Cámaras

        </p>


        <div class="indice-grid">


            <a
                href="#entrenamientos"
                class="indice-item"
            >

                <span class="indice-num">
                    07
                </span>

                Entrenamientos

            </a>


        </div>


    </div>


</section>



<!-- ==================================================
     DIVISOR ACTO 1
================================================== -->

<div class="acto-divisor">


    <span class="acto-divisor-num">

        Acto 1

    </span>


    <h2 class="acto-divisor-titulo">

        Bienvenida

    </h2>


</div>



<!-- ==================================================
     INTRODUCCIÓN
================================================== -->

<section
    id="introduccion"
    class="seccion seccion-oscura"
>


    <h2 class="seccion-titulo">

        Introducción

    </h2>


    <div class="contenido-texto">


        <p>

            <h4>
                Es un honor darles las bienvenida a este evento tan especial; nuestras olimpiadas Deportivas.
                celebramos mas que una competencia y medallas; celebramos el esfuerzo,la diciplina, el compromiso, el trabajo en equipo y sobre todo, la pasion por superarnos cada dia.
            </h4>

        </p>


    </div>


</section>



<!-- ==================================================
     ESTADIO
================================================== -->

<section
    id="estadio"
    class="seccion"
>


    <h2 class="seccion-titulo">

        Estadio

    </h2>


    <div class="estadio-contenido">


        <h3>

            Sede donde se va a realizar el torneo

        </h3>


        <img
            src="/OLIMPIADAS_DEPORTIVAS/vista/img/estadio.png"
            class="estadio-img"
            alt="Estadio"
        >


    </div>


</section>



<!-- ==================================================
     DIVISOR ACTO 2
================================================== -->

<div class="acto-divisor">


    <span class="acto-divisor-num">

        Acto 2

    </span>


    <h2 class="acto-divisor-titulo">

        Los Protagonistas

    </h2>


</div>



<!-- ==================================================
     EQUIPOS
================================================== -->

<section
    id="equipos"
    class="seccion"
>


    <h2 class="seccion-titulo">

        Equipos

    </h2>


    <div class="equipos-selector">


        <a
            href="#panel-santafe"
            class="equipo-tab activo"
            data-equipo="santafe"
        >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                class="escudo-mini"
            >

            Santa Fe

        </a>


        <a
            href="#panel-millonarios"
            class="equipo-tab"
            data-equipo="millonarios"
        >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                class="escudo-mini"
            >

            Millonarios

        </a>


        <a
            href="#panel-nacional"
            class="equipo-tab"
            data-equipo="nacional"
        >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                class="escudo-mini"
            >

            Atl. Nacional

        </a>


        <a
            href="#panel-medellin"
            class="equipo-tab"
            data-equipo="medellin"
        >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                class="escudo-mini"
            >

            Ind. Medellín

        </a>


    </div>



    <!-- SANTA FE -->

    <div
        class="equipo-panel activo"
        id="panel-santafe"
    >


        <div class="equipo-header">


            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                class="escudo-grande"
            >


            <h3 class="equipo-nombre color-santafe">

                Independiente Santa Fe

            </h3>


        </div>


        <h4 class="equipo-subtitulo">

            Plantilla de Jugadores

        </h4>


        <div
            class="sub-panel"
            id="jugadores-sf"
        >

            <h4>
                Arqueros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_arqueros.png"
                class="foto-grupo"
            >


            <h4>
                Defensas
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_defensas.png"
                class="foto-grupo"
            >


            <h4>
                Volantes
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_volantes.png"
                class="foto-grupo"
            >


            <h4>
                Delanteros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_delanteros.png"
                class="foto-grupo"
            >


        </div>


        <h4 class="equipo-subtitulo">

            Cuerpo Técnico

        </h4>


        <div
            class="sub-panel"
            id="tecnico-sf"
        >

            <h4>
                Cuerpo Técnico
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_cuerpo_tecnico.png"
                class="foto-grupo"
            >


            <h4>
                Cuerpo Médico
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_cuerpo_medico.png"
                class="foto-grupo"
            >


            <h4>
                Utilería
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_utileria.png"
                class="foto-grupo"
            >


        </div>


        <h4 class="equipo-subtitulo">

            Jugadores Destacados

        </h4>


        <div
            class="sub-panel"
            id="destacados-sf"
        >

            <div class="destacados-galeria">


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_destacado1.png"
                    class="foto-destacado"
                >


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_destacado2.png"
                    class="foto-destacado"
                >


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_destacado3.png"
                    class="foto-destacado"
                >


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/sf_destacado4.png"
                    class="foto-destacado"
                >


            </div>

        </div>


        <h4 class="equipo-subtitulo">

            Títulos Obtenidos

        </h4>


        <div
            class="sub-panel"
            id="titulos-sf"
        >

            <ul class="titulos-lista">

                <li>
                    Liga Colombiana:
                    <strong>10 títulos</strong>
                </li>

                <li>
                    Copa Colombia:
                    <strong>2 títulos</strong>
                </li>

                <li>
                    Superliga:
                    <strong>4 títulos</strong>
                </li>

                <li>
                    Copa Sudamericana:
                    <strong>1 título</strong>
                </li>

            </ul>


        </div>


    </div>



    <!-- MILLONARIOS -->

    <div
        class="equipo-panel"
        id="panel-millonarios"
    >


        <div class="equipo-header">


            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                class="escudo-grande"
            >


            <h3 class="equipo-nombre color-millonarios">

                Millonarios FC

            </h3>


        </div>


        <h4 class="equipo-subtitulo">

            Plantilla de Jugadores

        </h4>


        <div
            class="sub-panel"
            id="jugadores-mi"
        >


            <h4>
                Arqueros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_arqueros.png"
                class="foto-grupo"
            >


            <h4>
                Defensas
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_defensas1.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_defensas2.png"
                class="foto-grupo"
            >


            <h4>
                Volantes
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_volantes1.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_volantes2.png"
                class="foto-grupo"
            >


            <h4>
                Delanteros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_delanteros1.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_delanteros2.png"
                class="foto-grupo"
            >


        </div>


        <h4 class="equipo-subtitulo">

            Cuerpo Técnico

        </h4>


        <div
            class="sub-panel"
            id="tecnico-mi"
        >


            <h4>
                Cuerpo Técnico
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_cuerpo_tecnico.png"
                class="foto-grupo"
            >


            <h4>
                Cuerpo Médico
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_cuerpo_medico.png"
                class="foto-grupo"
            >


            <h4>
                Utilería
            </h4>


            <div style="text-align:center">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_utileria.png"
                    class="foto-destacado"
                >

            </div>


        </div>


        <h4 class="equipo-subtitulo">

            Jugadores Destacados

        </h4>


        <div
            class="sub-panel"
            id="destacados-mi"
        >


            <div class="destacados-galeria">


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_destacado1.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_destacado2.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_destacado3.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_destacado4.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/mi_destacado5.png"
                    class="foto-destacado"
                >


            </div>


        </div>


        <h4 class="equipo-subtitulo">

            Títulos Obtenidos

        </h4>


        <div
            class="sub-panel"
            id="titulos-mi"
        >


            <ul class="titulos-lista">

                <li>
                    Liga Colombiana:
                    <strong>16 títulos</strong>
                    (incluyendo Torneo Apertura 2024)
                </li>

                <li>
                    Copa Colombia:
                    <strong>3 títulos</strong>
                </li>

                <li>
                    Superliga:
                    <strong>2 títulos</strong>
                </li>

                <li>
                    Copa Merconorte:
                    <strong>1 título</strong>
                </li>

            </ul>


        </div>


    </div>



    <!-- NACIONAL -->

    <div
        class="equipo-panel"
        id="panel-nacional"
    >


        <div class="equipo-header">


            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                class="escudo-grande"
            >


            <h3 class="equipo-nombre color-nacional">

                Atlético Nacional

            </h3>


        </div>


        <h4 class="equipo-subtitulo">

            Plantilla de Jugadores

        </h4>


        <div
            class="sub-panel"
            id="jugadores-na"
        >


            <h4>
                Arqueros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_arqueros.png"
                class="foto-grupo"
            >


            <h4>
                Defensas
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_defensas1.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_defensas2.png"
                class="foto-grupo"
            >


            <h4>
                Volantes
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_volantes1.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_volantes2.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_volantes3.png"
                class="foto-grupo"
            >


            <h4>
                Delanteros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_delanteros.png"
                class="foto-grupo"
            >


        </div>


        <h4 class="equipo-subtitulo">

            Cuerpo Técnico

        </h4>


        <div
            class="sub-panel"
            id="tecnico-na"
        >


            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_tecnico1.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_tecnico2.png"
                class="foto-grupo"
            >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_tecnico3.png"
                class="foto-grupo"
            >


        </div>


        <h4 class="equipo-subtitulo">

            Jugadores Destacados

        </h4>


        <div
            class="sub-panel"
            id="destacados-na"
        >


            <div class="destacados-galeria">


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_destacado1.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_destacado2.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_destacado3.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/na_destacado4.png"
                    class="foto-destacado"
                >


            </div>


        </div>


        <h4 class="equipo-subtitulo">

            Títulos Obtenidos

        </h4>


        <div
            class="sub-panel"
            id="titulos-na"
        >


            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/trofeos_nacional.png"
                class="foto-grupo"
                style="max-width:500px"
            >


            <p
                style="
                    text-align:center;
                    color:#2ecc71;
                    font-weight:700;
                    margin-top:10px;
                "
            >

                🏆 2025 — Tricampeón

            </p>


        </div>


    </div>



    <!-- MEDELLÍN -->

    <div
        class="equipo-panel"
        id="panel-medellin"
    >


        <div class="equipo-header">


            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                class="escudo-grande"
            >


            <h3 class="equipo-nombre color-medellin">

                Independiente Medellín

            </h3>


        </div>


        <h4 class="equipo-subtitulo">

            Plantilla de Jugadores

        </h4>


        <div
            class="sub-panel"
            id="jugadores-me"
        >


            <h4>
                Arqueros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_arqueros.png"
                class="foto-grupo"
            >


            <h4>
                Defensas
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_defensas.png"
                class="foto-grupo"
            >


            <h4>
                Volantes
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_volantes.png"
                class="foto-grupo"
            >


            <h4>
                Delanteros
            </h4>

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_delanteros.png"
                class="foto-grupo"
            >


        </div>


        <h4 class="equipo-subtitulo">

            Cuerpo Técnico

        </h4>


        <div
            class="sub-panel"
            id="tecnico-me"
        >

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_cuerpo_tecnico.png"
                class="foto-grupo"
            >

        </div>


        <h4 class="equipo-subtitulo">

            Jugadores Destacados

        </h4>


        <div
            class="sub-panel"
            id="destacados-me"
        >


            <div class="destacados-galeria">


                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_destacado1.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_destacado2.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_destacado3.png"
                    class="foto-destacado"
                >

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/me_destacado4.png"
                    class="foto-destacado"
                >


            </div>


        </div>


        <h4 class="equipo-subtitulo">

            Títulos Obtenidos

        </h4>


        <div
            class="sub-panel"
            id="titulos-me"
        >


            <ul class="titulos-lista">


                <li>

                    Categoría Primera A:

                    <strong>
                        6 títulos
                    </strong>

                    (1955, 1957, 2002-II, 2004-I,
                    2009-II, 2016-I)

                </li>


                <li>

                    Copa Colombia:

                    <strong>
                        3 títulos
                    </strong>

                    (1981, 2019, 2020)

                </li>


                <li>

                    Semifinalista Copa Libertadores:

                    <strong>
                        2003
                    </strong>

                </li>


            </ul>


        </div>


    </div>


</section>



<!-- ==================================================
     VALORES
================================================== -->

<section
    id="valores"
    class="seccion"
>


    <h2 class="seccion-titulo">

        Valores del Campeonato

    </h2>


    <div class="valores-grid">


        <div class="valor-card">

            <span class="valor-icono">
                🤝
            </span>

            <h4>
                Respeto
            </h4>

            <p>
                Hacia compañeros, rivales, árbitros,
                entrenadores y público. Aceptar decisiones
                arbitrales incluso si no se comparten.
            </p>

        </div>


        <div class="valor-card">

            <span class="valor-icono">
                👥
            </span>

            <h4>
                Trabajo en equipo
            </h4>

            <p>
                Colaboración y solidaridad dentro y fuera
                del campo. Comprender que el fútbol es
                un deporte colectivo.
            </p>

        </div>


        <div class="valor-card">

            <span class="valor-icono">
                🏅
            </span>

            <h4>
                Juego Limpio
            </h4>

            <p>
                Competir con honestidad y sin trampas.
                No buscar sacar ventaja a través de faltas
                o simulaciones.
            </p>

        </div>


        <div class="valor-card">

            <span class="valor-icono">
                📋
            </span>

            <h4>
                Disciplina
            </h4>

            <p>
                Puntualidad, cumplimiento de normas
                y reglas del campeonato.
            </p>

        </div>


        <div class="valor-card">

            <span class="valor-icono">
                💪
            </span>

            <h4>
                Responsabilidad
            </h4>

            <p>
                Cuidar el material, la cancha y el entorno.
            </p>

        </div>


    </div>


    <div class="socios-box">


        <h4>

            Socios y Aficionados

        </h4>


        <p>

            Los socios y aficionados son el alma
            del campeonato. Su apoyo, lealtad y pasión
            dan sentido a cada victoria y enseñan a
            levantarse tras cada derrota.

        </p>


    </div>


</section>



<!-- ==================================================
     DIVISOR ACTO 3
================================================== -->

<div class="acto-divisor">


    <span class="acto-divisor-num">

        Acto 3

    </span>


    <h2 class="acto-divisor-titulo">

        El Camino al Título

    </h2>


</div>



<!-- ==================================================
     CAMPEONATOS
================================================== -->

<section
    id="campeonatos"
    class="seccion seccion-oscura"
>


    <h2 class="seccion-titulo">

        Campeonatos Anteriores y Campeones

    </h2>


    <div class="campeonatos-grid">


        <div class="campeonato-card">

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                class="campeonato-escudo"
            >

            <span class="campeonato-anio">
                1989
            </span>

            <span class="campeonato-equipo color-nacional">
                Atl. Nacional
            </span>

        </div>


        <div class="campeonato-card">

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                class="campeonato-escudo"
            >

            <span class="campeonato-anio">
                2000
            </span>

            <span class="campeonato-equipo color-santafe">
                Santa Fe
            </span>

        </div>


        <div class="campeonato-card">

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                class="campeonato-escudo"
            >

            <span class="campeonato-anio">
                2005
            </span>

            <span class="campeonato-equipo color-millonarios">
                Millonarios
            </span>

        </div>


        <div class="campeonato-card">

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                class="campeonato-escudo"
            >

            <span class="campeonato-anio">
                2015
            </span>

            <span class="campeonato-equipo color-medellin">
                Ind. Medellín
            </span>

        </div>


        <div class="campeonato-card">

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                class="campeonato-escudo"
            >

            <span class="campeonato-anio">
                2016
            </span>

            <span class="campeonato-equipo color-nacional">
                Atl. Nacional
            </span>

        </div>


        <div class="campeonato-card">

            <img
                src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                class="campeonato-escudo"
            >

            <span class="campeonato-anio">
                2025
            </span>

            <span class="campeonato-equipo color-nacional">
                Atl. Nacional 🏆 Tricampeón
            </span>

        </div>


    </div>


</section>



<!-- ==================================================
     ENFRENTAMIENTOS
================================================== -->

<section
    id="enfrentamientos"
    class="seccion seccion-oscura"
>


    <h2 class="seccion-titulo">

        Enfrentamientos

    </h2>


    <h3 class="fase-titulo">

        Todos contra todos

    </h3>


    <div class="partidos-grid">


        <div class="partido-card">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                    class="escudo-xs"
                >

                Santa Fe

            </span>


            <span class="marcador">
                1 - 3
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                    class="escudo-xs"
                >

                Atl. Nacional

            </span>


        </div>


        <div class="partido-card">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                    class="escudo-xs"
                >

                Millonarios

            </span>


            <span class="marcador">
                1 - 2
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                    class="escudo-xs"
                >

                Ind. Medellín

            </span>


        </div>


        <div class="partido-card">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                    class="escudo-xs"
                >

                Atl. Nacional

            </span>


            <span class="marcador">
                4 - 3
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                    class="escudo-xs"
                >

                Millonarios

            </span>


        </div>


        <div class="partido-card">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                    class="escudo-xs"
                >

                Santa Fe

            </span>


            <span class="marcador">
                1 - 0
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                    class="escudo-xs"
                >

                Ind. Medellín

            </span>


        </div>


        <div class="partido-card">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                    class="escudo-xs"
                >

                Millonarios

            </span>


            <span class="marcador">
                1 - 3
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                    class="escudo-xs"
                >

                Santa Fe

            </span>


        </div>


        <div class="partido-card">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                    class="escudo-xs"
                >

                Ind. Medellín

            </span>


            <span class="marcador">
                1 - 4
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                    class="escudo-xs"
                >

                Atl. Nacional

            </span>


        </div>


    </div>



    <h3 class="fase-titulo">

        Semifinales

    </h3>


    <div class="partidos-grid">


        <div class="partido-card partido-eliminatoria">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_santafe.png"
                    class="escudo-xs"
                >

                Santa Fe

            </span>


            <span class="marcador">
                4 - 5
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                    class="escudo-xs"
                >

                Atl. Nacional

            </span>


        </div>


        <div class="partido-card partido-eliminatoria">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_millonarios.png"
                    class="escudo-xs"
                >

                Millonarios

            </span>


            <span class="marcador">
                1 - 3
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                    class="escudo-xs"
                >

                Ind. Medellín

            </span>


        </div>


    </div>



    <h3 class="fase-titulo">

        Final

    </h3>


    <div class="partidos-grid">


        <div class="partido-card partido-final">

            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_medellin.png"
                    class="escudo-xs"
                >

                Ind. Medellín

            </span>


            <span class="marcador">
                4 - 6
            </span>


            <span class="equipo-vs">

                <img
                    src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional.png"
                    class="escudo-xs"
                >

                Atl. Nacional

            </span>


        </div>


    </div>


</section>



<!-- ==================================================
     DIVISOR ACTO 4
================================================== -->

<div class="acto-divisor">


    <span class="acto-divisor-num">

        Acto 4

    </span>


    <h2 class="acto-divisor-titulo">

        Detrás de Cámaras

    </h2>


</div>



<!-- ==================================================
     ENTRENAMIENTOS
================================================== -->

<section
    id="entrenamientos"
    class="seccion seccion-oscura"
>


    <h2 class="seccion-titulo">

        Entrenamientos

    </h2>


    <div class="entrenamientos-grid">


        <div class="entrena-card">

            <span class="entrena-icono">
                🏋️
            </span>


            <h4>
                Físico
            </h4>


            <p>

                El entrenamiento físico se refiere a
                la práctica regular y sistemática de
                actividades físicas con el objetivo de
                mejorar o mantener la condición física,
                la salud y el rendimiento deportivo.

            </p>


        </div>


        <div class="entrena-card">

            <span class="entrena-icono">
                ⚽
            </span>


            <h4>
                Balón parado
            </h4>


            <p>

                Balón parado se refiere a cualquier
                jugada en la que el juego se reanuda
                desde una posición fija. Es una parte
                clave del juego porque muchas veces
                define partidos.

            </p>


        </div>


    </div>


</section>



<!-- ==================================================
     CAMPEÓN
================================================== -->

<div class="campeon-box">


    <h2>

        🏆 ¡Gran Campeón!

    </h2>


    <img
        src="/OLIMPIADAS_DEPORTIVAS/vista/img/escudo_nacional_grande.png"
        class="escudo-campeon"
    >


    <h1 class="color-nacional">

        Atlético Nacional

    </h1>


</div>



<!-- ==================================================
     FOOTER
================================================== -->

<footer class="footer">


    <div class="footer-contenido">


        <p>

            Muchas gracias por ser parte
            de nuestras Olimpiadas Deportivas

        </p>


        <a
            href="https://wa.me/573011990156"
            class="btn btn-whatsapp"
            target="_blank"
        >

            📱 WhatsApp: 301 199 0156

        </a>


        <p class="footer-copy">

            &copy;

            <span id="anio"></span>

            Olimpiadas Deportivas

        </p>


    </div>


</footer>



<script src="/OLIMPIADAS_DEPORTIVAS/vista/js/script.js"></script>


</body>

</html>