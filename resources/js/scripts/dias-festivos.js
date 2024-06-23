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
            let url = '/dias-festivos?p='+quantity;
            const urlParams = new URLSearchParams(location.search);
            if (urlParams.get('search') != undefined &&
                urlParams.get('search') != null &&
                urlParams.get('search') != 'undefined' &&
                urlParams.get('search') != 'null') {
                url += '&search='+urlParams.get('search');
            }
            if (urlParams.get('order') != undefined &&
                urlParams.get('order') != null &&
                urlParams.get('order') != 'undefined' &&
                urlParams.get('order') != 'null') {
                url += '&order='+urlParams.get('order');
            }
            location.href = url;
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
            let url = '/dias-festivos?search='+search;
            if (urlParams.get('p') != undefined &&
                urlParams.get('p') != null &&
                urlParams.get('p') != 'undefined' &&
                urlParams.get('p') != 'null') {
                url += '&p='+urlParams.get('p');
            }
            if (urlParams.get('order') != undefined &&
                urlParams.get('order') != null &&
                urlParams.get('order') != 'undefined' &&
                urlParams.get('order') != 'null') {
                url += '&order='+urlParams.get('order');
            }
            location.href = url;
        }
    });
}

const orderResults = function() {
    const order = $(this).attr('id');
    $.ajax({
        url: '/dias-festivos?order='+order,
        type: 'GET',
        success: function () {
            const urlParams = new URLSearchParams(location.search);
            let url = '/dias-festivos?order='+order;
            if (urlParams.get('p') != undefined &&
                urlParams.get('p') != null &&
                urlParams.get('p') != 'undefined' &&
                urlParams.get('p') != 'null') {
                url += '&p='+urlParams.get('p');
            }
            if (urlParams.get('search') != undefined &&
                urlParams.get('search') != null &&
                urlParams.get('search') != 'undefined' &&
                urlParams.get('search') != 'null') {
                url += '&search='+urlParams.get('search');
            }
            location.href = url;
        }
    });
}

$('.order').on('click', orderResults);

$('#buscar-btn').on('click', searchResults);

$('#picker-color').on('keyup', function () {
    $('#color').val($(this).val());
});

$('#picker-color-editar').on('keyup', function () {
    $('#color-editar').val($(this).val());
});


