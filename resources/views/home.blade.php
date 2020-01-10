@extends('layouts.app')
<style>
    #body{
        background-color:lightcoral;
    }
    #boton1{
        margin-left: -50%;
        width: 50%;
        height: 50%;
    }
    #boton2{
        margin-top: -12.4%;
        margin-left: 50%;
        width: 50%;
        height: 50%;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Usuario</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <center><h4>Menu Usuario</h4><center>
                    
                    <a href="/nuevaincidencia"><button id="boton1"> Crear nueva incidencia</button></a><br><br>
                    <a href="/verincidencia"><button id="boton2">Ver lista de incidencias</button></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
