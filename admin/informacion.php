<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar información | Olimpiadas Deportivas</title>

    <link rel="stylesheet" href="../css/styles.css">

</head>

<body class="pagina-auth">

    <div class="auth-contenedor">

        <div class="auth-card">

            <div class="auth-logo">
                ⚽
            </div>

            <h2>Olimpiadas Deportivas</h2>

            <h3>Editar información general</h3>


            <?php if (!empty($mensaje)): ?>

                <div class="alerta <?php echo (isset($tipoMensaje) && $tipoMensaje === 'exito') ? 'alerta-exito' : 'alerta-error'; ?>">

                    <p>
                        <?php echo htmlspecialchars($mensaje); ?>
                    </p>

                </div>

            <?php endif; ?>


            <?php if (!empty($datos)): ?>

                <form action="admin_informacion.php" method="POST">

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo htmlspecialchars($datos['id']); ?>"
                    >


                    <label for="titulo">
                        Título
                    </label>

                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        value="<?php echo htmlspecialchars($datos['titulo']); ?>"
                        required
                    >


                    <label for="subtitulo">
                        Subtítulo
                    </label>

                    <input
                        type="text"
                        id="subtitulo"
                        name="subtitulo"
                        value="<?php echo htmlspecialchars($datos['subtitulo']); ?>"
                        required
                    >


                    <label for="descripcion">
                        Descripción
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="6"
                        required
                    ><?php echo htmlspecialchars($datos['descripcion']); ?></textarea>


                    <button
                        type="submit"
                        class="btn btn-primary btn-block"
                    >
                        Guardar cambios
                    </button>

                </form>

            <?php else: ?>

                <div class="alerta alerta-error">

                    <p>
                        No se encontró información para editar.
                    </p>

                </div>

            <?php endif; ?>


            <div class="auth-links">

                <a href="../dashboard.php">
                    Volver al panel
                </a>

                <a href="../../index.php">
                    Ver página pública
                </a>

            </div>

        </div>

    </div>

</body>

</html>