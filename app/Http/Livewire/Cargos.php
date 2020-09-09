<?php

namespace App\Http\Livewire;

use App\Agente;
use App\Cargo;
use App\Titulo;
use Livewire\Component;

class Cargos extends Component{

    public $newCargo;
    public $nivel_id;

    public function addCargo(){

        $this->validate(['newCargo' => 'required|max:255','nivel_id'=>'required']);


        $createdCargo = Cargo::create([
            'nombre' => $this->newCargo,
            'nivel_id' => $this->nivel_id,
            'empleado_id' => session('agente_id'),
        ]);
        $this->newCargo = "";
        $this->nivel_id = "";

        session()->flash('message', 'Comment added successfully 😁');

    }

    public function remove($id){

        $cargo = Cargo::find($id);
        $cargo->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render(){

        $agente = Agente::find(session('agente_id'))->first();
        $cargos = Cargo::where('empleado_id','=',session('agente_id'))->get();
        $titulo = Titulo::where('codigo','=',$agente->TITULO)->first();

        return view('livewire.cargos',compact('cargos','titulo'));
    }

}
