const editarUser = () => {
    if (document.querySelectorAll('.select-user:checked').length > 1) {
        alert('Solo puedes seleccionar un usuario a la vez al editar.');
        return false;
    }
    const id = document.querySelector('.select-user:checked').value;
    $.ajax({
        url: '/users/' + id + '/edit',
        type: 'GET',
        success: function (data) {
            console.log(data);

            const myModal = new bootstrap.Modal('#editUser');
            const modalToggle = document.getElementById('editUser');
            myModal.show(modalToggle);
            $('#name-editar').val(data.user.name);
            $('#email-editar').val(data.user.email);
            $('#password-editar').val('');
            $('#editUser form')
            .attr('action', '/users/'+ data.user.id);
        }
    });
}

$('#editar').on('click', editarUser);

const eliminarUsers = () => {
    if (document.querySelectorAll('.select-user:checked').length < 1) {
        alert('Debes seleccionar al menos un usuario para eliminar.');
        return false;
    }
    document.querySelectorAll('.select-user:checked').forEach(element => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/users/'+element.value,
            type: 'delete',
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('No se pudo eliminar el usuario');
            }
        });
    });
    location.reload();
}

$('#eliminar').on('click', eliminarUsers);

const quantityResults = () => {
    const quantity = document.getElementById('cantidad-registros').value;
    $.ajax({
        url: '/users?p='+quantity,
        type: 'GET',
        success: function () {
            let url = '/users?p='+quantity;
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
    const search = document.getElementById('buscar').value;
    $.ajax({
        url: '/users?search='+search,
        type: 'GET',
        success: function () {
            const urlParams = new URLSearchParams(location.search);
            let url = '/users?search='+search;
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

$('#buscar-btn').on('click', searchResults);

const orderResults = function() {
    const order = $(this).attr('id');
    $.ajax({
        url: '/users?order='+order,
        type: 'GET',
        success: function () {
            const urlParams = new URLSearchParams(location.search);
            let url = '/users?order='+order;
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
