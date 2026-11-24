<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Olimpiadas Deportivas</title>
    <link rel="stylesheet" href="vista/css/styles.css">
</head>
<body class="pagina-auth">

    <div class="auth-contenedor">
        <div class="auth-card auth-card-registro">
            <div class="auth-logo">⚽</div>
            <h2>Olimpiadas Deportivas</h2>
            <h3>Crear cuenta</h3>

            <?php if (!empty($errores)): ?>
                <div class="alerta alerta-error">
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST" id="form-registro">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre ?? ''); ?>" placeholder="Tu nombre" required>

                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo ?? ''); ?>" placeholder="tucorreo@ejemplo.com" required>

                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Mínimo 6 caracteres" required minlength="6">

                <label for="confirmar_contrasena">Confirmar contraseña</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Repite tu contraseña" required minlength="6">

                <label class="label-avatar"><img src="vista/img/avatar_central.png" class="icono-avatar-label" alt=""> Elige tu avatar</label>
                <div class="avatar-preview-box">
                    <img src="vista/img/avatar1.png" id="avatar-preview" alt="Avatar seleccionado">
                    <p>Tu selección</p>
                </div>
                <div class="avatar-selector">
                    <div class="avatar-opcion activo" data-avatar="avatar1"><img src="vista/img/avatar1.png" alt="Avatar 1"></div>
                    <div class="avatar-opcion" data-avatar="avatar2"><img src="vista/img/avatar2.png" alt="Avatar 2"></div>
                    <div class="avatar-opcion" data-avatar="avatar3"><img src="vista/img/avatar3.png" alt="Avatar 3"></div>
                    <div class="avatar-opcion" data-avatar="avatar4"><img src="vista/img/avatar4.png" alt="Avatar 4"></div>
                    <div class="avatar-opcion" data-avatar="avatar5"><img src="vista/img/avatar5.png" alt="Avatar 5"></div>
                    <div class="avatar-opcion" data-avatar="avatar6"><img src="vista/img/avatar6.png" alt="Avatar 6"></div>
                    <div class="avatar-opcion" data-avatar="avatar7"><img src="vista/img/avatar7.png" alt="Avatar 7"></div>
                    <div class="avatar-opcion" data-avatar="avatar8"><img src="vista/img/avatar8.png" alt="Avatar 8"></div>
                    <div class="avatar-opcion" data-avatar="avatar9"><img src="vista/img/avatar9.png" alt="Avatar 9"></div>
                    <div class="avatar-opcion" data-avatar="avatar10"><img src="vista/img/avatar10.png" alt="Avatar 10"></div>
                    <div class="avatar-opcion" data-avatar="avatar11"><img src="vista/img/avatar11.png" alt="Avatar 11"></div>
                </div>
                <input type="hidden" name="avatar" id="avatar-input" value="avatar1">

                <button type="submit" class="btn btn-primary btn-block">Registrarme</button>

                <p class="auth-footer">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </form>
        </div>
    </div>

    <script src="vista/js/script.js"></script>
</body>
</html>
