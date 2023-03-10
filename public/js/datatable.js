function dataTable(ordering = true, searching = true, bLengthChange = true) {
    $(document).ready(function() {
        $('#table-dataTable').DataTable({
            ordering: ordering,
            searching: searching,
            bLengthChange: bLengthChange,
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se han encontado registros",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ total registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next" : "Siguiente",
                    "previous" : "Anterior"
                }
            }
        });
    })
}