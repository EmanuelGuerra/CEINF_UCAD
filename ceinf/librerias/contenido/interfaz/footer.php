                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divModal"></div>
                <div id="divInactividad"></div>
                <footer>
                    <div class="pull-right">
                        © CEINF - Hospital Militar | <?php echo date("Y"); ?>
                    </div>
                    <div class="clearfix"></div>
                </footer>
            </div>
        </div>
        <script src="<?php echo $libreriasUrl; ?>bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $libreriasUrl; ?>js/custom.js"></script>
        <script type="text/javascript" src="<?php echo $libreriasUrl; ?>js/validate-frm.min.js"></script>
        <script type="text/javascript" src="<?php echo $libreriasUrl; ?>alertify/lib/alertify.min.js"></script>
        <script type="text/javascript" src="<?php echo $libreriasUrl; ?>js/datatables.min.js"></script>
        <script type="text/javascript" src="<?php echo $libreriasUrl; ?>js/select2.min.js"></script>
        <script>
            // https://lab.artlung.com/font-awesome-sample/
            history.pushState(null, null, location.href);
            history.back();
            history.forward();
            window.onpopstate = function () { history.go(1); };

            function cerrarSesion() {
                alertify.set({ buttonReverse: true, labels: {ok: 'Cerrar sesión', cancel: 'Cancelar'} });
                alertify.confirm("¿Está seguro que desea cerrar sesión? Recuerde guardar los últimos cambios realizados.", function (e) {
                    if (e) {
                        location.href = '<?php echo $libreriasUrl ?>contenido/logica/cerrarSesion';
                    } else {
                    }
                });
            }

            function loadAFK() {
                let url = '<?php echo $libreriasUrl; ?>' + 'contenido/logica/validarInactividad';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        lurl: '<?php echo $libreriasUrl; ?>'
                    },
                    success: function(data) {
                        $("#divInactividad").html(data);
                    }
                });
            }

            function loadModal(variables, url, modal) {
                $.post(
                    url + modal , 
                    {variables: variables}, 
                    function(data) {
                        $("#divModal").html(data);
                        $("#modal").modal("show");
                    }
                );   
            }

            function verificarIngreso() {
                if(<?php echo $_SESSION["flgPassword"]; ?> == 1) { // Es la contraseña por defecto, forzar cambio
                    loadModal("", "modulos/general/modals/", "cambiarDefaultPassword");
                } else {
                }
            }

            $(document).ready(function() {
                verificarIngreso();
                loadAFK();
            });
        </script>
    </body>
</html>
