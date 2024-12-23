{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Introduce Jugada')
{{-- Sección muestra vista de juego para que el usuario elija una letra --}}
@section ('navbar')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="juego.php?botonnuevapartida">Nueva Partida</a>
</li>
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="juego.php?botonpuntuacionpartidas">Puntuación Partidas</a>
</li>
@endsection
@section('content')
@set($imgsHangman=['Hangman-0.png','Hangman-1.png','Hangman-2.png','Hangman-3.png','Hangman-4.png','Hangman-5.png'])
<div class="container">
    <div class="position-relative p-5">
        <div class="position-absolute top-50 start-50 translate-middle">
            <h1 id='mensaje_fin'>{{ $partida->esFin() ? ($partida->esPalabraDescubierta() ? "Enhorabuena!" : "Has perdido!") : ""}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <h1>{{ $partida->esFin() ? implode(" ", str_split($partida->getPalabraSecreta())) : implode(" ", str_split($partida->getPalabraDescubierta())) }}</h1>
            <form action="juego.php" method="POST">
                <div class="input-group">
                    <input type="text" name="letra" autofocus="autofocus" class="form-control {{ (isset($error)) ? (($error) ? "is-invalid" : "is-valid") : "" }} " 
                           accept="" placeholder="Introduce una letra" {{ $partida->esFin() ? "disabled" : "" }}>
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary mx-4" name="botonenviarjugada" type="submit" value="Enviar Jugada" {{ $partida->esFin() ? "disabled" : "" }}>
                    </div>
                    <div class="invalid-feedback">
                        La letra no es correcta o ya se ha introducido.
                    </div>
                </div>
            </form>
            <h3 class="my-4">Las letras introducidas hasta el momento son:</h3>
            <h3>{{ implode(" ", str_split($partida->getLetras())) }}</h3>
            <h3 id="pista"></h3>
        </div>
        <div class="col-sm-4">
            <img src="./assets/img/{{ $imgsHangman[$partida->getNumErrores()] }}" class="img-fluid">
        </div>
    </div>
</div>
@endsection