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
                <button class="btn btn-secondary" type="button" id="eliminar">
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
                    <div class="col-1 text-start border-end border-white">Seleccionar</div>
                    <div class="col-2 text-start border-end border-white">Nombre</div>
                    <div class="col-2 text-start border-end border-white">Color</div>
                    <div class="col-2 text-start border-end border-white">Día</div>
                    <div class="col-2 text-start border-end border-white">Mes</div>
                    <div class="col-2 text-start border-end border-white">Año</div>
                    <div class="col-1 text-start">Recurrente</div>
                </div>
                @foreach ($dias_festivos as $dia_festivo)
                    <div class="row {{$loop->index != 0 ? 'border-top border-secondary' : ''}}">
                        <div class="col-1 border-end border-secondary">
                            <div class="form-check">
                                <input class="form-check-input select-dia-festivo"
                                    value="{{$dia_festivo->id}}" type="checkbox" />
                            </div>
                        </div>
                        <div class="col-2 border-end border-secondary">{{ $dia_festivo->nombre }}</div>
                        <div class="col-2 border-end border-secondary">{{ $dia_festivo->color }}</div>
                        <div class="col-2 border-end border-secondary">{{ $dia_festivo->dia }}</div>
                        <div class="col-2 border-end border-secondary">{{ $dia_festivo->mes }}</div>
                        <div class="col-2 border-end border-secondary">{{ $dia_festivo->anyo }}</div>
                        <div class="col-1">
                            <div class="form-check">
                                {{ $dia_festivo->recurrente ? 'Si' : 'No' }}
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $dias_festivos->links() }}
            </div>
        </div>
    </div>
    <!-- Añadir dia festivo -->
    <!-- Modal centrado verticalmente -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content p-4" method="POST" :action="route('dias-festivos.store')">
                @csrf
                <div class="input-group mb-3 d-flex ">
                    <label for="nombre" class="col-12">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" id="nombre"
                        name="nombre" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3 d-flex">
                    <label for="color" class="col-12">Color</label>
                    <input type="color" id="color" class="form-control" name="color"
                        value="{{ old('color') }}">
                    @error('color')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="dia" class="col-12">Día</label>
                    <input type="text" id="dia" class="form-control" name="dia"
                        value="{{ old('dia') }}">
                    @error('dia')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="mes" class="col-12">Mes</label>
                    <input type="text" id="mes" class="form-control" name="mes"
                        value="{{ old('mes') }}">
                    @error('mes')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="anyo" class="col-12">Año</label>
                    <input type="text" id="anyo" class="form-control" name="anyo"
                        value="{{ old('anyo') }}">
                    @error('anyo')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="recurrente" class="col-12">Es recurrente</label>
                    <input type="checkbox" id="recurrente" class="form-check-input"
                        name="recurrente">
                    @error('recurrente')
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
    <!-- Editar dia festivo -->
    <!-- Modal centrado verticalmente -->
    <div class="modal fade" id="editDiaFestivo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content p-4" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group mb-3 d-flex ">
                    <label for="nombre-editar" class="col-12">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre"
                    aria-label="Nombre" id="nombre-editar"
                        name="nombre" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3 d-flex">
                    <label for="color-editar" class="col-12">Color</label>
                    <input type="color" id="color-editar" class="form-control" name="color"
                        value="{{ old('color') }}">
                    @error('color')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="dia-editar" class="col-12">Día</label>
                    <input type="text" id="dia-editar" class="form-control" name="dia"
                        value="{{ old('dia') }}">
                    @error('dia')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="mes-editar" class="col-12">Mes</label>
                    <input type="text" id="mes-editar" class="form-control" name="mes"
                        value="{{ old('mes') }}">
                    @error('mes')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="anyo-editar" class="col-12">Año</label>
                    <input type="text" id="anyo-editar" class="form-control" name="anyo"
                        value="{{ old('anyo') }}">
                    @error('anyo')
                        <div class="col-12 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="recurrente-editar" class="col-12">Es recurrente</label>
                    <input type="checkbox" id="recurrente-editar" class="form-check-input"
                        name="recurrente">
                    @error('recurrente')
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
        @vite(['resources/js/scripts/dias-festivos.js'])
    @endpush
</x-app-layout>
