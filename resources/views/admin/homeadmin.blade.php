@extends('layouts.app')
<style>
    #body{
        background-color:lightseagreen;
    }
    
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Administrador</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <center><h4>BIENVENIDO</h4><center>
                    
                    <a href="/verincidenciasadmin"><button>Consultar Incidencias</button></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
