const editarDiaFestivo = () => {
    if (document.querySelectorAll('.select-dia-festivo:checked').length > 1) {
        alert('Solo puedes seleccionar un dia festivo a la vez al editar.');
        return false;
    }
    const id = document.querySelector('.select-dia-festivo:checked').value;
    $.ajax({
        url: '/dias-festivos/' + id + '/edit',
        type: 'GET',
        success: function (data) {
            console.log(data);

            const myModal = new bootstrap.Modal('#editDiaFestivo');
            const modalToggle = document.getElementById('editDiaFestivo');
            myModal.show(modalToggle);
            $('#nombre-editar').val(data.dia_festivo.nombre);
            $('#color-editar').val(data.dia_festivo.color);
            $('#dia-editar').val(data.dia_festivo.dia);
            $('#mes-editar').val(data.dia_festivo.mes);
            $('#anyo-editar').val(data.dia_festivo.anyo);
            if (data.dia_festivo.recurrente) {
                $('#recurrente-editar').prop('checked', true);
            } else {
                $('#recurrente-editar').prop('checked', false);
            }
            $('#editDiaFestivo form')
            .attr('action', '/dias-festivos/'+ data.dia_festivo.id);
        }
    });
}

$('#editar').on('click', editarDiaFestivo);

const eliminarDiaFestivo = () => {
    if (document.querySelectorAll('.select-dia-festivo:checked').length < 1) {
        alert('Debes seleccionar al menos un usuario para eliminar.');
        return false;
    }
    document.querySelectorAll('.select-dia-festivo:checked').forEach(element => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dias-festivos/'+element.value,
            type: 'delete',
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('No se pudo eliminar el dia');
            }
        });
    });
    location.reload();
}

$('#eliminar').on('click', eliminarDiaFestivo);
