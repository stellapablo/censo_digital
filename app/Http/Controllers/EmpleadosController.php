<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Area;
use App\Biometria;
use App\Cargo;
use App\CargoRevista;
use App\Personal;
use App\Revista;
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
            return view('empleados.upd_personales',compact('agente','data'));
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

        $personal = Personal::where('empleado_id','=',$request->empleado_id)->first();
        $personal->fill($data)->save();

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

    public function formacion($id){

        $agente = Agente::find($id);

        session(['agente_id' => $id]);
        session(['agente_nya' => $agente->APYNOM]);
        session(['agente_dni' => $agente->DOCUME]);

        return view('empleados.cargos');
    }

    public function deleteCargo($id){

        $cargo = Cargo::find($id);
        $cargo->delete();

        return redirect()->route('cargo',[session('agente_id')])->withSuccess('Datos actualizados');

    }

    public function revista($id){


        $revista =  ['' => ''] + Revista::orderBy('nombre','desc')->pluck('nombre','id')->all();
        $agente = Agente::find($id);
        $areas = ['' => ''] + Area::orderBy('are_des')->pluck('are_des','are_nro')->all();

        //subroga
        $sub = $this->checkSubr($agente);
        $cargo_sub = $this->cargoSubr($agente);

        $data = CargoRevista::where('empleado_id','=',$id)->first();

        if($data != null ){

            return view('empleados.upd_revista',compact('agente','data','revista','sub','cargo_sub','areas'));
        }

        return view('empleados.revista',compact('agente','revista','areas','sub','cargo_sub'));
    }

    public function srevista(Request  $request){

        CargoRevista::create($request->all());

        return redirect()->route('revista', ['id' => $request->empleado_id])->withSuccess('Datos Actualizados correctamente');
    }

    public function urevista(Request  $request){

        $data = $request->all();

        $personal = CargoRevista::where('empleado_id','=',$request->empleado_id)->first();
        $personal->fill($data)->save();

        return redirect()->route('revista', ['id' => $request->empleado_id])->withSuccess('Datos Actualizados correctamente');
    }

    public function checkSubr(Agente $agente){

        if($agente->SUBRGR <> 0){
            return "Si";
        }else{
            return "No";
        }
    }

    public function cargoSubr(Agente $agente){

        $dir = array("16", "17", "18");

        if($agente->SUBRGR = 21){
            return 'Direccion General';
        }

        if($agente->SUBRGR = 20 or $agente->SUBRGR = 19){
            return 'Direccion';
        }

        if (in_array($agente->SUBRGR, $dir )) {
            return "Jefe de Departamento";
        }

        return 'Sin informacion';

    }

}
