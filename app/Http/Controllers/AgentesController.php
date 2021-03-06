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
        $current = Carbon::createFromDate(2020, 9, 25);


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

        $agentes = Agente::select('id','NROUAG','APYNOM','DOCUME','turno')->get();


        return DataTables::of($agentes)
            ->addColumn('action', function ($agentes) {
                return '
                <a onclick="return confirm(\'Está seguro que desea agregar al turno actual?\')" href="/empleados/agregar/'.$agentes->NROUAG.'" class="btn btn-xs btn-success"><i class="fas fa-file-archive"></i>  Agregar al turno</a>
                <a onclick="return confirm(\'Está seguro que desea quitar del turno actual?\')" href="/empleados/quitar/'.$agentes->NROUAG.'" class="btn btn-xs btn-danger"><i class="fas fa-file-archive"></i>  Quitar del turno</a>

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

