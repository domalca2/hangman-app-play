{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Puntuación Partidas')
@section('navbar')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="juego.php">Volver</a>
</li>
@endsection
{{-- Sección muestra puntuación de las partidas --}}
@section('content')
<div class="container">
    <h2 class="text-center my-4">Puntuación de partidas jugadas</h2>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Palabra</th>
                        <th scope="col">#Errores</th>
                        <th scope="col">Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($panelPuntuacion))
                    @foreach($panelPuntuacion as $puntuacion)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $puntuacion[0] }}</td>
                        <td>{{ $puntuacion[1] }}</td>
                        <td>{{ $puntuacion[2] }}</td>
                    </tr>
                    @endforeach
                    <tr class="">
                        <td colspan="3" class="text-end fs-5 fw-bold">Total:</td>
                        <td class="fs-5">{{ array_sum(array_column($panelPuntuacion,2)) }}</td>
                    </tr>
                    @else
                    <tr><td>No hay partidas</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection