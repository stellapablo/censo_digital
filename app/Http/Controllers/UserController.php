<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;



class UserController extends Controller
{
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
        //$users = User::all();
        return view('auth.index');
    }

    public function anyUsers(){

        $users = User::select('id','name','email','creado_el','updated_at')->get();

        return DataTables::of($users)
            ->addColumn('action', function ($users) {
                return '<a href="productos/'.$users->id.'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                        <a onclick="return confirm(\'Está seguro que desea eliminar un usuario?\')" href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</a>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);

    }



}
