<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Días Festivos') }}
        </h2>
    </x-slot>
    <div class="m-3">
        <div>
            <div class="fs-3">
                Listado Días Festivos
            </div>
            <div>
                <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Añadir
                </button>
                <button class="btn btn-secondary" type="button" id="editar">
                    Editar
                </button>
                <button class="btn btn-secondary" type="button">
                    Eliminar
                </button>
            </div>
        </div>
        <div class="m-1 p-2 bg-white">
            <div class="row justify-content-end w-100">

                <div class="row bg-secondary text-white col-12 py-1">
                    <div class="col-2 text-start border-end border-white">Seleccionar</div>
                    <div class="col-3 text-start border-end border-white">Nombre</div>
                    <div class="col-4 text-start border-end border-white">Email</div>
                    <div class="col-3 text-start">Creado</div>
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
