<?php

include '../conexion.php';

$data = $_GET;


var_dump($data);

$sql = "INSERT INTO PRESTACIONES.AUDITORIA_LOGIN (ID_USUARIO,ID_PERMISO,IP_USUARIO, FECHA, OBSERVACION)
        values (:ID_USUARIO,:ID_PERMISO,:IP_USUARIO,SYSDATE,'ELIMINADO POR ECOLINA1')";



$st = oci_parse($conexion, $sql);

oci_bind_by_name($st, ':ID_USUARIO', $data['id_user']);
oci_bind_by_name($st, ':ID_PERMISO', $data['cargos']);
oci_bind_by_name($st, ':IP_USUARIO', $data['ip_equipo']);
//oci_bind_by_name($st, ':FECHA_CREACION','SYSDATE');
oci_execute($st);


$id_usuario= $data['id_user'];
$ip_user_equipo= $data['ip_equipo'];
if (empty($ip_user_equipo)) {
$sql= "DELETE FROM PRESTACIONES.USUARIO_LOGIN WHERE ID_USUARIO = '$id_usuario' AND IP_USUARIO IS NULL";
}else{
$sql= "DELETE FROM PRESTACIONES.USUARIO_LOGIN WHERE ID_USUARIO = '$id_usuario' AND IP_USUARIO = '$ip_user_equipo'";
}

// $sql= "DELETE FROM PRESTACIONES.USUARIO_LOGIN ID_USUARIO,CARGOS,IP_USUARIO   ";
$st_del = oci_parse($conexion, $sql);
oci_execute($st_del);
