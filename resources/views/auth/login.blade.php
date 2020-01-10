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
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <a href="{{ url('/redirect') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
                                    <strong>Login With Google</strong>
                                    <iframe id="idlogoutframe" src="https:\\accounts.google.com/logout" style="display:none"></iframe>
                                </a> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
