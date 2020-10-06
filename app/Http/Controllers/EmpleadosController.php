<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Area;
use App\Biometria;
use App\Cargo;
use App\CargoRevista;
use App\Familia;
use App\Http\Requests\CreateSaludFormRequest;
use App\Http\Requests\RevistaFormRequest;
use App\Invoice;
use App\InvoiceDetail;
use App\Licencia;
use App\Personal;
use App\Reloj;
use App\Revista;
use App\Salud;
use App\Titulo;
use App\Turno;
use App\User;
use App\Vacuna;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        //dd($vacunas);

        if($data != null ){

            return view('empleados.upd_salud',compact('agente','data','licencias'));
        }

        return view('empleados.salud',compact('agente','licencias'));
    }

    public function ssalud(CreateSaludFormRequest $request){

        Agente::where('NROUAG','=',$request->empleado_id)->update(['posta1'=>$this->posta]);

        $salud = Salud::create($request->all());

        Salud::where('id','=',$salud->id)->update(['user_id'=> auth()->user()->id]);


        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');
    }


    public function usalud(CreateSaludFormRequest $request){

        $check = $this->checkSalud($request);

        $salud = Salud::where('empleado_id', '=', $request->empleado_id)->update([
            'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
            'frecuencia_respiratoria' => $request->frecuencia_respiratoria,
            'temperatura' => $request->temperatura,
            'altura' => $request->altura,
            'peso' => $request->peso,
            'hipertension' => $check[0],
            'diabetes' => $check[1],
            'agudas' => $check[2],
            'def_auditivas' => $check[3],
            'def_visual' => $check[4],
            'discapacidad' => $check[5],
            'preocupacional' => $check[6],
            'consulta' => $check[7],
            'sistole' => $request->sistole,
            'diastole' => $request->diastole,
            'observaciones' => $request->observaciones,
            'user_id' => auth()->user()->id
        ]);


        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');

    }

    public function checkSalud(Request  $request){

        if (!isset($request->hipertension)) {
            $check[0] = null;
        } else {
            $check[0] = 'on';
        }
        if (!isset($request->diabetes)) {
            $check[1] = null;
        } else {
            $check[1] = 'on';
        }
        if (!isset($request->agudas)) {
            $check[2] = null;
        } else {
            $check[2] = 'on';
        }
        if (!isset($request->def_auditivas)) {
            $check[3] = null;
        } else {
            $check[3] = 'on';
        }
        if (!isset($request->def_visual)) {
            $check[4] = null;
        } else {
            $check[4] = 'on';
        }
        if (!isset($request->discapacidad)) {
            $check[5] = null;
        } else {
            $check[5] = 'on';
        }
        if (!isset($request->preocupacional)) {
            $check[6] = null;
        } else {
            $check[6] = 'on';
        }
        if (!isset($request->consulta)) {
            $check[7] = null;
        } else {
            $check[7] = 'on';
        }

        return $check;
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

        $personal = Personal::create($request->all());

        Personal::where('id','=',$personal->id)->update(['user_id'=> auth()->user()->id]);

        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');

    }

    //update datos personales
    public function upersonal(Request $request){

        $check = $this->checkPersonal($request);

        $personal = Personal::where('empleado_id','=',$request->empleado_id)
                    ->update(['fecha_nac'=> $request->fecha_nac,
                            'estado_civil'=> $request->estado_civil,
                            'permiso'=> $request->permiso,
                            'sexo'=> $request->sexo,
                            'calle'=> $request->calle,
                            'altura'=> $request->altura,
                            'manzana'=> $request->manzana,
                            'parcela'=> $request->parcela,
                            'piso'=> $request->piso,
                            'dpto'=> $request->dpto,
                            'barrio'=> $request->barrio,
                            'localidad'=> $request->localidad,
                            'celular'=> $request->celular,
                            'tel_fijo'=> $request->tel_fijo,
                            'email'=> $request->email,
                            'tel_emergencia'=> $request->tel_emergencia,
                            'pareja'=> $request->pareja,
                            'hijos'=> $request->hijos,
                            'menores'=> $request->menores,
                            'mayores'=> $request->mayores,
                            'fliares_cargo'=> $check[0],
                            'poliza'=> $check[1],
                            'obra_social'=> $check[2],
                            'residencia'=> $check[3],
                            'user_id' => auth()->user()->id

                    ]);


        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');

    }

    public function checkPersonal(Request  $request){

        if (!isset($request->fliares_cargo)) {
            $check[0] = null;
        } else {
            $check[0] = 'on';
        }
        if (!isset($request->poliza)) {
            $check[1] = null;
        } else {
            $check[1] = 'on';
        }
        if (!isset($request->obra_social)) {
            $check[2] = null;
        } else {
            $check[2] = 'on';
        }
        if (!isset($request->residencia)) {
            $check[3] = null;
        } else {
            $check[3] = 'on';
        }

        return $check;
    }


    public function biometrico($id){

        $agente = Agente::where('nrouag','=',$id)->first();
        $images = Biometria::where('empleado_id','=',$id)->get();

        return view('empleados.biometrico',compact('agente','images'));

    }

    public function sbiometrico(Request $request, $id){

        $image = $request->file('file');
        $avatarName = 'dni_' . $id .'_'.uniqid();
        $image->move(public_path('images'),$avatarName);

        $imageUpload = new Biometria();
        $imageUpload->empleado_id = $id;
        $imageUpload->imagen = $avatarName;
        $imageUpload->save();

        Agente::where('NROUAG','=',$id)->update(['posta5'=>$this->posta]);

        return response()->json(['success'=>$avatarName]);
    }

    public function sbiometricoFirma(Request $request, $id){

        $image = $request->file('file');
        $avatarName = 'firma_' . $id .'_'.uniqid();
        $image->move(public_path('images'),$avatarName);

        $imageUpload = new Biometria();
        $imageUpload->empleado_id = $id;
        $imageUpload->imagen = $avatarName;
        $imageUpload->save();


        return response()->json(['success'=>$avatarName]);
    }


    public function sbiometricoFacial(Request $request, $id){

        $image = $request->file('file');
        $avatarName = 'foto_' . $id .'_'.uniqid();
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


        $reloj = ['' => ''] + Reloj::orderBy('LUGAR')->pluck('LUGAR','CODIGO')->all();

        $subroga = $agente->SUBRGR;

        //subroga
        $sub = $this->checkSubr($agente);
        $cargo_sub = $this->cargoSubr($agente);

        $data = CargoRevista::where('empleado_id','=',$id)->first();

        $conceptos = $this->getConceptos($id);

        $area = Area::where('are_nro','=',$agente->AREA)->first();

        if($area == null){
            $area = Area::where('are_nro','=','99999999')->first();
        }

        if($data != null ){

            $area = Area::where('are_nro','=',$data->area_id)->first();

            return view('empleados.upd_revista',compact('agente','data','revista','sub','cargo_sub','area','conceptos','reloj','subroga'));
        }

        return view('empleados.revista',compact('agente','revista','sub','cargo_sub','area','conceptos','reloj','subroga'));
    }

    public function srevista(RevistaFormRequest  $request){

        Agente::where('NROUAG','=',$request->empleado_id)->update(['posta3'=>$this->posta]);

        $cargo = CargoRevista::create($request->all());
        CargoRevista::where('id','=',$cargo->id)->update(['user_id'=> auth()->user()->id]);


        return redirect()->route('empleados')->withSuccess('Datos Actualizados correctamente');
    }

    public function urevista(RevistaFormRequest  $request){

        $data = $request->all();

        $personal = CargoRevista::where('empleado_id','=',$request->empleado_id)->first();
        $personal->user_id = auth()->user()->id;
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

        $area = Area::where('are_nro','=',$data->area_id)->first();

        $reloj = Reloj::where('CODIGO','=',$data->reloj_id)->first();




        //subroga
        $sub = $this->checkSubr($agente);

        //formacion
        $formacion = Cargo::where('empleado_id','=',$id)->orderBy('nivel_id','DESC')->get();
        $titulo = Titulo::where('codigo','=',$agente->TITULO)->first();


        $fecha = Carbon::now();

        Agente::where('NROUAG','=',$id)->update(['print'=> $fecha->format('Y-m-d H:i:s')]);

        $view = \View::make('empleados.print', compact('reloj','area','agente','fecha','salud','personal','familiares', 'revista','data','sub','formacion','titulo'))->render();
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

        //GRANT ALL ON censo_v13.* TO 'censo'@'localhost' IDENTIFIED BY 'swaping_00' WITH GRANT OPTION;

    }

    public function checkPostas($id){

        $agente = Agente::where('NROUAG','=',$id)->first();

        if($agente->posta1 != null & $agente->posta2 != null & $agente->posta3 != null & $agente->posta4 != null){
            return $this->imprimir($id);
        }

        return redirect()->route('empleados')->withSuccess('Debe completar todas las postas para imprimir');
    }

    public function setTurnos2(){

        //$turnos = Turno::all()->take(50);

        //$current = Carbon::now();

        //foreach ($turnos as $turno) {

        //    $turno->fecha = $current->format('Y-m-d');
        //    $turno->save();
        //}


        $users = User::all();

        foreach ($users as $user) {

            if($user->id != 1){
                $user->password = Hash::make($user->id);
                $user->save();
            }
        }

        //$fecha =  Carbon::createFromFormat('Y-m-d H');

    }

    // $areas = ['' => ''] + Area::orderBy('nombre')->pluck('nombre','are_nro')->all();

    public function getAreas(Request $request){

        $search = $request->search;


        if($search == ''){
            $areas = Area::orderby('nombre','asc')->select('are_nro','nombre')->limit(5)->get();
        }else{
            $areas = Area::orderby('nombre','asc')->select('are_nro','nombre')->where('nombre', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();

        foreach($areas as $row){
            $response[] = array("value"=>$row->are_nro,"label"=>$row->nombre);
        }

        return response()->json($response);
    }

    public function setTurnos(){

        $current = Carbon::now();

        $agentes = DB::table('agentes')
                    ->join('turnos', 'agentes.NROUAG', '=', 'turnos.nrouag')
                    ->select('agentes.id','agentes.NROUAG', 'agentes.APYNOM', 'agentes.DOCUME', 'agentes.posta1', 'agentes.posta2','agentes.posta3',
                                     'agentes.posta4','agentes.posta5','turnos.fecha','turnos.hora')
                    ->where('turnos.fecha','=','2020-09-29')
                    ->get();


        $current = Carbon::createFromDate(2020, 9, 29);

        foreach ($agentes as $item) {

            $row = Agente::find($item->id);
            $row->turno = $current->format('Y-m-d');
            $row->save();
        }
    }

    public function addTurno($id){

        $current = Carbon::now();

        $agente = Agente::where('NROUAG','=',$id)->first();
        $agente->turno = $current->format('Y-m-d');
        $agente->save();

        return redirect()->route('empleados')->withSuccess('Agente actualizado al turno');
    }

    public function deleteTurno($id){

        $agente = Agente::where('NROUAG','=',$id)->first();
        $agente->turno = null;
        $agente->save();

        return redirect()->route('empleados')->withSuccess('Agente eliminado del turno');
    }

}


