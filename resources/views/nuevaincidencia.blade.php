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
                <div class="card-header">Nueva Incidencia</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/pasarincidencia" method="post">
                        @csrf
                    <h2>Introducir datos de la incidencia</h2>
                    Fecha: <input class="input is-info" type="date" name="fecha" size="60px" value="{{old('fecha')}}" ><br>
                    <br>
                    Aula: <input class="input is-info" type="text" name="aula" size="60px" value="{{old('aula')}}"><br>
                    <br>
                    Hora: <input class="input is-info" type="time" name="hora" size="60px" value="{{old('hora')}}"><br>
                    <br>
                    Equipo: <input class="input is-info" type="text" name="equipo" size="60px" value="{{old('equipo')}}"><br>
                    <br>
                    Averia:<br> <div class="select is-info"><select name="id_averia">
                        <option selected value="{{old('id_averia')}}"> Elige una opción </option>
                        <option value="1">No se enciende la CPU/ CPU ez da pizten</option> 
                        <option value="2">No se enciende la pantalla/Pantaila ez da pizten</option> 
                        <option value="3">No entra en mi sesión/ ezin sartu nere erabiltzailearekin</option> 
                        <option value="4">No navega en Internet/ Internet ez dabil</option> 
                        <option value="5">No se oye el sonido/ Ez da aditzen</option> 
                        <option value="6">No lee el DVD/CD</option> 
                        <option value="7">Teclado roto/ Tekladu hondatuta</option> 
                        <option value="8">No funciona el ratón/Xagua ez dabil</option> 
                        <option value="9">Muy lento para entrar en la sesión/oso motel dijoa</option>
                        <option value="10">Otros/Beste batzuk</option>  
                    </select></div>
                    <br><br>
                    <center><input class="button is-success" type="submit" value="Enviar" style="float:right; margin-right: 35%;"></center>
                    </form>
                    <center><a href="/verincidencia"><button class="button is-primary" style="float:left; margin: -2.4%; margin-left: 35%;">Volver</button></a></center>
                    @if ($errors->any())
                    <br><br>
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
