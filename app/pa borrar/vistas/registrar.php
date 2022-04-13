<?php ob_start() ?>
<?php MensajesFlash::imprimir_mensajes() ?>
<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <div class="col-sm-8 col-11">

        <form action="" method="post" enctype="multipart/form-data" 
            style="justify-content: center; align-items: center">
            <fieldset class=" border border-primary" style="border-radius: 35px; background-color:#CCCCCC" >
                <div style="paddin:20px; margin:20px">
                    <legend class="text-center">Formulario de Registro de Usuarios Nuevos</legend>

                    <input type="hidden" name="token" value="<?= $token ?>">
                    <div class="mb-3" style="justify-content: center; align-items: center">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" placeholder="Introduce aqui tu nombre" class="form-control"
                            aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3" style="justify-content: center; align-items: center">
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="surname" placeholder="Introduce aqui tus apellidos"
                            class="form-control" aria-describedby="surnameHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email/Direccion de correo electrónico</label>
                        <input type="email" name="email" placeholder="Introduce aqui tu em@il" class="form-control"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Nunca compartas tu email con nadie</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Introduce aqui tu password">
                        <div id="passwordHelp" class="form-text">Pon una Contraseña Segura: Con al menos 8 caracteres,
                            Mayusculas y minusculas</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto del Usuario</label>
                        <input type="file" name="photo" class="form-control" accept="image/*"
                            aria-describedby="photoHelp">
                        <div id="photoHelp" class="form-text">Añade aqui tu foto</div>
                    </div>
                    <div style="justify-content:center; align-items:center">
                        <button type="submit" value="registrar" class="btn btn-primary w-75">Registrar Usuario</button>
                    </div>
                </div>
        </form>
    </div>
</div>



<?php
$contenido = ob_get_clean();
$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
$titulo2 = "Registrar Usuario Nuevo";
require 'template.php';
?>