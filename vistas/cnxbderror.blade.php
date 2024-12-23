{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Error Conexion BD')
{{-- Sección muestra mensaje de error de conexión a la base de datos --}}
@section('navbar')
<div class="container justify-content-center">
    Error de conexión. Inténtelo más tarde
</div>
@endsection
@section('usermenu')
@endsection