
@extends('template.base')

@section('css')
<link href="{{ asset('assets/style/show.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="card text-center">
                <img src="{{ asset('assets/img/alumno.jpg') }}" class="card-img-top" alt="Profesor">
                <div class="card-body">
                    <h5 class="card-title">{{ $profesor->nombre . ' ' . $profesor->apellidos }}</h5>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title">Especialidad: {{ $profesor->especialidad }}</h4>
                    <h4 class="card-title">
                        Fecha de alta:
                        {{ Carbon\Carbon::parse($profesor->fecha_alta)->locale('es')->translatedFormat('j \d\e F \d\e Y') }}
                    </h4>
                    <h4 class="card-title">Salario: {{ number_format($profesor->salario, 2, ',', '.') }} €</h4>

                    <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
