<?php 
    @session_start();
?>
<style type="text/css">
    #msjInactividad {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 2000;
        cursor: pointer;
    }
</style>
<div id="msjInactividad">
    <div style="height:auto; width:400px; background-color: white; position: fixed; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); padding: 10px; text-align: center;"> 
        <div>
            <b>Se ha detectado INACTIVIDAD en la plataforma. Por lo que, por motivos de seguridad su sesión cerrará pronto: </b>
            <br>
            <font style="text-align: center; font-size: 20px;"><b>00:</span><span id="time">59</span></b></font>
        </div>
    </div>
</div> 
<script>
    let conteoSegundos = 60;
    let conteoMinutos = 0;
    let contadorReg;
    let checkSesion = "0";
    let flgRefreshSesion = 0;
    let flgCerrarAutomatico = 0;

    $(document).ready(function () {
        $(window).click(function () {
            conteoMinutos = 0;

            $('#msjInactividad').hide();
            checkSesion = '<?php echo $_SESSION["flgInactivo"]; ?>';

            if(checkSesion=="1") {
                location.href='<?php echo $_POST["lurl"]; ?>contenido/logica/cerrarSesion?flg=1';
            } else {
            }

            if(flgRefreshSesion == 1) {
                fnRefresh();
                flgRefreshSesion = 0;
            } else {
            }
        });
        $(window).keypress(function () {
            conteoMinutos = 0;

            $('#msjInactividad').hide();
            checkSesion = '<?php echo $_SESSION["flgInactivo"]; ?>';

            if(checkSesion=="1") {
                location.href='<?php echo $_POST["lurl"]; ?>contenido/logica/cerrarSesion?flg=1';
            } else {
            }

            if(flgRefreshSesion == 1) {
                fnRefresh();
                flgRefreshSesion = 0;
            } else {
            }
        });
        $(window).mousemove(function () {
            conteoMinutos = 0;

            $('#msjInactividad').hide();
            checkSesion = '<?php echo $_SESSION["flgInactivo"]; ?>';

            if(checkSesion=="1") {
                location.href='<?php echo $_POST["lurl"]; ?>contenido/logica/cerrarSesion?flg=1';
            } else {
            }

            if(flgRefreshSesion == 1) {
                fnRefresh();
                flgRefreshSesion = 0;
            } else {
            }
        });
        $(window).scroll(function () {
            conteoMinutos = 0;

            $('#msjInactividad').hide();
            checkSesion = '<?php echo $_SESSION["flgInactivo"]; ?>';

            if(checkSesion=="1") {
                location.href='<?php echo $_POST["lurl"]; ?>contenido/logica/cerrarSesion?flg=1';
            } else {
            }

            if(flgRefreshSesion == 1) {
                fnRefresh();
                flgRefreshSesion = 0;
            } else {
            }
        });

        let intervaloTiempo = setInterval(conteoTiempo, 60000); // 1min check
    });

    function fnRefresh() {
        let url = '<?php echo $_POST["lurl"]; ?>contenido/logica/actualizarSesion';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                x: ''
            },
            success: function(data) {
                //
            }
        });
    }

    function conteoTiempo() {
        conteoMinutos = conteoMinutos + 1;

        if(conteoMinutos > 8) { // 9 
            if(flgCerrarAutomatico == 0) {
                fnRefresh();
                flgRefreshSesion = 1;
                conteoMinutos = 0;
            } else {
                $('#msjInactividad').show();
                iniciarConteo();
                flgRefreshSesion = 0;
            } 
        } else {
        }

        if (conteoMinutos > 9) { // 10
            location.href='<?php echo $_POST["lurl"]; ?>contenido/logica/cerrarSesion?flg=1';
        } else {
        }
    }

    function iniciarConteo() {
        contadorReg = setInterval(countDownFn, 1000);
    }

    function countDownFn() {
        conteoSegundos = conteoSegundos - 1
        if(conteoSegundos < 10) {
            $('#time').text("0" + conteoSegundos);
        } else {
            $('#time').text(conteoSegundos);
        }
        if (conteoSegundos == 0) {
            conteoSegundos = 60;
            clearInterval(contadorReg);
        } else {
        }
    }
</script>