$(document).ready(function(){
    $('#principal').DataTable({
        "language":{
            "LenghtMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resulados",
            "info": "Mostrando Registros del _START_ al _END_ de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch":"Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
        }
    });
});