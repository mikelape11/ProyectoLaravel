@extends('layouts.app')
<style>
   #body{
        background-image: linear-gradient(315deg, #d3d3d3 0%, #2d3436 74%);
	    background-attachment: fixed;  
        height: 100%;
    }

    .contenido{
        width: 60%;
        margin-left: 20%;
    }

    table{
        position: relative;
        width: 80%;
    }
    
    tr{
        background-color: white;
        text-align: center;
    }
    
    td{
        text-align: center;
    }
</style>
@section('content')
<div class="contenido">
    <h2 style="color: white;">Detalles de la incidencia</h2>
    <table class="table">
        @foreach($datos as $dato)
        <tr>
            <th>ID</th>
            <th>ID AVERIA</th>
            <th>ESTADO</th>
            <th>OPINION ADMIN</th>
        </tr>
        <tr>
            <td>{{$dato->id}}</td>
            <td>{{$dato->id_averia}}</td>
            <td>{{$dato->estado}}</td>
            <td>{{$dato->opinion}}</td>
        </tr>
        @endforeach
    </table>
    <center><a href="/verincidencia"><button class="button is-primary">Volver</button></a></center>
</div>
@endsection