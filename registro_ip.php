<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- sweetAlert -->
    <link rel="stylesheet" href="sweetalert/dist/sweetalert2.min.css">
</head>

<body>
    <script src="sweetalert/dist/sweetalert2.min.js"></script>
    <?php

    require 'conexion.php';


    $datos = $_POST;
    if (isset($_POST['register_user_ip'])) {

        $id_users = $datos['id_users'];
        // $permisos = $datos['permisos'];
        $dir_ip_equipo = $datos['dir_ip_equipo'];
        //$obser = 'CREADO POR ECOLINA1';

        $sql_v = "SELECT COUNT(1), UL.ID_PERMISO FROM PRESTACIONES.USUARIO_LOGIN UL
                    WHERE UL.ID_USUARIO = '$id_users'
                    GROUP BY UL.ID_PERMISO";
        $validar_sql = oci_parse($conexion, $sql_v);
        oci_execute($validar_sql);
        $v_permiso = oci_fetch_assoc($validar_sql);
        $permisos_user = $v_permiso['ID_PERMISO'];

        if ($v_permiso == 0) {
            $sql_ip = "INSERT INTO PRESTACIONES.USUARIO_LOGIN UL (UL.ID_USUARIO, UL.ID_PERMISO, UL.IP_USUARIO, UL.OBSERVACIONES)
               VALUES ('$id_users',5, '$dir_ip_equipo', 'MODIFICADO POR ECOLINA1')";

            $insert = oci_parse($conexion, $sql_ip);
            oci_execute($insert);
    ?>
            <script>
                Swal.fire({
                    title: "IP Agregada Exitosamente!, Su permiso por defecto es ANALISTA",
                    icon: "success",
                    confirmButtonText: "Aceptar",
                    position: "center",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    stopKeydownPropagation: false,
                }).then(function() {
                    window.location = "index.php";
                });
            </script>

        <?php
        } else {
            $sql_ip2 = "INSERT INTO PRESTACIONES.USUARIO_LOGIN UL (UL.ID_USUARIO, UL.ID_PERMISO, UL.IP_USUARIO, UL.OBSERVACIONES)
                   VALUES ('$id_users',$permisos_user, '$dir_ip_equipo', 'MODIFICADO POR ECOLINA1')";

            $insert2 = oci_parse($conexion, $sql_ip2);
            oci_execute($insert2);
        ?>
            <script>
                Swal.fire({
                    title: "IP Agregada Exitosamente!",
                    icon: "success",
                    confirmButtonText: "Aceptar",
                    position: "center",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    stopKeydownPropagation: false,
                }).then(function() {
                    window.location = "index.php";
                });
            </script>

        <?php
        }

        ?>

</body>

</html>

<?php
    }
?>


<!-- <script src="sweetalert/dist/sweetalert2.min.js"></script>
        <script>
            function redireccion() {
                window.location = 'index.php';
            }

            function alerta() {

                Swal.fire({
                    icon: 'success',
                    title: 'Registrado con Éxito',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(redireccion, 1000);

            }
            alerta();
        </script> -->