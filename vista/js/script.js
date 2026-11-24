document.addEventListener("DOMContentLoaded", function () {

    // ===== Año dinámico en el footer =====
    const anioSpan = document.getElementById("anio");
    if (anioSpan) anioSpan.textContent = new Date().getFullYear();

    // ===== Menú hamburguesa (responsive) =====
    const menuToggle = document.getElementById("menu-toggle");
    const navbarLinks = document.getElementById("navbar-links");
    if (menuToggle && navbarLinks) {
        menuToggle.addEventListener("click", function () {
            navbarLinks.classList.toggle("abierto");
        });
        // Cerrar menú al hacer clic en un enlace
        navbarLinks.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                navbarLinks.classList.remove("abierto");
            });
        });
    }

    // ===== Selector de equipo: resalta el botón del equipo visible al hacer scroll =====
    const equipoTabs = document.querySelectorAll(".equipo-tab");
    const equipoPaneles = document.querySelectorAll(".equipo-panel");

    if (equipoTabs.length && equipoPaneles.length && "IntersectionObserver" in window) {
        const observerEquipos = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const equipoId = entry.target.id.replace("panel-", "");
                    equipoTabs.forEach(function (t) {
                        t.classList.toggle("activo", t.dataset.equipo === equipoId);
                    });
                }
            });
        }, { rootMargin: "-40% 0px -50% 0px" });
        equipoPaneles.forEach(function (panel) { observerEquipos.observe(panel); });
    }

    // ===== Selector de avatar (imágenes reales) =====
    const avatarOpciones = document.querySelectorAll(".avatar-opcion");
    const avatarInput = document.getElementById("avatar-input");
    const avatarPreview = document.getElementById("avatar-preview");

    avatarOpciones.forEach(function (opcion) {
        opcion.addEventListener("click", function () {
            avatarOpciones.forEach(function (o) { o.classList.remove("activo"); });
            this.classList.add("activo");
            const avatarId = this.dataset.avatar;
            if (avatarInput) avatarInput.value = avatarId;
            if (avatarPreview) avatarPreview.src = "vista/img/" + avatarId + ".png";
        });
    });

    // ===== Modal de recuperar contraseña =====
    const btnRecuperar = document.getElementById("btn-recuperar");
    const modal = document.getElementById("modal-recuperar");
    const cerrarModal = document.getElementById("cerrar-modal");
    const formRecuperar = document.getElementById("form-recuperar");
    const msgRecuperar = document.getElementById("msg-recuperar");

    if (btnRecuperar && modal) {
        btnRecuperar.addEventListener("click", function (e) {
            e.preventDefault();
            modal.classList.remove("oculto");
        });
        cerrarModal.addEventListener("click", function () {
            modal.classList.add("oculto");
        });
        modal.addEventListener("click", function (e) {
            if (e.target === modal) modal.classList.add("oculto");
        });
        formRecuperar.addEventListener("submit", function (e) {
            e.preventDefault();
            formRecuperar.classList.add("oculto");
            msgRecuperar.classList.remove("oculto");
        });
    }

    // ===== Validación del formulario de registro =====
    const formRegistro = document.getElementById("form-registro");
    if (formRegistro) {
        formRegistro.addEventListener("submit", function (e) {
            const contrasena = document.getElementById("contrasena").value;
            const confirmar = document.getElementById("confirmar_contrasena").value;
            if (contrasena !== confirmar) {
                e.preventDefault();
                alert("Las contraseñas no coinciden.");
            }
            if (contrasena.length < 6) {
                e.preventDefault();
                alert("La contraseña debe tener al menos 6 caracteres.");
            }
        });
    }

    // ===== Validación del formulario de login =====
    const formLogin = document.getElementById("form-login");
    if (formLogin) {
        formLogin.addEventListener("submit", function (e) {
            const correo = document.getElementById("correo").value.trim();
            const contrasena = document.getElementById("contrasena").value;
            if (!correo || !contrasena) {
                e.preventDefault();
                alert("Por favor completa todos los campos.");
            }
        });
    }

});
