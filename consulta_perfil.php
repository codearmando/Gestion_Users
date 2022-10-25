<?php

$sql_perfil = "SELECT  pp.id_perfil, pp.desc_perfil FROM prestaciones.perfil_prestaciones pp
group by pp.id_perfil, pp.desc_perfil
order by pp.id_perfil asc";
$consult_perfil = oci_parse($conexion , $sql_perfil);
oci_execute($consult_perfil);
// while($row = oci_fetch_assoc($consult_user)){
//     echo $row['ID_USUARIO'].'<br>';
// }
?>

