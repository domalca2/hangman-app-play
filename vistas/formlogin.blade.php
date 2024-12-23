{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Formulario login')
@section('usermenu')
@endsection
{{-- Sección muestra el formulario de login del usuario --}}
@section('content')
<div class="container col-md-6">
    <div>
        @if (isset($error)) 
        <div class="alert alert-danger" role="alert">Error Credenciales</div>
        @endif
        <h2 class="text-center">Login</h2>
        <div>
            <form method="POST" action="index.php" id='formlogin'>
                <div class="mb-3 row">                            
                    <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input id="inputNombre" type="text"
                               class="form-control col-sm-10" id="inputNombre" placeholder="Nombre" name="nombre">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password"
                               class="form-control col-sm-10" id="inputPassword" placeholder="Password" name="clave">
                    </div>        
                </div>
                <div class="mb-3">
                    <div class="col-md-8 col-md-offset-4">
                        <input type="submit" class="btn btn-primary" name="botonproclogin" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
