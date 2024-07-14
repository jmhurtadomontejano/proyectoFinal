<?php
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>

<div class="body d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <div>
        <div class="tx-center mg-b-60">Recuperar Contraseña</div>
        <form action="send_recovery_code" method="post">
            <input type="email" placeholder="Ingrese su correo electrónico" name="email" id="email" class="form-control" required>
            <section class="d-flex justify-content-evenly flex-wrap">
                <input type="submit" value="Enviar Código de Recuperación" id="btnSendCode" class="btn btn-info btn-block col-12">
            </section>
        </form>
    </div>
</div>

<script src="public/lib/jquery/jquery.js"></script>
