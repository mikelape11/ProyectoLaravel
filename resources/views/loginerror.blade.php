@extends('layouts.app')

<style>
    #body{
        background-color: #3f0d12;
        background-image: linear-gradient(315deg, #3f0d12 0%, #a71d31 74%);
        background-attachment: fixed;
        height: 100%;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Error Login</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 style="color:darkred">La cuenta tiene que ser de plaiaundi</h2>

                    <a href="/login"><button>Aceptar</button></a>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection