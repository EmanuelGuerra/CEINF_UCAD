<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="librerias/imagenes/favicon.ico" type="image/ico" />
     
        <title>Sesión finalizada - CEINF</title>

        <link href="librerias/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="librerias/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="librerias/nprogress/nprogress.css" rel="stylesheet">
        <link href="librerias/animate.css/animate.min.css" rel="stylesheet">
        <link href="librerias/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
                <div>
                    <div class="login_wrapper">
                        <div class="animate form login_form">
                            <section class="login_content">
                                <form class="form-label-left input_mask" method="post">
                                    <h1>Sesión finalizada</h1>
                                    <div class="row">
                                        <div class="col-12 form-group has-feedback">
                                            <h5>Se ha detectado un tiempo de inactividad superior a 10 minutos, por lo que su sesión ha sido finalizada automáticamente</h5>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="separator">
                                        <p class="change_link">
                                            <a href="login">Volver a iniciar sesión</a>
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
    </body>
</html>