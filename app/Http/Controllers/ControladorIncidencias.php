<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidencias;
use Validator;
use Auth;
use DB;
use Mail;

class ControladorIncidencias extends Controller
{
    public function nuevaIncidencia(){
        return view('nuevaincidencia');
    }
    //AÑADE LOS DATOS
    public function pasarincidencia(Request $request){
        $validator = Validator::make($request->all(),[
            'profesor' => 'required|min:3|max:50',
            'fecha' => 'required',
            'aula' => 'required|regex:/^[0-9]{3}$/',
            'hora' => 'required',
            'equipo' => 'required|regex:/^HZ[0-9]{6}$/',
            'id_averia' => 'required',
        
        ],[
            'required' => ':attribute es obligatorio',
            'numeric' => ':attribute tiene que ser numerico',
            'alpha' => ':attribute tiene que ser solo letras',
            'profesor.min' => ':attribute tiene que tener minimo 3 caracteres',
            'profesor.max' => ':attribute tiene que tener maximo 20 caracteres',
            'fecha.date_format' => ':attribute tiene que ser formato dd/mm/yy',
            'aula.regex' => ':attribute tiene que tener 3 digitos',
            'hora.regex' => ':attribute tiene que ser de formato hh:mm',
            'equipo.regex' => ':attribute tiene que tener HZ + 6 digitos',
        ]);

        if($validator->fails()){
            return redirect()->back()-> withErrors($validator);
        }else{
           
            $data = array('name' => Auth::user()->name);
            Mail::send('enviaremail', $data, function ($message){
                $message->from('ik012108cac@plaiaundi.net', 'Email Enviado');
                $message->to(Auth::user()->email)->subject('Incidencia Añadida');
            });
            $datos = new Incidencias($request->all());
            $datos->id_profesor = Auth::user()->id;
            $datos->estado = 'En proceso';
            $datos->opinion = 'El administrador todavia no ha recibido la incidencia.';
            $datos->save();
            return redirect('/verincidencia');
        }
    }

    //ENSEÑA LOS DATOS DEL USUARIO LOGEADO
    public function verDatos(){
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia')->where('id_profesor', Auth::user()->id)->orderBy('id','asc')->get();
        return view('verincidencias')->with('datos', $datos);
    }

    public function verDatosDesc(){
        $datos=Incidencias::orderBy('id','desc')->where('id_profesor', Auth::user()->id)->get();
        return view('verincidencias2')->with('datos', $datos);  
    }

    public function verDatosFecha(){
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia')->where('id_profesor', Auth::user()->id)->orderBy('fecha','asc')->get();
        return view('verincidencias')->with('datos', $datos);
    }

    public function verDatosFechaDesc(){
        $datos=Incidencias::orderBy('fecha','desc')->where('id_profesor', Auth::user()->id)->get();
        return view('verincidencias2')->with('datos', $datos);  
    }
    

    //ENSEÑA LOS DETALLES DE CADA ID SELECCIONADO
    public function verDetalle($i){
        $datos=Incidencias::select('id', 'id_averia', 'estado', 'opinion')->where('id', $i)->get();
        return view('detallesincidencia')->with('datos', $datos);
    }

    //ELIMINA EL ID SELECCIONADO
    public function eliminarDatos($id){
        $datos = Incidencias::find($id);
        $datos->delete();
        return redirect('/verincidencia');
    }

    //ENSEÑA EL FORMULARIO PARA MODIFICAR LOS DATOS
    public function verModificarDatos($i){
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia')->where('id', $i)->get();
        return view('modificarincidencia')->with('datos', $datos);
    }

    //MODIFICA O ACTUALIZA LOS DATOS INTRODUCIDOS EN EL FORMULARIO
    public function ModificarDatos(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'profesor' => 'required|min:3|max:50',
            'fecha' => 'required',
            'aula' => 'required|regex:/^[0-9]{3}$/',
            'hora' => 'required',
            'equipo' => 'required|regex:/^HZ[0-9]{6}$/',
            'id_averia' => 'required',       
        ],[
            'required' => ':attribute es obligatorio',
            'numeric' => ':attribute tiene que ser numerico',
            'alpha' => ':attribute tiene que ser solo letras',
            'profesor.min' => ':attribute tiene que tener minimo 3 caracteres',
            'profesor.max' => ':attribute tiene que tener maximo 20 caracteres',
            'fecha.date_format' => ':attribute tiene que tener ser formato d/m/y',
            'aula.regex' => ':attribute tiene que tener 3 digitos',
            'hora.regex' => ':attribute tiene que ser de formato hh:mm',
            'equipo.regex' => ':attribute tiene que tener HZ + 6 digitos',
            
            
        ]);

        if($validator->fails()){
            return redirect()->back()-> withErrors($validator);
        }else{
            //PARA QUE MODIFICQUE EN LA BBDD
            $datos = Incidencias::find($id);
            $datos->profesor = $request->get('profesor');
            $datos->fecha = $request->get('fecha');
            $datos->aula = $request->get('aula');
            $datos->hora = $request->get('hora');
            $datos->equipo = $request->get('equipo');
            $datos->id_profesor =  Auth::user()->id;
            $datos->id_averia = $request->get('id_averia');
        
            $datos->update();
            return redirect('/verincidencia');
        }
    }

    //ADMIN
    public function verDatosAdmin(){
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia')->orderBy('id','asc')->get();
        return view('admin.verincidenciasadmin')->with('datos', $datos);
    }

    public function verDatosDescAdmin(){
        $datos=Incidencias::orderBy('id','desc')->get();
        return view('admin.verincidenciasadmin2')->with('datos', $datos);  
    }

    public function verDatosFechaAdmin(){
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia')->orderBy('fecha','asc')->get();
        return view('admin.verincidenciasadmin')->with('datos', $datos);
    }

    public function verDatosFechaDescAdmin(){
        $datos=Incidencias::orderBy('fecha','desc')->get();
        return view('admin.verincidenciasadmin2')->with('datos', $datos);  
    }

    public function verDetalleAdmin($i){
        $datos=Incidencias::select('id', 'id_averia', 'estado', 'opinion')->where('id', $i)->get();
        return view('admin.detallesincidenciaadmin')->with('datos', $datos);
    }

    public function verModificarDatosAdmin($i){
        $datos=Incidencias::select('id', 'profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia', 'estado', 'opinion')->where('id', $i)->get();
        return view('admin.modificarincidenciasadmin')->with('datos', $datos);
    }

    public function ModificarDatosAdmin(Request $request, $id){
            $data = array('name' => Auth::user()->name);
            Mail::send('enviaremail', $data, function ($message){
                $message->from('ik012108cac@plaiaundi.net', 'Email Enviado');
                $message->to(Auth::user()->email)->subject('Incidencia Modificada');
            });
            //PARA QUE MODIFICQUE EN LA BBDD
            $datos = Incidencias::find($id);
            $datos->estado = $request->get('estado');
            $datos->opinion = $request->get('opinion');
            
            $datos->update();
            return redirect('/verincidenciasadmin');
        }
    }


        

