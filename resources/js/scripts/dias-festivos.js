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

const quantityResults = () => {
    const quantity = document.getElementById('cantidad-registros').value;
    $.ajax({
        url: '/dias-festivos?p='+quantity,
        type: 'GET',
        success: function () {
            const urlParams = new URLSearchParams(location.search);
            if (urlParams.get('search') == undefined ||
                urlParams.get('search') == null || urlParams.get('search') == 'undefined' ||
                urlParams.get('search') == 'null') {
                location.href = '/dias-festivos?p='+quantity;
            } else {
                location.href = '/dias-festivos?p='+quantity+'&search='+urlParams.get('search');
            }
        }
    });
}

$('#cantidad-registros').on('change', quantityResults);

const searchResults = () => {
    let search = document.getElementById('buscar').value;
    if (search.startsWith('#')) {
        search = search.substring(1);
    }
    $.ajax({
        url: '/dias-festivos?search='+search,
        type: 'GET',
        success: function () {
            const urlParams = new URLSearchParams(location.search);
            if (urlParams.get('p') == undefined || urlParams.get('p') == null ||
                urlParams.get('p') == 'undefined' || urlParams.get('p') == 'null') {
                location.href = '/dias-festivos?search='+search;
            } else {
                location.href = '/dias-festivos?p='+urlParams.get('p')+'&search='+search;
            }
        }
    });
}

$('#buscar-btn').on('click', searchResults);
