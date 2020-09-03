<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Biometria;
use Illuminate\Http\Request;
use File;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function step1()
    {
        //$users = User::all();
        return view('empleados.step1');
    }

    public function salud($id)
    {
        $agente = Agente::find($id);

        return view('empleados.salud',compact('agente'));
    }

    public function ssalud(Request $request){
        dd($request->all());
    }

    public function personal($id)
    {
        $agente = Agente::find($id);

        return view('empleados.personales',compact('agente'));
    }

    public function spersonal(Request $request){
        dd($request->all());
    }

    public function biometrico($id){

        $agente = Agente::find($id);

        return view('empleados.biometrico',compact('agente'));
    }


    public function sbiometrico(Request $request, $id){

        $image = $request->file('file');
        $avatarName = $image->getClientOriginalName();
        $image->move(public_path('images'),$avatarName);

        $imageUpload = new Biometria();
        $imageUpload->empleado_id = $id;
        $imageUpload->imagen = $avatarName;
        $imageUpload->save();

        return response()->json(['success'=>$avatarName]);
    }

    public function removeImage(Request $request) {

       Biometria::where('imagen','=',$request->nombre)->delete();

        if(File::exists(public_path('images/'.$request->nombre))){
            File::delete(public_path('images/'.$request->nombre));
        }else{
            return response()->json(['success'=>$request]);

        }
    }


}
