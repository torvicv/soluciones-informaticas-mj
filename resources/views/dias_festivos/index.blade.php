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
                <button class="btn btn-secondary" type="button">
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
                                <input class="form-check-input" type="checkbox" />
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
    <!-- Vertically centered modal -->
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
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3 d-flex">
                    <label for="color" class="col-12">Color</label>
                    <input type="color" id="color" class="form-control" name="color"
                        value="{{ old('color') }}">
                    @error('color')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="dia" class="col-12">Día</label>
                    <input type="text" id="dia" class="form-control" name="dia"
                        value="{{ old('dia') }}">
                    @error('dia')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="mes" class="col-12">Mes</label>
                    <input type="text" id="mes" class="form-control" name="mes"
                        value="{{ old('mes') }}">
                    @error('mes')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3 d-flex">
                    <label for="anyo" class="col-12">Año</label>
                    <input type="text" id="anyo" class="form-control" name="anyo"
                        value="{{ old('anyo') }}">
                    @error('anyo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts-body')
        @vite(['resources/js/scripts/dias-festivos.js'])
    @endpush
</x-app-layout>
