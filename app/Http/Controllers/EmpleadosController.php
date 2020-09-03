<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Biometria;
use App\Personal;
use App\Salud;
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

        $data = Salud::where('empleado_id','=',$id)->first();

        if($data != null ){

            return view('empleados.upd_salud',compact('agente','data'));
        }

        return view('empleados.salud',compact('agente'));
    }

    public function ssalud(Request $request){

        Salud::create($request->all());

        return redirect()->route('salud', ['id' => $request->empleado_id])->withSuccess('Datos Actualizados correctamente');
    }


    public function usalud(Request $request){

        $data = $request->all();
        $salud = Salud::where('empleado_id','=',$request->empleado_id)->first();
        $salud->fill($data)->save();

        return redirect()->route('salud', ['id' => $request->empleado_id])->withSuccess('Datos Actualizados correctamente');

    }



    public function personal($id){

        $agente = Agente::find($id);
        $data = Personal::where('empleado_id','=',$id)->first();

        if($data != null ){
            return view('empleados.upd_salud',compact('agente','data'));
        }

        return view('empleados.personales',compact('agente'));
    }

    //create datos personales
    public function spersonal(Request $request){

        Personal::create($request->all());
        return redirect()->route('personal', ['id' => $request->empleado_id])->withSuccess('Datos Actualizados correctamente');

    }

    //update datos personales
    public function upersonal(Request $request){

        $data = $request->all();
        $salud = Personal::where('empleado_id','=',$request->empleado_id)->first();
        $salud->fill($data)->save();

        return redirect()->route('personal', ['id' => $request->empleado_id])->withSuccess('Datos Actualizados correctamente');

    }



    public function biometrico($id){

        $agente = Agente::find($id);

        $images = Biometria::where('empleado_id','=',$id)->get();

        return view('empleados.biometrico',compact('agente','images'));

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

    public function fetchImages()
    {
        $images = File::allFiles(public_path('images'));
        $output = '<div class="row">';
        foreach($images as $image)
            {
                $output .= '
          <div class="col-md-2" style="margin-bottom:16px;" align="center">
                    <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                    <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
                </div>
          ';
        }
        $output .= '</div>';
        echo $output;
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
