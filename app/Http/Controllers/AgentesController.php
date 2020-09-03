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

        $agentes = Agente::select('id','APYNOM','DOCUME','DENARE','FECNAC','FECING')->get();

        return DataTables::of($agentes)
            ->addColumn('action', function ($agentes) {
                return '<a href="empleados/biometrico/'.$agentes->id.'"  class="btn btn-app"><span class="badge bg-warning">Listo</span><i class="fas fa-photo-video"></i> Foto</a>
                <a href="empleados/salud/'.$agentes->id.'" class="btn btn-app"><span class="badge bg-warning">Listo</span><i class="fas fa-hospital"></i> Salud</a>
                <a class="btn btn-app"><span class="badge bg-warning">Listo</span><i class="fas fa-database"></i> Personal</a>
                <a class="btn btn-app"><span class="badge bg-warning">Listo</span><i class="fas fa-child"></i> Cargo</a>
                <a class="btn btn-app"><span class="badge bg-warning">Listo</span><i class="fas fa-graduation-cap"></i> Estudios</a>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);

    }



}

