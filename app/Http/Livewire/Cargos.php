<?php

namespace App\Http\Livewire;

use App\Cargo;
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

        return view('livewire.cargos',
            ['cargos' => Cargo::where('empleado_id','=',session('agente_id'))->get(),]);
    }

}
