<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidencias;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia')->where('id_profesor', Auth::user()->id)->orderBy('id','asc')->get();
        return view('verincidencias')->with('datos', $datos);
    }

    public function admin(){
        return view('admin.verincidenciasadmin');
    }
}
