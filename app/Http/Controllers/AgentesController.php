<?php

namespace App\Http\Controllers;

use App\Agente;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AgentesController extends Controller
{
    public function index()
    {
        //$users = User::all();
        return view('empleados.index');
    }

    public function agentes(){

        //$agentes = Agente::select('id','APYNOM','DOCUME','DENARE','FECNAC','FECING')->get();

        $agentes = cache()->remember('agentes',now()->addMicroseconds(60),function (){
            return Agente::select('id','APYNOM','DOCUME','FECING','posta1','posta2','posta3','posta4','posta5')->take(400)->get();
        });


        return DataTables::of($agentes)
            ->addColumn('action', function ($agentes) {
                return '
                <a href="/empleados/biometrico/'.$agentes->id.'" class="btn btn-app"><i class="fas fa-photo-video"></i> Foto</a>
                <a href="/empleados/salud/'.$agentes->id.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta1.'</span><i class="fas fa-hospital"></i> Salud</a>
                <a href="/empleados/personal/'.$agentes->id.'"  class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta2.'</span><i class="fas fa-database"></i> Personal</a>
                <a href="/empleados/revista/'.$agentes->id.'" class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta3.'</span><i class="fas fa-child"></i> Cargo</a>
                <a href="/empleados/formacion/'.$agentes->id.'"class="btn btn-app"><span class="badge bg-warning">'.$agentes->posta4.'</span><span class="badge bg-warning"></span><i class="fas fa-graduation-cap"></i> Formacion</a>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);

    }



}

