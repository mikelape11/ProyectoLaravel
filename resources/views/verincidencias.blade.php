@extends('layouts.app')

<style>
    #body{
        background-color: #2d3436;
        background-image: linear-gradient(315deg, #d3d3d3 0%, #2d3436 74%);
	    background-attachment: fixed;  
        height: 100%;
    }

    .contenido{
        width: 80%;
        margin-left: 10%;
    }

    .boton{
        width: 30%;
        float: left;
        margin-bottom: 2%;
    }

    table{
        position: relative;
        width: 80%;
        color: white;
    }
    
    tr{
        background-color: black;
        text-align: center;
        
    }

    th{
        background-color: lightgrey;
    }
    
    td{
        text-align: center;
        color: white;
    }
</style>

@section('content')

    <div class="contenido">
        <center><h1 style="color: white;"> Lista Incidencias </h1><center><br>
            <div class="boton">
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <a href="{{ url('/nuevaincidencia') }}" style="margin-top: -20px;" class="btn btn-lg btn-success btn-block" width="200px;">
                            <strong>Añadir Nueva Incidencia</strong>
                        </a> 
                    </div>
                </div>
            </div>
            <br>
            <table class="table">    
                <tr>
                    <th><a href="/verincidencia2" title="Ordenar">ID</a></th>
                    <th>PROFESOR</th>
                    <th><a href="/verincidenciafecha2" title="Ordenar">FECHA</a></th>
                    <th>AULA</th>
                    <th>HORA</th>
                    <th>EQUIPO</th>
                    <th>ID.PROF.</th>
                    <th>ID.AVER.</th>
                    <th>ELIMINAR</th>
                    <th>MODIFICAR</th>
                </tr>
                @foreach($datos as $dato)
                <tr>
                    <td><a href="/detalle/{{$dato->id}}" title="Ver detalles avanzados">{{$dato->id}}</a></td>
                    <td>{{$dato->profesor}}</td>
                    <td>{{$dato->fecha}}</td>
                    <td>{{$dato->aula}}</td>
                    <td>{{$dato->hora}}</td>
                    <td>{{$dato->equipo}}</td>
                    <td>{{$dato->id_profesor}}</td>
                    <td>{{$dato->id_averia}}</td>
                    <td style="padding: 0 0 0 5;"><a href="/elimina/{{$dato->id}}"><button class="button is-danger is-light" ><b>eliminar</b></button></a></td>
                    <td style="padding: 0 0 0 5;"><a href="/modifica/{{$dato->id}}"><button class="button is-warning is-light"><b>modificar</b></button></a></td>
                </tr>
                @endforeach
            </table>
    </div> 
@endsection