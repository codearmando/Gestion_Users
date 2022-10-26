<?php

require 'conexion.php';

$sql_user = "SELECT UP.ID_USUARIO  FROM PRESTACIONES.USUARIO_PRESTACIONES UP";
$consult_user = oci_parse($conexion, $sql_user);
oci_execute($consult_user);
// while($row = oci_fetch_assoc($consult_user)){
//     echo $row['ID_USUARIO'].'<br>';
// }

$sql_perfil = "SELECT  pp.id_perfil, pp.desc_perfil FROM prestaciones.perfil_prestaciones pp
group by pp.id_perfil, pp.desc_perfil
order by pp.id_perfil asc";
$consult_perfil = oci_parse($conexion, $sql_perfil);
oci_execute($consult_perfil);
// while ($row = oci_fetch_assoc($consult_perfil)) {
//     echo $row['ID_PERFIL'] . '<br>';
//     echo $row['DESC_PERFIL'] . '<br>';
// }

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




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="selectize/selectize.bootstrap5.min.css">
    <link rel="stylesheet" href="css/usuarios.css">
    <!-- sweetAlert -->
    <link rel="stylesheet" href="sweetalert/dist/sweetalert2.min.css">

    <title>Registrar Usuarios</title>
</head>

<body>

    <?php
    include 'nav.php';
    ?>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="agregar">
        Crear Usuario
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id='frmRegistro'>
                        <div class="row">

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Usuario</label>

                                <input type="text" name="usuario" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off">
                            </div>

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Cédula</label>
                                <div class="input-group">
                                    <select name="nacionalidad" class="form-select" id="nacionalidad">
                                        <option selected disabled>Seleccionar</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                    </select>
                                    <input type="text" name="cedula" id="cedula_r" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off">
                                </div>


                            </div>
                            <!-- <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Clave</label>

                                <input type="text" name="clave" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div> -->
                        </div>
                        <div class="row">

                            <div class="col-4" style="margin-top: -75px; margin-left: 66%;">
                                <label for="inputPassword6" class="col-form-label">Nombre y Apellido</label>

                                <input type="text" name="nombres" id="nombre_ag" class="form-control" aria-describedby="passwordHelpInline">
                            </div>

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Correo Electónico</label>

                                <input type="email" name="email" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off" style="width: 150%;">
                            </div>

                            <div class="sub_tit">
                                <label><strong>Permisos:</strong></label>
                            </div>

                            <!-- <div class="pemisos_modulo"> -->
                            <!--<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Dirección General</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">Dirección General</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Dirección General</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">Dirección General</label>
                                    </div>

                                </div>-->

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Permiso</label>
                                <select class="form-select" id="permiso" aria-label="Default select example" name="permiso">
                                    <option selected disabled>Seleccionar Permiso</option>
                                    <option value="1">DIRECTOR GENERAL</option>
                                    <option value="2">DIRECTOR DE LINEA</option>
                                    <option value="3">JEFE DE DIVISIÓN</option>
                                    <option value="4">CONSULTOR</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <label for="ip_equipo" class="col-form-label">IP Equipo:</label>

                                <input type="text" name="ip_equipo" id="ip_equipo_r" class="form-control" aria-describedby="passwordHelpInline">
                            </div>

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Perfil</label>
                                <select class="form-select" id="perfil" aria-label="Default select example" name="id_perfil">
                                    <option selected disabled>Seleccionar Perfil</option>
                                    <?php while ($row = oci_fetch_assoc($consult_perfil)) { ?>
                                        <option value="<?php echo $row['ID_PERFIL'] ?>"> <?php echo $row['DESC_PERFIL'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Oficina</label>
                                <select class="form-select" id="oficina" aria-label="Default select example" name="oficina">
                                    <option selected disabled>Seleccionar Oficina</option>
                                    <?php while ($row = oci_fetch_assoc($consult_oficina)) { ?>
                                        <option value="<?php echo $row['ID_OFICINA_IVSS'] ?>"> <?php echo $row['NOMBRE_OFICINA'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" id="agregar">
        Adminnistrar Dirección IP
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal2Label">Registrar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="registro_ip.php" method="POST" id='form_registro_ip'>
                        <div class="row">

                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Usuario</label>
                                <select class="selectize" id="id_users" aria-label="Default select example" name="id_users">
                                    <?php while ($row = oci_fetch_assoc($consult_user)) { ?>
                                        <option value="<?php echo $row['ID_USUARIO']; ?>"><?php echo $row['ID_USUARIO']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">Permiso</label>
                                <select class="form-select" id="permisos" aria-label="Default select example" name="permisos">
                                    <option value="" hidden selected>Seleccione un Permiso</option>
                                    <option value="1">DIRECTOR GENERAL</option>
                                    <option value="2">DIRECTOR DE LINEA</option>
                                    <option value="3">JEFE DE DIVISIÓN</option>
                                    <option value="4">ANALISTA DE MOVIMIENTO</option>
                                        <option value="5">ANALISTA</option>
                                </select>
                            </div> -->
                            <div class="col-4">
                                <label for="inputPassword6" class="col-form-label">IP Equipo</label>

                                <input type="text" name="dir_ip_equipo" id="dir_ip_equipo" class="form-control" aria-describedby="passwordHelpInline">

                                <div class="invalid-feedback">
                                    Esta Dirección IP no es Válida
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="register_user_ip" id="register_user_ip" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="sweetalert/dist/sweetalert2.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="datatables/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="selectize/selectize.min.js"></script>



    <script>
        $(".selectize").selectize({
            sortField: "text",
        });
    </script>

    <script>
        var expresion_ip = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        var ip_campo = $('#dir_ip_equipo');
        var ip = false;



        const validarFormulario = (e) => {
            switch (event.target.name) {
                case 'dir_ip_equipo':
                    if (expresion_ip.test($('#dir_ip_equipo').val())) {

                        if ($('#dir_ip_equipo').hasClass('is-invalid')) {
                            $('#dir_ip_equipo').removeClass('is-invalid');
                        }
                        $('#dir_ip_equipo').addClass('is-valid');
                        ip = true;

                    } else {
                        $('#dir_ip_equipo').addClass('is-invalid');
                        ip = false;
                    }
                    break;

                case 'ip_equipo':
                    if (expresion_ip.test($('#ip_equipo_r').val())) {

                        if ($('#ip_equipo_r').hasClass('is-invalid')) {
                            $('#ip_equipo_r').removeClass('is-invalid');
                        }
                        $('#ip_equipo_r').addClass('is-valid');
                        ip = true;

                    } else {
                        $('#ip_equipo_r').addClass('is-invalid');
                        ip = false;
                    }
                    break;
            }
        }

        $('#form_registro_ip').on('submit', function() {
            if (ip == false) {
                var confirmacion = confirm('La Dirección IP Ingresada es invalida, ¿Desea Agregar Usuario?');
                event.preventDefault();
                if (confirmacion) {
                    return true;
                }
            } else {
                return true;
            }
        })

        ip_campo.blur(function() {
            validarFormulario();
        });

        ip_campo.keyup(function() {
            validarFormulario();
        });

        $('#ip_equipo_r').blur(function() {
            validarFormulario();
        });

        $('#ip_equipo_r').keyup(function() {
            validarFormulario();
        });
    </script>

    <script>
        var frmRegistro = document.getElementById('frmRegistro');
        var cedula = false;

        $('#cedula_r').blur(function() {
            var cedula_exp = /^[0-9]{4,9}$/;
            if (cedula_exp.test($('#cedula_r').val())) {

                if ($('#cedula_r').hasClass('is-invalid')) {
                    $('#cedula_r').removeClass('is-invalid');
                }
                $('#cedula_r').addClass('is-valid');
                cedula = true;

            } else {
                $('#cedula_r').addClass('is-invalid');
                $('#nombre_ag').val('');
                cedula = false;
            }

            if (cedula == true) {

                var cedula_c = $('#cedula_r').val();
                var nac = $('#nacionalidad').val();

                var longitud_cedula = cedula_c.length;

                if (longitud_cedula == 6) {
                    cedula = '000' + cedula_c;
                } else if (longitud_cedula == 7) {
                    cedula = '00' + cedula_c; //Si la cedula tiene como longitud 9, entonces devuelveme la nacionalidad + la cedula
                } else if (longitud_cedula == 8) {
                    cedula = '0' + cedula_c;
                } else if (longitud_cedula == 9) {
                    cedula = cedula_c;
                } else if (longitud_cedula == 10) {
                    cedula = cedula_c;
                }

                var v_ced = nac + cedula;
                // alert(v_ced);

                $.ajax({
                    url: 'consulta_ciudadano.php',
                    type: 'GET',
                    data: {
                        v_ced
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#nombre_ag').val(data.NOMBRE_APELLIDO);
                    },
                    error: function() {
                        // ? colocar sweetalert
                        alert('No encontrado');
                        // $('#nombre_ag').val('');
                    }
                })

            }

        });

        // window.addEventListener('load',() =>{
        //     // alert();
        //     window.location = 'index.php';
        // })                                 


        $("#frmRegistro").submit(function(e){

            e.preventDefault();

            let datos=$(this).serializeArray();

            $.ajax({
                url:'registro.php',
                type:'POST',
                data: datos,
                dataType: 'json',

                success: function(response){
                    alert('Agregado con Exito');
                    window.location = 'index.php';
                },
                fail: function(response){
                    alert('Error, Intente de Nuevo');
                    window.location = 'index.php';
                }
            })

        })

        // frmRegistro.addEventListener('submit', (e) => {
        //     e.preventDefault()
        //     const data = Object.fromEntries(
        //         new FormData(e.target)
        //     )
        //     console.log(data);
        //     fetch('registro.php', {
        //             method: 'POST', // or 'PUT'
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify(data),
        //         })
        //         .then((response) => response.json())
        //         .then((data) => {
        //             if (!data.ok)
        //                 return alert(data.msg);

        //             alert('Usuario registrado con exito');
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //             alert('Ha ocurrido un error, intente de nuevo mas tarde');
        //         });

        // })
    </script>

    <script>

    </script>


    <?php
    include 'consulta.php';
    ?>
</body>

</html>