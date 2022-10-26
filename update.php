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

    include 'conexion.php';

    $sql = "UPDATE PRESTACIONES.USUARIO_PRESTACIONES SET ESTATUS = :estatus where ID_USUARIO = :id_usuario";
    $st = oci_parse($conexion, $sql);

    oci_bind_by_name($st, ':estatus', $_POST['estatus']);
    oci_bind_by_name($st, ':id_usuario', $_POST['usuario']);

    oci_execute($st);

    // ---------------------------------------------
    // campos a editar
    $permisos = $_POST['permiso'];
    $id_usuario = $_POST['usuario'];
    $ip_usuario = $_POST['ip_equipo'];
    $ip_anterior = $_POST['ip_v'];


    $sql_ip_exist = "SELECT ul.ip_usuario from prestaciones.usuario_login ul
        where ul.id_usuario='$id_usuario'
        and ul.ip_usuario = '$ip_usuario'";
    $login_ip_exists = oci_parse($conexion, $sql_ip_exist);
    oci_execute($login_ip_exists);
    $log_exists_ip = oci_fetch_assoc($login_ip_exists);

    if ($ip_usuario === $log_exists_ip['IP_USUARIO']) { ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ERROR...',
                text: 'la IP ya fue asignada. Por favor Asignar otra IP al usuario!',
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
        $sql_login = " UPDATE PRESTACIONES.USUARIO_LOGIN SET ID_PERMISO = '$permisos', IP_USUARIO = '$ip_usuario',
                OBSERVACIONES = 'MODIFICADO POR ECOLINA1' 
                WHERE ID_USUARIO = '$id_usuario' 
                AND IP_USUARIO = '$ip_anterior'";
        $st_login = oci_parse($conexion, $sql_login);
        oci_execute($st_login);
    ?>
        <script>
            Swal.fire({
                title: "Modificación de IP Exitosa",
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
    <!-- <script src="sweetalert/dist/sweetalert2.min.js"></script>
    <script>
        function redireccion() {
            window.location = 'index.php';
        }

        function alerta() {

            Swal.fire({
                icon: 'success',
                title: 'Modificación Exitosa',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(redireccion, 1000);

        }
        alerta();
    </script> -->
</body>

</html>