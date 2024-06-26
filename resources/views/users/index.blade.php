<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="m-3">
        <div>
            <div class="fs-3">
                Listado Usuarios
            </div>
            <div>
                <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-plus"></i>
                    Añadir
                </button>
                <button class="btn btn-secondary" type="button" id="editar">
                    <i class="bi bi-pencil-square"></i>
                    Editar
                </button>
                <button class="btn btn-secondary" type="button" id="eliminar">
                    <i class="bi bi-trash"></i>
                    Eliminar
                </button>
            </div>
        </div>
        <div class="m-1 p-2 bg-white">
            <div class="d-flex justify-content-between align-items-center mx-1 mb-2">
                <div class="w-25">
                    Mostrar
                    <select class="w-25 rounded" id="cantidad-registros">
                        <option @selected($quantityPaginate == 5) value="5">5</option>
                        <option @selected($quantityPaginate == 10) value="10">10</option>
                        <option @selected($quantityPaginate == 15) value="15">15</option>
                        <option @selected($quantityPaginate == 20) value="20">20</option>
                        <option @selected($quantityPaginate == 25) value="25">25</option>
                    </select>
                    registros
                </div>
                <div class="w-25 d-flex align-items-center">
                    <input type="text" class="form-control" placeholder="Buscar" id="buscar" value="{{$search}}" />
                    <button class="btn btn-secondary" type="button" id="buscar-btn">
                        Buscar
                    </button>
                </div>
            </div>
            <div class="row justify-content-end w-100">
                <div class="row bg-secondary text-white col-12 py-1">
                    <div class="col-2 text-start border-end border-white d-flex align-items-center">Seleccionar</div>
                    <div class="col-3 text-start border-end border-white d-flex justify-content-between align-items-center">
                        Nombre
                        <div class="d-flex flex-column">
                            <i class="bi bi-caret-up-fill order" id='name-up'></i>
                            <i class="bi bi-caret-down-fill order" id="name-down"></i>
                        </div>
                    </div>
                    <div class="col-4 text-start border-end border-white d-flex justify-content-between align-items-center">
                        Email
                        <div class="d-flex flex-column">
                            <i class="bi bi-caret-up-fill order" id='email-up'></i>
                            <i class="bi bi-caret-down-fill order" id="email-down"></i>
                        </div>
                    </div>
                    <div class="col-3 text-start d-flex justify-content-between align-items-center">
                        Creado
                        <div class="d-flex flex-column">
                            <i class="bi bi-caret-up-fill order" id='created_at-up'></i>
                            <i class="bi bi-caret-down-fill order" id="created_at-down"></i>
                        </div>
                    </div>
                </div>
                @foreach ($users as $user)
                    <div class="row {{$loop->index != 0 ? 'border-top border-secondary' : ''}}">
                        <div class="col-2 border-end border-secondary">
                            <div class="form-check">
                                <input class="form-check-input select-user"
                                    value="{{$user->id}}" type="checkbox" />
                            </div>
                        </div>
                        <div class="col-3 border-end border-secondary">{{ $user->name }}</div>
                        <div class="col-4 border-end border-secondary">{{ $user->email }}</div>
                        <div class="col-3">{{ $user->created_at }}</div>
                    </div>
                @endforeach
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <!-- Añadir usuario -->
    <!-- Modal centrado verticalmente -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content p-4" method="POST" :action="route('users.store')">
                @csrf
                <div class="input-group mb-3 d-flex ">
                    <label for="name" class="col-12">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre"
                        id="name"
                        name="name" value="">
                    @error('name')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3 d-flex">
                    <label for="email" class="col-12">Email</label>
                    <input type="email" id="email" class="form-control" name="email"
                        value="">
                    @error('email')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="password" class="col-12">Contraseña</label>
                    <input type="password" id="password" class="form-control" name="password"
                        value="">
                    @error('password')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="password_confirmation" class="col-12">Confirmación contraseña</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                        value="">
                    @error('password_confirmation')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Editar user -->
    <!-- Modal centrado verticalmente -->
    <div class="modal fade" id="editUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content p-4" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group mb-3 d-flex ">
                    <label for="name-editar" class="col-12">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre"
                        id="name-editar"
                        name="name" value="">
                    @error('name')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3 d-flex">
                    <label for="email-editar" class="col-12">Email</label>
                    <input type="email" id="email-editar" class="form-control" name="email"
                        value="">
                    @error('email')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="password-editar" class="col-12">Contraseña</label>
                    <input type="password" id="password-editar" class="form-control" name="password"
                        value="">
                    @error('password')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="password_confirmation-editar" class="col-12">Confirmación contraseña</label>
                    <input type="password" id="password_confirmation-editar"
                        class="form-control" name="password_confirmation"
                        value="">
                    @error('password_confirmation')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts-body')
        @vite(['resources/js/scripts/users.js'])
    @endpush
</x-app-layout>
