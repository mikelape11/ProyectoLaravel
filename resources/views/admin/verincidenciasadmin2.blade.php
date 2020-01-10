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

    th{
        background-color: lightgrey;
    }
    
    tr{
        background-color: black;
        text-align: center;
    }
    
    td{
        text-align: center;
        color: white;
    }
</style>

@section('content')

    <div class="contenido">
        <center><h1 style="color: white;"> Lista Incidencias ADMINISTRADOR</h1><center><br>
            <table class="table">  
                <th><a href="/verincidenciasadmin" title="Ordenar de Mayor a Menor">ID</a></th>
                <th>PROFESOR</th>
                <th><a href="/verincidenciasfechaadmin" title="Ordenar de Nuevo a Viejo">FECHA</a></th>
                <th>AULA</th>
                <th>HORA</th>
                <th>EQUIPO</th>
                <th>ID.PROF.</th>
                <th>ID.AVER.</th>
                <th>Resolver</th>
            </tr>
            @foreach($datos as $dato)
            
            <tr>
                <td><a href="/detalleadmin/{{$dato->id}}" title="Ver detalles avanzados">{{$dato->id}}</a></td>
                <td>{{$dato->profesor}}</td>
                <td>{{$dato->fecha}}</td>
                <td>{{$dato->aula}}</td>
                <td>{{$dato->hora}}</td>
                <td>{{$dato->equipo}}</td>
                <td>{{$dato->id_profesor}}</td>
                <td>{{$dato->id_averia}}</td>
                <td style="padding: 0 0 0 5;"><a href="/modificaadmin/{{$dato->id}}"><button class="button is-warning is-light" ><b>resolver</b></button></a></td>
                
            </tr>
            @endforeach
            </table>
    </div>
@endsection