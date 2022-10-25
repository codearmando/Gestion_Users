<?php

require 'conexion.php';


$datos = $_POST;
if (isset($_POST['register_user_ip'])) {

    $id_users = $datos['id_users'];
    $permisos = $datos['permisos'];
    $dir_ip_equipo = $datos['dir_ip_equipo'];
    //$obser = 'CREADO POR ECOLINA1';

    $sql_ip = "INSERT INTO PRESTACIONES.USUARIO_LOGIN UL (UL.ID_USUARIO, UL.ID_PERMISO, UL.IP_USUARIO, UL.OBSERVACIONES)
               VALUES ('$id_users', '$permisos', '$dir_ip_equipo', 'MODIFICADO POR ECOLINA1')";

    $insert = oci_parse($conexion, $sql_ip);
    oci_execute($insert);

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
                title: 'Registrado con Éxito',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(redireccion,1000);
            
        }
        alerta();
        
     
    </script>
    </body>
    </html>

<?php
}
?>