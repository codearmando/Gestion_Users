<?php
// ---------------------------
// ---------- BOBTON CREAR USUARIO-----------------------
//----------------------------------

// CONSULTA PERFIL DE USUARIOS
$sql_perfil = "SELECT  pp.id_perfil, pp.desc_perfil FROM prestaciones.perfil_prestaciones pp
group by pp.id_perfil, pp.desc_perfil
order by pp.id_perfil asc";
$consult_perfil = oci_parse($conexion , $sql_perfil);
oci_execute($consult_perfil);
// while($row = oci_fetch_assoc($consult_user)){
//     echo $row['ID_USUARIO'].'<br>';
// }

// consultar oficinas
$sql_oficina = "SELECT UP.ID_OFICINA_IVSS, OI.NOMBRE_OFICINA FROM PRESTACIONES.USUARIO_PRESTACIONES UP
INNER JOIN PRESTACIONES.OFICINA_IVSS OI
ON UP.ID_OFICINA_IVSS = OI.ID_OFICINA_IVSS
GROUP BY UP.ID_OFICINA_IVSS, OI.NOMBRE_OFICINA
ORDER BY UP.ID_OFICINA_IVSS ASC";

$consult_oficina = oci_parse($conexion, $sql_oficina);
oci_execute($consult_oficina);
// while ($row = oci_fetch_assoc($consult_perfil)) {
//     echo $row['ID_PERFIL'] . '<br>';
//     echo $row['DESC_PERFIL'] . '<br>';
// }

// ---------------------------
// ---------- BOBTON ADMINISTRAR DIRECCION IP-----------------------
//----------------------------------
// CONSULTA  USUARIOS
$sql_user = "SELECT UP.ID_USUARIO  FROM PRESTACIONES.USUARIO_PRESTACIONES UP";
$consult_user = oci_parse($conexion, $sql_user);
oci_execute($consult_user);
// while($row = oci_fetch_assoc($consult_user)){
//     echo $row['ID_USUARIO'].'<br>';
// }



