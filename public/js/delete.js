$('.btn-eliminar').on("click", function(event) {
    let form = $(this).closest("form");
    event.preventDefault();

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórrralo!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});