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
