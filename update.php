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
$ip_usuario = $_POST['ip_equipo'];
$id_usuario = $_POST['usuario'];
$ip_anterior = $_POST['ip_v'];


$sql_login = " UPDATE PRESTACIONES.USUARIO_LOGIN SET ID_PERMISO = '$permisos', IP_USUARIO = '$ip_usuario',
                OBSERVACIONES = 'MODIFICADO POR ECOLINA1' 
                WHERE ID_USUARIO = '$id_usuario' 
                AND IP_USUARIO = '$ip_anterior'";
$st_login = oci_parse($conexion, $sql_login);
oci_execute($st_login);

// $sql_login = " UPDATE PRESTACIONES.USUARIO_LOGIN SET ID_PERMISO = :id_permiso,
// IP_USUARIO = :IP_USUARIO,
// OBSERVACIONES = 'MODIFICADO POR ECOLINA1'
// WHERE ID_USUARIO = :ID_USUARIO
// AND IP_USUARIO = :IP_USUARIO"
// ;
// $st_login = oci_parse($conexion, $sql_login);

// oci_bind_by_name($st_login, ':id_permiso', $_POST['permisos']);
// oci_bind_by_name($st_login, ':IP_USUARIO', $_POST['ip_equipo']);
// oci_bind_by_name($st_login, ':ID_USUARIO', $_POST['usuario']);

// oci_execute($st_login);
?>

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
    <script>

        
        function redireccion(){
            window.location = 'index.php';
        }
        function alerta() {

            Swal.fire({
                icon: 'success',
                title: 'Modificación Exitosa',
                showConfirmButton: false,
                timer: 1500
            })
           setTimeout(redireccion,1000);
            
        }
        alerta();
        
     
    </script>
    </body>
    </html>



