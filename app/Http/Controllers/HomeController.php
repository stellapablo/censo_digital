<?php

namespace App\Http\Controllers;

use App\Salud;
use App\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('empleados.index');
    }


    public function dashboard(){

        $current = Carbon::now();

        $turno_actual = Turno::where('fecha','=',$current->format('Y-m-d'))->count();

        $censados_total = Salud::all()->count();

        $censado_fecha = Salud::whereDate('created_at','=',$current->format('Y-m-d'))->count();

        $total = round(($censados_total * 100) / 5383,0);

        return view('empleados.dashboard',compact('current','censados_total','censado_fecha','turno_actual','total'));
    }

}
