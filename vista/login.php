<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Olimpiadas Deportivas</title>
    <link rel="stylesheet" href="vista/css/styles.css">
</head>
<body class="pagina-auth">

    <div class="auth-contenedor">
        <div class="auth-card">
            <div class="auth-logo">⚽</div>
            <h2>Olimpiadas Deportivas</h2>
            <h3>Iniciar sesión</h3>

            <?php if (!empty($_GET['registrado'])): ?>
                <div class="alerta alerta-exito">
                    <p>¡Cuenta creada con éxito! Ahora inicia sesión.</p>
                </div>
            <?php endif; ?>

            <?php if (!empty($errores)): ?>
                <div class="alerta alerta-error">
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" id="form-login">
                <label for="correo">Usuario (correo)</label>
                <input type="email" id="correo" name="correo" placeholder="tucorreo@ejemplo.com" required>

                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="••••••" required>

                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </form>

            <div class="auth-links">
                <a href="registro.php">Registro</a>
                <a href="#" id="btn-recuperar">Recuperar contraseña</a>
            </div>
        </div>
    </div>

    <!-- Modal de recuperar contraseña -->
    <div id="modal-recuperar" class="modal oculto">
        <div class="modal-contenido">
            <span class="modal-cerrar" id="cerrar-modal">&times;</span>
            <h3>Recuperar contraseña</h3>
            <p>Ingresa tu correo electrónico y te enviaremos las instrucciones para restablecer tu contraseña.</p>
            <form id="form-recuperar">
                <label for="correo-recuperar">Correo electrónico</label>
                <input type="email" id="correo-recuperar" placeholder="tucorreo@ejemplo.com" required>
                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            </form>
            <div id="msg-recuperar" class="oculto alerta alerta-exito">
                <p>Si el correo está registrado, recibirás las instrucciones.</p>
            </div>
        </div>
    </div>

    <script src="vista/js/script.js"></script>
</body>
</html>
