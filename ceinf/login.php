<?php 
    @session_start();
    if(isset($_SESSION["credencialId"])) {
        header("Location: /ceinf/aplicacion/");
    } else {
    }
    $fhActual = date("Y-m-d H:i:s");

    if(!isset($_SESSION["intentosLogin"])) {
        $_SESSION["intentosLogin"] = 0;
    } else {
        //$_SESSION["intentosLogin"] = 0;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="librerias/imagenes/favicon.ico" type="image/ico" />
     
        <title>Inicio de Sesión - CEINF</title>

        <link href="librerias/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="librerias/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="librerias/nprogress/nprogress.css" rel="stylesheet">
        <link href="librerias/animate.css/animate.min.css" rel="stylesheet">
        <link href="librerias/css/custom.min.css" rel="stylesheet">
        <link href="librerias/alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="librerias/alertify/themes/alertify.default.css" rel="stylesheet">
    </head>

    <body class="login">
        <?php 
            if($_SESSION["intentosLogin"] <= 5) {
        ?>
            <div>
                <a class="hiddenanchor" id="signup"></a>
                <a class="hiddenanchor" id="signin"></a>

                <div class="login_wrapper">
                    <div class="animate form login_form">
                        <section class="login_content">
                            <form id="frmLogin" class="form-label-left input_mask" method="post">
                                <h1>Inicio de Sesión</h1>
                                <div class="row">
                                    <div class="col-12 form-group has-feedback">
                                        <input type="text" id="usuarioLogin" name="usuarioLogin" class="form-control has-feedback-left" placeholder="Usuario" required>
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-12 form-group has-feedback">
                                        <input type="password" id="passLogin" name="passLogin" class="form-control has-feedback-left" placeholder="Contraseña" required>
                                        <span id="showHidePass" class="fa fa-eye form-control-feedback left" aria-hidden="true" style="cursor: pointer;"></span>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" id="btnLogin" class="btn btn-primary">Iniciar Sesión</button>
                                    <a class="reset_pass" href="#">¿Ha olvidado su contraseña?</a>
                                </div>

                                <div class="clearfix"></div>

                                <div class="separator">
                                    <p class="change_link">
                                        <a href="#signup" class="to_register">Solicitar nueva cuenta</a>
                                    </p>

                                    <div class="clearfix"></div>
                                    <br />

                                    <div>
                                        <h1><i class="fa fa-desktop"></i> Departamento de Informática</h1>
                                        <p>© CEINF - Hospital Militar | <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>

                    <div id="register" class="animate form registration_form">
                        <section class="login_content">
                            <form id="frmRegister">
                                <h1>Solicitud de acceso</h1>
                                <div>
                                    <input type="text" id="carnet" name="carnet" class="form-control" placeholder="Carnet" required />
                                </div>
                                <div>
                                    <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Nombres" required />
                                </div>
                                <div>
                                    <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos" required />
                                </div>
                                <div>
                                    <input type="text" id="cargo" name="cargo" class="form-control" placeholder="Cargo" required />
                                </div>
                                <div>
                                    <input type="text" id="departamento" name="departamento" class="form-control" placeholder="Departamento" required />
                                </div>
                                <br>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Enviar solicitud
                                    </button>
                                </div>

                                <div class="clearfix"></div>

                                <div class="separator">
                                    <p class="change_link">¿Ya tiene una cuenta?
                                        <a href="#signin" class="to_register">Iniciar sesión</a>
                                    </p>

                                    <div class="clearfix"></div>
                                    <br />

                                    <div>
                                        <h1><i class="fa fa-desktop"></i> Departamento de Informática</h1>
                                        <p>© CEINF - Hospital Militar | <?php echo date("Y"); ?></p>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="librerias/js/jquery19.min.js"></script>
            <script type="text/javascript" src="librerias/js/validate-frm.min.js"></script>
            <script type="text/javascript" src="librerias/alertify/lib/alertify.min.js"></script>
            <script>
                function button_icons(btnId, icon, txt, prop, propValue) {
                    $('#' + btnId).html('<i class="' + icon + '"></i> ' + txt);
                    $('#' + btnId).prop(prop, propValue);
                }

                $(document).ready(function(){
                    $("#showHidePass").click(function() {
                        if($(this).hasClass("fa fa-eye form-control-feedback left")) {
                            $(this).removeClass("fa fa-eye form-control-feedback left");
                            $(this).addClass("fa fa-eye-slash form-control-feedback left");
                            $("#passLogin").attr("type", "text");
                        } else {
                            $(this).removeClass("fas fa-eye-slash form-control-feedback left");
                            $(this).addClass("fa fa-eye form-control-feedback left");
                            $("#passLogin").attr("type", "password");
                        }
                    });

                    $("#frmLogin").validate({
                        submitHandler: function(form) {
                            $.post(
                                "librerias/contenido/logica/validarCredenciales", 
                                $.param($("#frmLogin").serializeArray()), 
                                function(data) {
                                    if(data == "aprobado") {
                                        location.href = "aplicacion/";
                                    } else {
                                        let arrayData = data.split("/");
                                        if(arrayData[0] == "bloqueado") {
                                            location.reload();
                                        } else {
                                            alertify.set({labels: {ok: "Aceptar"}});
                                            alertify.alert(arrayData[1]);   
                                        }
                                    }
                                }
                            );  
                        }
                    });
                    $("#frmRegister").validate({
                        submitHandler: function(form) {
                            $.post(
                                "librerias/contenido/logica/solicitudAcceso", 
                                $.param($("#frmRegister").serializeArray()), 
                                function(data) {
                                    if(data == "aprobado") {
                                        alertify.set({labels: {ok: "Aceptar"}});
                                        alertify.alert("Su solicitud ha sido recibida y enviada a proceso de revisión");   
                                        $('#frmRegister').trigger("reset");
                                    } else {
                                        alertify.set({labels: {ok: "Aceptar"}});
                                        alertify.alert(data);  
                                        $('#frmRegister').trigger("reset"); 
                                    }
                                }
                            );  
                        }
                    });
                });
            </script>
        <?php 
            } else {
        ?>
                <div>
                    <a class="hiddenanchor" id="signin"></a>

                    <div class="login_wrapper">
                        <div class="animate form login_form">
                            <section class="login_content">
                                <form class="form-label-left input_mask" method="post">
                                    <h1>Inicio de Sesión</h1>
                                    <div class="row">
                                        <div class="col-12 form-group has-feedback">
                                            <input type="text" id="usuarioLogin" name="usuarioLogin" class="form-control has-feedback-left" placeholder="Usuario" disabled>
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-12 form-group has-feedback">
                                            <input type="password" id="passLogin" name="passLogin" class="form-control has-feedback-left" placeholder="Contraseña" disabled>
                                            <span id="showHidePass" class="fa fa-eye form-control-feedback left" aria-hidden="true" style="cursor: pointer;"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" id="btnLogin" class="btn btn-primary" disabled>Iniciar Sesión</button>
                                        <a class="reset_pass" href="#">¿Ha olvidado su contraseña?</a>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="separator">
                                        <p class="change_link">
                                            <a href="#" class="to_register" disabled>Solicitar nueva cuenta</a>
                                        </p>

                                        <div class="clearfix"></div>
                                        <br />

                                        <div>
                                            <h1><i class="fa fa-desktop"></i> Departamento de Informática</h1>
                                            <p>© CEINF - Hospital Militar | <?php echo date("Y"); ?></p>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
        <?php 
            }
        ?>
    </body>
</html>