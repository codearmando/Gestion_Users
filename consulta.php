<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables/DataTables-1.12.1/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="selectize/selectize.bootstrap5.min.css">



    <title></title>
</head>

<body>



    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="col">
                <div class="table-responsive shadow-sm">
                    <table id="principal" class="table table-striped table-bordered shadow-sm">
                        <thead>
                            <tr>
                                <th>USUARIO</th>
                                <th>NOMBRE</th>
                                <th>CÉDULA</th>
                                <th>PERMISOS</th>
                                <th>EQUIPO</th>
                                <th id="tamañ">EDITAR</th>
                                <th id="tamañ">ELIMINAR</th>

                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            include 'conexion.php';


                            // $sql = "SELECT UP.ID_USUARIO, UP.NOMBRE, UP.CEDULA, OI.NOMBRE_OFICINA, UL.CARGOS, UL.IP_USUARIO 
                            // FROM PRESTACIONES.USUARIO_PRESTACIONES UP
                            // INNER JOIN PRESTACIONES.USUARIO_LOGIN UL
                            // ON UP.ID_USUARIO = UL.ID_USUARIO
                            // INNER JOIN PRESTACIONES.OFICINA_IVSS OI
                            // ON OI.ID_OFICINA_IVSS = UP.ID_OFICINA_IVSS
                            // ORDER BY UP.ID_USUARIO ASC";

                            // $sql = "SELECT UP.ID_USUARIO, UP.CEDULA, UP.NOMBRE, UL.ID_PERMISO, UL.IP_USUARIO, 
                            //                UP.ESTATUS
                            //         from prestaciones.usuario_prestaciones up
                            //         inner join prestaciones.usuario_login ul 
                            //         on up.id_usuario = ul.id_usuario";

                            $sql = "SELECT UP.ID_USUARIO, UP.CEDULA, UP.NOMBRE, P.DESC_PERMISO AS ID_PERMISO, UL.IP_USUARIO, 
                            UP.ESTATUS
                     from prestaciones.usuario_prestaciones up
                     inner join prestaciones.usuario_login ul 
                     on up.id_usuario = ul.id_usuario
                     INNER JOIN PRESTACIONES.PERMISOS_LOGIN P
                     ON P.ID_PERMISO=UL.ID_PERMISO";

                            // $filas = 0;
                            $stmt = oci_parse($conexion, $sql);        // Preparar la sentencia
                            $exe = oci_execute($stmt);              // Ejecutar la sentencia




                            if ($exe != FALSE) {

                                $data = [];



                                while ($row = oci_fetch_array($stmt)) {
                                    $user = $row['ID_USUARIO'];
                                    $ip = $row['IP_USUARIO'];
                                    $estatus = $row['ESTATUS'];
                                    $user_s = "'$user','$ip','$estatus'";
                            ?>

                                    <tr>
                                        <td id="cuadro"><?php echo $row['ID_USUARIO'] ?></td>
                                        <td><?php echo $row['NOMBRE']; ?></td>
                                        <td><?php echo $row['CEDULA']; ?></td>
                                        <td id="cargos"><?php echo $row['ID_PERMISO']; ?></td>
                                        <td><?php echo $row['IP_USUARIO']; ?></td>
                                        <td><a href="#" id="btn_modificar" onclick="getUser(<?php echo $user_s ?>)">
                                                <span class="material-symbols-outlined" id="editar">
                                                    edit_note
                                                </span></a></td>
                                        <td><a href="#" data-id="<?php echo $user; ?>" id="elim_reg" class="deletebtn">
                                                <span class="material-symbols-outlined" id="eliminar">
                                                    delete
                                                </span></a></td>



                                    </tr>

                                    <!-- echo "<td>" . $data['id_user'] = $row['ID_USUARIO'] . "<td>";
                                    echo "<td>" . $data['nombre'] = $row['NOMBRE'] . "</td>";
                                    echo "<td>" . $data['cedula'] = $row['CEDULA'] . "</td>";
                                    echo "<td>" . $data['desc_perfil'] = $row['DESC_PERFIL'] . "</td>";
                                    echo "<td>" . $data['nombre_oficina'] = $row['NOMBRE_OFICINA'] . "</td>";
                                    echo "<td>" . $data['cargos'] = $row['CARGOS'] . "</td>";
                                    echo "<td>" . $data['ip_usuario'] = $row['IP_USUARIO'] . "</td>";
                                    echo "</tr>"; -->


                            <?php
                                }
                            }
                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificar">
        Editar
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="modificar" tabindex="-1" aria-labelledby="modificarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificarModalLabel">Modificar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="modal-body">
                        <form action="update.php" method="POST" id='frmEditar'>
                            <div class="row">

                                <div class="col-5">
                                    <label for="usuario" class="col-form-label">Usuario</label>

                                    <input type="text" name="usuario" id="usuario" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off" readonly>
                                </div>

                                <div class="col-5">
                                    <label for="cedula" class="col-form-label">Cédula</label>

                                    <input type="text" name="cedula" id="cedula" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off">
                                </div>

                                <!-- <div class="sub_tit">
                                    <label><strong>Permisos:</strong></label>
                                </div> -->

                                <!--<div class="pemisos_modulo">
                                    <div class="form-check form-check-inline">
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


                                <div class="col-6">
                                    <label for="permiso" class="col-form-label">Permiso</label>

                                    <select class="form-select" id="permiso" aria-label="Default select example" name="permiso">
                                        <option value="1">DIRECTOR GENERAL</option>
                                        <option value="2">DIRECTOR DE LINEA</option>
                                        <option value="3">JEFE DE DIVISIÓN</option>
                                        <option value="4">ANALISTA DE MOVIMIENTO</option>
                                        <option value="5">ANALISTA</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <input type="hidden" name="ip_v" id="ip_v">
                                    <label for="ip_equipo" class="col-form-label">IP Equipo</label>

                                    <input type="text" name="ip_equipo" id="ip_equipo" class="form-control" aria-describedby="passwordHelpInline">
                                </div>

                                <div class="col-4" style="margin-top: 10px;">
                                    <label for="estatus" class="col-form-label">Estatus</label>

                                    <select class="form-select" id="estatus" aria-label="Default select example" name="estatus">
                                        <option value="A">Activo</option>
                                        <option value="I">Inactivo</option>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Modificar</button>
                            </div>
                        </form>



                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="datatables/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="selectize/selectize.min.js"></script>
    <!-- <script src="datatables/popper.min.js"></script> -->
    <script src="datatables/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script>
        const myModal = new bootstrap.Modal('#modificar', {})

        function getUser(idUsuario, ipUsuario) {
            fetch('consultar_usuario.php?usuario=' + idUsuario + '&ip=' + ipUsuario)
                .then((response) => response.json())
                .then((data) => {

                    document.getElementById('usuario').value = idUsuario;
                    document.getElementById('cedula').value = data.CEDULA;
                    document.getElementById('ip_equipo').value = data.IP_USUARIO;
                    document.getElementById('ip_v').value = data.IP_USUARIO;

                    let options = document.querySelectorAll('#permiso option')
                    for (const option of options) {
                        if (option.value == data.ID_PERMISO)
                            option.selected = true;
                    }



                    options = document.querySelectorAll('#estatus option')

                    for (const option of options) {
                        if (option.value == data.ESTATUS)
                            option.selected = true;
                    }


                    myModal.show()
                });

        }
    </script>
    <script>
        $(".deletebtn").on('click',function() {
            event.preventDefault();
            $tr = $(this).closest('tr');
            let data = $tr.children("td").map(function() {
                return $(this).text();
            });
            let nombre = data[0];
            let cargos = data[3];
            let ip_equipo = data[4];

            Swal.fire({
                title: 'Quieres eliminar el usuario ' + nombre + '?',
                text: "El usuario será eliminado permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    // ajax
                    $.ajax({
                        type: 'GET',
                        url: 'eliminar.php',
                        data: {
                            'id_user': nombre,
                            'cargos': cargos,
                            'ip_equipo': ip_equipo
                        },
                        success: function() {
                            $(this).parents('tr').remove();
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado Correctamente.',
                                'success'
                            )
                            window.location = 'index.php';
                        },
                        statusCode: {
                            400: function() {
                                var json = JSON.parse(data.responseText);
                                Swal(
                                    'Error!',
                                    json.msg,
                                    'success'
                                )
                            }
                        }
                    });
                }
            })
        })

    </script>


    <?php
    include 'footer.php';
    ?>

</body>

</html>