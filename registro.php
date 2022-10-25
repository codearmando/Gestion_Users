<?php

try {

    include 'conexion.php';

    $data = $_POST;

    $sql = "SELECT ID_USUARIO FROM PRESTACIONES.USUARIO_PRESTACIONES WHERE ID_USUARIO = '" . $data['usuario'] . "'";
    $st = oci_parse($conexion, $sql);
    oci_execute($st);

    $user = oci_fetch_array($st);
    if ($user != 0) {
        throw new \Exception('El usuario se encuentra registrado');
        die;
    } else {
        // echo 'ok';

        $sql = "INSERT INTO PRESTACIONES.USUARIO_PRESTACIONES 
            (ID_USUARIO,CEDULA,CLAVE,NOMBRE,EMAIL,ID_PERFIL,FECHA_CREACION,ESTATUS,ID_OFICINA_IVSS) 
            values (:ID_USUARIO,:CEDULA,prestaciones.encryption.encrypt (LPAD('12345',16,'x')),:NOMBRE,:EMAIL,:PERFIL,SYSDATE,'I',:OFICINA)";
        $st = oci_parse($conexion, $sql);
        // echo $data['usuario']. '<br>';
        // echo $data['cedula']. '<br>';
        // echo $data['clave']. '<br>';
        // echo $data['nombres']. '<br>';
        // echo $data['email']. '<br>';
        // echo $data['id_perfil'];

        oci_bind_by_name($st, ':ID_USUARIO', strtoupper($data['usuario']));
        oci_bind_by_name($st, ':CEDULA', $data['cedula']);
        // oci_bind_by_name($st, ':CLAVE', $data['clave']);
        oci_bind_by_name($st, ':NOMBRE', strtoupper($data['nombres']));
        oci_bind_by_name($st, ':EMAIL', $data['email']);
        oci_bind_by_name($st, ':PERFIL', $data['id_perfil']);
        oci_bind_by_name($st, ':OFICINA', $data['oficina']);
        // //oci_bind_by_name($st, ':FECHA_CREACION','SYSDATE');

        oci_execute($st);


        $sql1 = "INSERT INTO PRESTACIONES.USUARIO_LOGIN (ID_USUARIO,ID_PERMISO,IP_USUARIO, OBSERVACIONES) 
             values ('" . strtoupper($data['usuario']) . "','" . $data['permiso'] . "', '" . $data['ip_equipo'] . "', 'CREADO POR ECOLINA1')";

        $st1 = oci_parse($conexion, $sql1);

        // // oci_bind_by_name($st, ':ID_USUARIO', $data['usuario']);
        // // oci_bind_by_name($st, ':CARGOS', $data['permiso']);
        // // oci_bind_by_name($st, ':IP_USUARIO', $data['ip_equipo']);


        oci_execute($st1);
    }

    $res = ['ok' => true];
} catch (\Exception $e) {

    $res = [
        'ok' => false,
        'msg' => $e->getMessage()
    ];
}

echo json_encode($res);
