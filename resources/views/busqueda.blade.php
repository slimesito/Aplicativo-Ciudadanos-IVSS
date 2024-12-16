@extends('layout.layout')

@section('title', 'Resultados búsqueda')

@section('content')

    <table class="content-table">

        <thead>

            <tr>
        
                <th scope="col">Cédula de Identidad</th>
                <th scope="col">Primer Nombre</th>
                <th scope="col">Segundo Nombre</th>
                <th scope="col">Primer Apellido</th>
                <th scope="col">Segundo Apellido</th>
                <th scope="col">Sexo</th>
                <th scope="col">Estado Civil</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Fecha de fallecimiento</th>
        
            </tr>

        </thead>

        <tbody>

            @foreach($ciudadanos as $ciudadano)
                <tr>
                    <td>{{ $ciudadano->id_ciudadano }}</td>
                    <td>{{ $ciudadano->primer_nombre }}</td>
                    <td>{{ $ciudadano->segundo_nombre }}</td>
                    <td>{{ $ciudadano->primer_apellido }}</td>
                    <td>{{ $ciudadano->segundo_apellido }}</td>
                    <td>{{ $ciudadano->sexo }}</td>
                    <td>
                        @switch($ciudadano->id_estado_civil)
                            @case(1)
                                Soltero(a)
                                @break
                            @case(2)
                                Separado(a)
                                @break
                            @case(3)
                                Viudo(a)
                                @break
                            @case(4)
                                Casado(a)
                                @break
                            @case(5)
                                Divorciado(a) con nuevas nupcias
                                @break
                            @case(6)
                                Divorciado(a) sin nuevas nupcias
                                @break
                            @default
                                Desconocido
                        @endswitch
                    </td>
                    <td>{{ \Carbon\Carbon::parse($ciudadano->fecha_nacimiento)->format('d-m-Y') }}</td>
                    <td>{{ $ciudadano->fecha_fallecimiento }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>

    <div class="back">
        <p><a href="{{ url('/') }}">Regresar</a></p>
    </div>

@endsection
