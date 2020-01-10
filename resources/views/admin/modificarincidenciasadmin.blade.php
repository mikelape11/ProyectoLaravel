@extends('layouts.app')
<style>
   #body{
        background-color: #2d3436;
        background-image: linear-gradient(315deg, #d3d3d3 0%, #2d3436 74%);
	    background-attachment: fixed;
        height: 100%;
   }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modficar Incidencia</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($datos as $dato)
                    <form action="/modificarincidenciaadmin/{{ $dato->id }}" method="post">
                        @csrf
                    <h2>Modificar datos de la incidencia</h2>
                    <br>
                    Estado: <Select name="estado">
                        <option selected value="{{ $dato->estado }}">{{ $dato->estado }}</option>
                        <option value="Recibida">Recibida</option> 
                        <option value="Resuelta">Resuelta</option> 
                        <option value="En Proceso">En Proceso</option> 
                        <option value="Rechazada">Rechazada</option> 
                    </select>
                    <br><br>
                    Opinion Admin <input type="text" name="opinion" value="{{ $dato->opinion }}" size="60px"><br>
                    <br>
                    <center><input class="button is-success" type="submit" value="Enviar" style="float:right; margin-right: 35%;"></center>
                    </form>
                    @endforeach
                    <center><a href="/verincidenciasadmin"><button class="button is-primary" style="float:left; margin: -2.4%; margin-left: 35%;">Volver</button></a></center>
                    @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
