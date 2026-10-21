
@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <form action="{{ route('profesor.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" value="{{ old('nombre') }}" class="form-control" id="nombre" name="nombre" required minlength="2" maxlength="100" placeholder="Introduce el nombre del profesor">
                    @error('nombre')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" value="{{ old('apellidos') }}" class="form-control" id="apellidos" name="apellidos" required minlength="3" maxlength="130" placeholder="Introduce los apellidos del profesor">
                    @error('apellidos')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" value="{{ old('especialidad') }}" class="form-control" id="especialidad" name="especialidad" required minlength="2" maxlength="100" placeholder="Introduce la especialidad">
                    @error('especialidad')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_alta" class="form-label">Fecha de alta</label>
                    <input type="date" value="{{ old('fecha_alta') }}" class="form-control" id="fecha_alta" name="fecha_alta" required max="{{ now()->format('Y-m-d') }}">
                    @error('fecha_alta')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="salario" class="form-label">Salario</label>
                    <input type="number" value="{{ old('salario') }}" class="form-control" id="salario" name="salario" required min="0" step="0.01" placeholder="Introduce el salario">
                    @error('salario')
                    <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                @error('error')
                <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                    {{ $message }}
                </div>
                @enderror

                <button type="submit" class="btn btn-secondary">
                    Crear profesor
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
