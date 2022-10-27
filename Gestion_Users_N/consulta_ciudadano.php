<?php 
include 'conexion.php';

$ced=$_GET['v_ced'];

$sql="SELECT CI.PRIMER_NOMBRE||' '||CI.PRIMER_APELLIDO||' '||CI.SEGUNDO_APELLIDO AS NOMBRE_APELLIDO 
FROM SIRA.CIUDADANO CI WHERE CI.ID_CIUDADANO='$ced'";

$st = oci_parse($conexion, $sql);
oci_execute($st);

$user = oci_fetch_array($st);
if ($user) {
    echo json_encode($user);
}

?>