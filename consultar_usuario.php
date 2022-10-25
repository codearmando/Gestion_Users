<?php

include 'conexion.php';

$usuario =$_GET['usuario'];
$ip_user =$_GET['ip'];

$sql = "SELECT up.estatus, ul.ID_PERMISO, ul.ip_usuario, up.CEDULA
        FROM prestaciones.usuario_prestaciones up
        INNER JOIN prestaciones.usuario_login ul
        on up.id_usuario = ul.id_usuario
        WHERE up.id_usuario = '$usuario' AND
        ul.ip_usuario='$ip_user'";

$st = oci_parse($conexion, $sql);
oci_execute($st);

$user = oci_fetch_array($st);

echo json_encode($user);




