<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title></title>
</head>

<body>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificar">
        Editar
    </button>

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

                                <div class="col-4">
                                    <label for="usuario" class="col-form-label">Usuario</label>

                                    <input type="text" name="usuario" id="usuario" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off" readonly>
                                </div>

                                <div class="col-4">
                                    <label for="cedula" class="col-form-label">Cédula</label>

                                    <input type="text" name="cedula" id="cedula" class="form-control" aria-describedby="passwordHelpInline" autocomplete="off" readonly>
                                </div>

                                <div class="col-8">
                                    <label for="permiso" class="col-form-label">Permiso</label>

                                    <select class="form-select" id="permiso" aria-label="Default select example" name="permiso">
                                         <option value="1">DIRECTOR GENERAL</option>
                                        <option value="2">DIRECTOR DE LINEA</option>
                                        <option value="3">JEFE DE DIVISIÓN</option>
                                        <option value="4">CONSULTOR</option>
                                        <option value="4">ANALISTA DE MOVIMIENTO</option>
                                        <option value="5">ANALISTA</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="ip_equipo" class="col-form-label">IP Equipo</label>

                                    <input type="text" name="ip_equipo" id="ip_equipo" class="form-control" aria-describedby="passwordHelpInline" readonly>
                                </div>

                                <div class="col-4">
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

        <button onclick="getUser('MarianH')">editar</button>

        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>


          
            const myModal = new bootstrap.Modal('#modificar', {})
            function getUser(idUsuario,){
                fetch('consultar_usuario.php?usuario='+idUsuario)
                .then((response) => response.json())
                .then((data) => {

                    document.getElementById('usuario').value = idUsuario;
                    document.getElementById('cedula').value = data.CEDULA;
                    


                    let options = document.querySelectorAll('#permiso option')
                    for (const option of options) {
                        if(option.value == data.ID_PERMISO)
                            option.selected = true;   
                    }

                    document.getElementById('ip_equipo').value = data.IP_USUARIO;

                    options = document.querySelectorAll('#status option')
                   
                    for (const option of options) {
                        if(option.value == data.ESTATUS)
                            option.selected = true;   
                    }


                    
                    myModal.show()
                });

            }


        </script>
</body>

</html>