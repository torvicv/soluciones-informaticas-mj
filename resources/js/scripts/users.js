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
