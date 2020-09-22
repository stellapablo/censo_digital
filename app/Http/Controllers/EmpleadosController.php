<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Area;
use App\Biometria;
use App\Cargo;
use App\CargoRevista;
use App\Familia;
use App\Invoice;
use App\InvoiceDetail;
use App\Licencia;
use App\Personal;
use App\Reloj;
use App\Revista;
use App\Salud;
use App\Titulo;
use App\Vacuna;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Date;

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

    public $posta= '<i class="fas fa-check"></i>';

    public function salud($id)
    {
        $agente = Agente::where('NROUAG','=',$id)->first();

        $data = Salud::where('empleado_id','=',$id)->first();

        $licencias = Licencia::where('NROUAG','=',$id)->select('FDESDE','FHASTA','DIAGNO','CODLRM')->orderBy('id','DESC')->take(10)->get();

        $vacunas = Vacuna::where('DNI','=',$agente->DOCUME)->first();


        if($data != null ){

            return view('empleados.upd_salud',compact('agente','data','licencias'));
        }

        return view('empleados.salud',compact('agente','licencias'));
    }

    public function ssalud(Request $request){

        Agente::where('NROUAG','=',$request->empleado_id)->update(['posta1'=>$this->posta]);

        Salud::create($request->all());

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');
    }


    public function usalud(Request $request){

        $data = $request->all();
        $salud = Salud::where('empleado_id','=',$request->empleado_id)->first();
        $salud->fill($data)->save();

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');

    }


    public function personal($id){

        $agente = Agente::where('nrouag','=',$id)->first();
        $data = Personal::where('empleado_id','=',$id)->first();
        $familiares = Familia::where('nrouag','=',$id)->get();


        if($data != null ){
            return view('empleados.upd_personales',compact('agente','data','familiares'));
        }

        return view('empleados.personales',compact('agente','familiares'));
    }

    //create datos personales
    public function spersonal(Request $request){

        Agente::where('NROUAG','=',$request->empleado_id)->update(['posta2'=>$this->posta]);

        Personal::create($request->all());

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');

    }

    //update datos personales
    public function upersonal(Request $request){

        $data = $request->all();

        $personal = Personal::where('empleado_id','=',$request->empleado_id)->first();
        $personal->fill($data)->save();

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');

    }


    public function biometrico($id){

        $agente = Agente::where('nrouag','=',$id)->first();
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

        $agente = Agente::where('nrouag','=',$id)->first();

        session(['agente_id' => $agente->nrouag]);
        session(['agente_nya' => $agente->APYNOM]);
        session(['agente_dni' => $agente->DOCUME]);
        session(['agente_titulo' => $agente->TITULO]);

        return view('empleados.cargos');
    }

    public function deleteCargo($id){

        $cargo = Cargo::find($id);
        $cargo->delete();

        return redirect()->route('formacion',[session('agente_id')])->withSuccess('Datos actualizados');

    }

    public function revista($id){

        $agente = Agente::where('nrouag','=',$id)->first();
        $revista = Revista::find($agente->SITREV)->nombre;

        $areas = ['' => ''] + Reloj::orderBy('LUGAR')->pluck('LUGAR','CODIGO')->all();

        //subroga
        $sub = $this->checkSubr($agente);
        $cargo_sub = $this->cargoSubr($agente);

        $data = CargoRevista::where('empleado_id','=',$id)->first();

        $conceptos = $this->getConceptos($id);

        if($data != null ){

            return view('empleados.upd_revista',compact('agente','data','revista','sub','cargo_sub','areas','conceptos'));
        }

        return view('empleados.revista',compact('agente','revista','areas','sub','cargo_sub','conceptos'));
    }

    public function srevista(Request  $request){

        Agente::where('NROUAG','=',$request->empleado_id)->update(['posta3'=>$this->posta]);

        CargoRevista::create($request->all());

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');
    }

    public function urevista(Request  $request){

        $data = $request->all();

        $personal = CargoRevista::where('empleado_id','=',$request->empleado_id)->first();
        $personal->fill($data)->save();

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');
    }

    public function checkSubr(Agente $agente){

        if($agente->SUBRGR <> 0){
            return "SI " . "GRUPO NRO: " .$agente->GRUPO;
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

    public function imprimir($id){

        $agente = Agente::where('NROUAG','=',$id)->first();

        $salud = Salud::where('empleado_id','=',$id)->first();
        $personal = Personal::where('empleado_id','=',$id)->first();
        $familiares = Familia::where('nrouag','=',$id)->select('apynof','documf')->get();

        $revista = Revista::find($agente->SITREV)->nombre;
        $data = CargoRevista::where('empleado_id','=',$id)->first();
        //subroga
        $sub = $this->checkSubr($agente);

        //formacion
        $formacion = Cargo::where('empleado_id','=',$id)->orderBy('nivel_id','DESC')->get();
        $titulo = Titulo::where('codigo','=',$agente->TITULO)->first();


        $fecha = Carbon::now();

        $view = \View::make('empleados.print', compact('agente','fecha','salud','personal','familiares', 'revista','data','sub','formacion','titulo'))
                                                ->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view);

        return $pdf->stream('certificado'.$agente->nrouag.'.pdf');


    }

    public function getConceptos($id){

        $agente = Agente::where('nrouag','=',$id)->first();

        $conceptos= array();

        if($agente->CPT001	!= null ){
            array_push($conceptos,"BASICO");
        }
        if($agente->CPT010	!= null ){
            array_push($conceptos,'COMPENSACION JERARQUICA');
        }
        if($agente->CPT012	!= null ){
            array_push($conceptos,'ASIG.RECOMPOS.ESCAL.O.7821');
        }
        if($agente->CPT013	!= null ){
            array_push($conceptos,'PROMOCION ART.147');
        }
        if($agente->CPT020	!= null ){
            array_push($conceptos,'COMPENSACION TECNICA');
        }
        if($agente->CPT040	!= null ){
            array_push($conceptos,'BONIF.ESPECIAL (BCO+CJ)RES.763');
        }

        if($agente->CPT041	!= null ){
            array_push($conceptos,'BONIF.ESPECIAL (BASICO)RES.763');
        }
        if($agente->CPT080	!= null ){
            array_push($conceptos,'TITULO SECUNDARIO');
        }
        if($agente->CPT085	!= null ){
            array_push($conceptos,'TITULO TERCIARIO/UNIVERSITARIO');
        }
        if($agente->CPT130	!= null ){
            array_push($conceptos,'RIESGO DE CAJA');
        }
        if($agente->CPT140	!= null ){
            array_push($conceptos,'RIESGO DE SALUD');
        }
        if($agente->CPT150	!= null ){
            array_push($conceptos,'OPERADOR DE APLICACION');
        }
        if($agente->CPT151	!= null ){
            array_push($conceptos,'OPERADOR DE SISTEMAS');
        }
        if($agente->CPT152	!= null ){
            array_push($conceptos,'PROGRAMADOR');
        }
        if($agente->CPT154	!= null ){
            array_push($conceptos,'ANALISTA');
        }
        if($agente->CPT160	!= null ){
            array_push($conceptos,'INCOMPATIBILIDAD');
        }
        if($agente->CPT170	!= null ){
            array_push($conceptos,'INSALUBRIDAD');
        }
        if($agente->CPT171	!= null ){
            array_push($conceptos,'BONIF.EX COMBATIENTES O.10534');
        }
        if($agente->CPT175	!= null ){
            array_push($conceptos,'RIESGO DE VIDA');
        }
        if($agente->CPT185	!= null ){
            array_push($conceptos,'MJO.EQUIPO INFORMATICO');
        }
        if($agente->CPT186	!= null ){
            array_push($conceptos,'ADICIONAL TAREA PENOSA');
        }
        if($agente->CPT190	!= null ){
            array_push($conceptos,'TAREA NOCTURNA');
        }
        if($agente->CPT275	!= null ){
            array_push($conceptos,'MAYOR DED. 40%');
        }
        if($agente->CPT276	!= null ){
            array_push($conceptos,'DEDIC.PERMANENTE 60%');
        }


        return $conceptos;


    }

    public function checkPostas($id){

        $agente = Agente::where('NROUAG','=',$id)->first();

        if($agente->posta1 != null & $agente->posta2 != null & $agente->posta3 != null & $agente->posta4 != null){
            return $this->imprimir($id);
        }

        return redirect()->route('empleados')->withSuccess('Debe completar todas las postas para imprimir');
    }

}
