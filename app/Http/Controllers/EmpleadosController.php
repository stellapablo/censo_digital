<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function salud()
    {
        //$users = User::all();
        return view('empleados.salud');
    }

    public function ssalud(Request $request){
        dd($request->all());
    }

    public function personal()
    {
        //$users = User::all();
        return view('empleados.personales');
    }

    public function spersonal(Request $request){
        dd($request->all());
    }
}
