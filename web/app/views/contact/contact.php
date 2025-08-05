<?php
// /c:/xampp/htdocs/proyectoFinal/web/app/views/contact/contact.php

// Incluye el array de provincias
include 'comun/provincias.php';
?>

<form id="formulario" action="/formulario/enviar_formulario.php" method="post" class="mt-3">
    <div class="form-floating mb-3">
        <input name="name" type="text" class="form-control" id="fullname" placeholder="Nombre y Apellidos">
        <label for="fullname" class="form-label">Nombre y Apellidos</label>
    </div>
    <div class="form-floating mb-3">
        <input name="email" type="email" class="form-control" id="email" placeholder="Correo Electrónico">
        <label for="email" class="form-label">Correo Electrónico</label>
    </div>
    <div class="form-floating mb-3">
        <input name="subject" type="text" class="form-control" id="subject" placeholder="Asunto">
        <label for="subject" class="form-label">Asunto</label>
    </div>
    <div class="form-floating custom-textarea mb-3">
        <textarea name="message" class="form-control" id="message" placeholder="Mensaje"></textarea>
        <label for="message">Mensaje</label>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" value="" id="privacidad" required>
                <label for="privacidad" class="form-check-label">
                    Acepto la <a href="#" data-bs-toggle="modal" data-bs-target="#politicaPrivacidadModal">Política de Privacidad</a>.
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="g-recaptcha" data-sitekey="6LcD97InAAAAACH869YoKiF5vo4LfgGHZMVhCX1q" data-callback="enableSubmitButton" data-expired-callback="disableSubmitButton" aria-hidden="true"></div>
        </div>
    </div>
    <div class="row mt-3 mb-3 text-center justify-content-center">
        <div class="col-6 d-grid">
            <button id="btn-enviar" class="btn btn-primary" disabled>Enviar</button>
        </div>
    </div>
    <div id="mensaje-exito"></div>
</form>

<!-- Modal para Política de Privacidad -->
<div class="modal fade" id="politicaPrivacidadModal" tabindex="-1" aria-labelledby="politicaPrivacidadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="politicaPrivacidadModalLabel">Política de Privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php include 'politica_de_privacidad.php'; ?>
                <div class="modal-footer">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="acceptPrivacyModal">
                        <label class="form-check-label" for="acceptPrivacyModal">
                            Acepto la Política de Privacidad
                        </label>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="closePrivacyModal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
function enableSubmitButton() {
    document.getElementById("btn-enviar").disabled = false;
}
function disableSubmitButton() {
    document.getElementById("btn-enviar").disabled = true;
}
function sanitizeString(str) {
    var temp = document.createElement('div');
    temp.textContent = str;
    return temp.innerHTML;
}
function resetClasses() {
    var formElements = document.getElementById("formulario").elements;
    for (var i = 0; i < formElements.length; i++) {
        formElements[i].classList.remove("valid");
        formElements[i].classList.remove("invalid");
    }
}
function clearSystemMessage() {
    setTimeout(function() {
        if(document.getElementById("system-message"))
            document.getElementById("system-message").innerHTML = "";
    }, 10000);
}
function sendForm(){
    var formData = new FormData(document.getElementById("formulario"));
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/formulario/enviar_formulario.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("mensaje-exito").innerHTML = "<div class='alert alert-success' role='alert'>Mensaje enviado con éxito. Nos pondremos en contacto contigo lo antes posible.</div>";
            if(document.getElementById("system-message"))
                document.getElementById("system-message").innerHTML = "<div class='alert alert-success' role='alert'>Mensaje enviado con éxito. Nos pondremos en contacto contigo lo antes posible.</div>";
            document.getElementById("formulario").reset();
            resetClasses();
            clearSystemMessage();
        }
    };
    xhr.send(formData);
}
document.getElementById("btn-enviar").addEventListener("click", function(event) {
    event.preventDefault();
    var nombre = sanitizeString(document.getElementById("fullname").value);
    var email = document.getElementById("email").value;
    var subject = sanitizeString(document.getElementById("subject").value);
    var message = sanitizeString(document.getElementById("message").value);
    var errores = "";

    if(nombre.trim() == "") {
        errores += "El nombre no puede estar vacío.<br>";
        document.getElementById("fullname").classList.add("invalid");
        document.getElementById("fullname").classList.remove("valid");
    } else {
        document.getElementById("fullname").classList.add("valid");
        document.getElementById("fullname").classList.remove("invalid");
    }
    if(email.trim() == "") {
        errores += "El email no puede estar vacío.<br>";
        document.getElementById("email").classList.add("invalid");
        document.getElementById("email").classList.remove("valid");
    } else if(!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(email)) {
        errores += "El email no es válido.<br>";
        document.getElementById("email").classList.add("invalid");
        document.getElementById("email").classList.remove("valid");
    } else {
        document.getElementById("email").classList.add("valid");
        document.getElementById("email").classList.remove("invalid");
    }
    if(subject.trim() == "") {
        errores += "El asunto no puede estar vacío.<br>";
        document.getElementById("subject").classList.add("invalid");
        document.getElementById("subject").classList.remove("valid");
    } else {
        document.getElementById("subject").classList.add("valid");
        document.getElementById("subject").classList.remove("invalid");
    }
    if(message.trim().length < 20) {
        errores += "Debe escribir al menos 20 caracteres en el mensaje.<br>";
        document.getElementById("message").classList.add("invalid");
        document.getElementById("message").classList.remove("valid");
    } else {
        document.getElementById("message").classList.add("valid");
        document.getElementById("message").classList.remove("invalid");
    }
    if(!document.getElementById("privacidad").checked) {
        errores += "Debe aceptar la política de privacidad.<br>";
        document.getElementById("privacidad").classList.add("invalid");
        document.getElementById("privacidad").classList.remove("valid");
    } else {
        document.getElementById("privacidad").classList.add("valid");
        document.getElementById("privacidad").classList.remove("invalid");
    }
    if(errores != "") {
        document.getElementById("mensaje-exito").innerHTML = "<div class='alert alert-danger display-flex' role='alert'>" + errores + "</div>";
        if(document.getElementById("system-message"))
            document.getElementById("system-message").innerHTML = "<div class='alert alert-danger display-flex' role='alert'>" + errores + "</div>";
        clearSystemMessage();
    } else {
        sendForm();
    }
});

// JQuery para marcar la casilla de aceptación de política de Privacidad automáticamente
document.addEventListener("DOMContentLoaded", function() {
    var acceptPrivacyModal = document.getElementById("acceptPrivacyModal");
    var privacidad = document.getElementById("privacidad");
    var closePrivacyModal = document.getElementById("closePrivacyModal");
    if(acceptPrivacyModal && privacidad) {
        acceptPrivacyModal.addEventListener("change", function() {
            privacidad.checked = this.checked;
        });
    }
    if(closePrivacyModal && acceptPrivacyModal && privacidad) {
        closePrivacyModal.addEventListener("click", function() {
            if(acceptPrivacyModal.checked) {
                privacidad.checked = true;
            }
        });
    }
});
</script>