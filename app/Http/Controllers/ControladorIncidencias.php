<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidencias;
use App\User;
use Validator;
use Auth;
use DB;
use Mail;
use App\Rules\Averia;

class ControladorIncidencias extends Controller
{
    public function nuevaIncidencia(){
        return view('nuevaincidencia');
    }
    //AÑADE LOS DATOS
    public function pasarincidencia(Request $request){
        $validator = Validator::make($request->all(),[
            'fecha' => 'required|date_format:Y-m-d',
            'aula' => 'required|regex:/^[0-9]{3}$/',
            'hora' => 'required|date_format:H:i',
            'equipo' => 'required|regex:/^HZ[0-9]{6}$/',
            'id_averia' => 'required|integer|between:1,10', 
        ],[
            'required' => ':attribute es obligatorio',
            'fecha.date_format' => ':attribute tiene que ser formato Y-m-d',
            'hora.date_format' => ':attribute tiene que ser formato hh:mm',
            'aula.regex' => ':attribute tiene que tener 3 digitos',
            'equipo.regex' => ':attribute tiene que tener HZ + 6 digitos',
            
        ]);

        if($validator->fails()){
            return redirect()->back()-> withErrors($validator)->withInput();
        }else{
            $data = array('name' => Auth::user()->name);
            Mail::send('enviaremail', $data, function ($message){
                $message->from('ik012108cac@plaiaundi.net', 'Email Enviado');
                $datos=User::select('email')->where('admin', 1)->get();
                foreach($datos as $email){
                    $message->to($email->email)->subject('Incidencia Añadida');
                }
            });
            
            $datos = new Incidencias($request->all());
            if($request->input('id_averia')=='1'){
                $datos->id_averia = "No se enciende la CPU";
            }else if($request->input('id_averia')=='2'){
                $datos->id_averia = "No se enciende la pantalla";
            }else if($request->input('id_averia')=='3'){
                $datos->id_averia = "No entra en mi sesión";
            }else if($request->input('id_averia')=='4'){
                $datos->id_averia = "No navega en internet";
            }else if($request->input('id_averia')=='5'){
                $datos->id_averia = "No se oye el sonido";
            }else if($request->input('id_averia')=='6'){
                $datos->id_averia = "No lee el DVD";
            }else if($request->input('id_averia')=='7'){
                $datos->id_averia = "Teclado roto";
            }else if($request->input('id_averia')=='8'){
                $datos->id_averia = "No funciona el ratón";
            }else if($request->input('id_averia')=='9'){
                $datos->id_averia = "Muy lento para entrar el la sesión";
            }else if($request->input('id_averia')=='10'){
                $datos->id_averia = "Otro";
            }
            $datos->id_profesor = Auth::user()->id;
            $datos->profesor = Auth::user()->name;
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
            'fecha' => 'required|date_format:Y-m-d',
            'aula' => 'required|regex:/^[0-9]{3}$/',
            'hora' => 'required|date_format:H:i',
            'equipo' => 'required|regex:/^HZ[0-9]{6}$/',
            'id_averia' => 'required',       
        ],[
            'required' => ':attribute es obligatorio',
            'fecha.date_format' => ':attribute tiene que ser formato Y-m-d',
            'hora.date_format' => ':attribute tiene que ser formato hh:mm',
            'aula.regex' => ':attribute tiene que tener 3 digitos',
            'equipo.regex' => ':attribute tiene que tener HZ + 6 digitos',
        ]);

        if($validator->fails()){
            return redirect()->back()-> withErrors($validator);
        }else{
            $data = array('name' => Auth::user()->name);
            Mail::send('enviaremailmod', $data, function ($message){
                $message->from('ik012108cac@plaiaundi.net', 'Email Enviado');
                $datos=User::select('email')->where('admin', 1)->get();
                foreach($datos as $email){
                    $message->to($email->email)->subject('Incidencia Añadida');
                }
            });
            //PARA QUE MODIFICQUE EN LA BBDD
            $datos = Incidencias::find($id);
            $datos->id_profesor = Auth::user()->id;
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

        $validator = Validator::make($request->all(),[
            'estado' => 'required|integer|between:1,4',
            'opinion' => 'required|alpha',    
        ],[
            'required' => ':attribute es obligatorio',
            'alpha' => ':attribute no puede tener numeros',
        ]);
        $data = array('name' => Auth::user()->name);
        Mail::send('enviaremailmod', $data, function ($message){
            $message->from('ik012108cac@plaiaundi.net', 'Email Enviado');
            $datos=User::select('email')->where('admin', 1)->get();
            foreach($datos as $email){
                $message->to($email->email)->subject('Incidencia Añadida');
            }
        });
        //PARA QUE MODIFICQUE EN LA BBDD
        $datos = Incidencias::find($id);
        if($request->input('estado')=='1'){
            $datos->estado = "Recibida";
        }else if($request->input('estado')=='2'){
            $datos->estado = "Resuelta";
        }else if($request->input('estado')=='3'){
            $datos->estado = "En proceso";
        }else if($request->input('estado')=='4'){
            $datos->estado = "Rechazada";
        }
        $datos->opinion = $request->get('opinion');
        
        $datos->update();
        return redirect('/verincidenciasadmin');
    }
}


        

