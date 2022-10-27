<?php

$username = 'HMARIAN';
$password = 'marian1';
$db= 'ASTROMELIA';
$charset ='AL32UTF8';

//$conexion = oci_connect ($username,$password,$db);
$conexion = oci_connect($username, $password, '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.11.9.70)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = ASTROMELIA) (SID = ASTROMELIA)))', $charset);

if(!$conexion){
    echo "Error conection database";
}

// $username = 'HMARIAN';
// $password = 'marian1';
// $db= 'DESARROLLO';
// $charset ='AL32UTF8';

// //$conexion = oci_connect ($username,$password,$db);
// $conexion = oci_connect($username, $password, '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.11.9.70)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DESARROLLO) (SID = DESARROLLO)))', $charset);

// if(!$conexion){
//     echo "Erro conection database";
// }

?>