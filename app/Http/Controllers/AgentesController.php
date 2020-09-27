<?php

namespace App\Http\Controllers;

use App\Agente;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AgentesController extends Controller
{
    public function index()
    {
        return view('empleados.index');
    }

    public function agentes(){

        //$agentes = Agente::select('id','APYNOM','DOCUME','DENARE','FECNAC','FECING')->get();

        $current = Carbon::now();
        $current = Carbon::createFromDate(2020, 9, 28);


        $agentes = Agente::select('id','NROUAG','APYNOM','FECING','posta1','posta2','posta3','posta4','DOCUME','posta5','turno')
                ->whereDate('turno','=',$current->format('Y-m-d'))
                ->get();

        //$agentes = DB::table('agentes')
        //            ->join('turnos', 'agentes.NROUAG', '=', 'turnos.nrouag')
        //            ->select('agentes.id','agentes.NROUAG', 'agentes.APYNOM', 'agentes.DOCUME', 'agentes.posta1', 'agentes.posta2','agentes.posta3',
        //                             'agentes.posta4','agentes.posta5','agentes.turno')
        //            ->where('agentes.turno','=',$current->format('2020-09-28'))
        //            ->get();



        return DataTables::of($agentes)
            ->addColumn('action', function ($agentes) {
                return '
                <a href="/empleados/biometrico/'.$agentes->NROUAG.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta5.'</span><i class="fas fa-photo-video"></i> Foto</a>
                <a href="/empleados/salud/'.$agentes->NROUAG.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta1.'</span><i class="fas fa-hospital"></i> Salud</a>
                <a href="/empleados/personal/'.$agentes->NROUAG.'"  class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta2.'</span><i class="fas fa-database"></i> Personal</a>
                <a href="/empleados/revista/'.$agentes->NROUAG.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta3.'</span><i class="fas fa-child"></i> Cargo</a>
                <a href="/empleados/formacion/'.$agentes->NROUAG.'"class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta4.'</span><span class="badge bg-warning"></span><i class="fas fa-graduation-cap"></i> Formacion</a>
                <a href="/empleados/imprimir/'.$agentes->NROUAG.'"class="btn btn-app"><i class="fas fa-print"></i> Imprimir</a>
                ';
            })
            ->editColumn('agente.id', '{{$id}}')
            ->make(true)
            ;

    }

    public function listado(){

        $agentes = DB::table('agentes')->select('id','NROUAG', 'APYNOM', 'DOCUME', 'posta1', 'posta2','posta3','posta4','posta5')->get();

        return DataTables::of($agentes)
            ->addColumn('action', function ($agentes) {
                return '
                <a href="/empleados/biometrico/'.$agentes->NROUAG.'" class="btn btn-app"><i class="fas fa-photo-video"></i> Foto</a>
                <a href="/empleados/salud/'.$agentes->NROUAG.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta1.'</span><i class="fas fa-hospital"></i> Salud</a>
                <a href="/empleados/personal/'.$agentes->NROUAG.'"  class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta2.'</span><i class="fas fa-database"></i> Personal</a>
                <a href="/empleados/revista/'.$agentes->NROUAG.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta3.'</span><i class="fas fa-child"></i> Cargo</a>
                <a href="/empleados/formacion/'.$agentes->NROUAG.'"class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta4.'</span><span class="badge bg-warning"></span><i class="fas fa-graduation-cap"></i> Formacion</a>
                <a href="/empleados/imprimir/'.$agentes->NROUAG.'"class="btn btn-app"><i class="fas fa-print"></i> Imprimir</a>
                ';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true)
            ;

    }

    public function nomina()
    {
        return view('empleados.nomina');
    }



}

