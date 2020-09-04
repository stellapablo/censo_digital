<?php

namespace App\Http\Livewire;

use App\Cargo;
use Livewire\Component;

class Cargos extends Component{

    public $newCargo;


    public function addCargo(){

        $this->validate(['newCargo' => 'required|max:255']);

        $createdCargo = Cargo::create([
            'nombre' => $this->newCargo,
            'empleado_id' => 1,
        ]);
        $this->newCargo = "";
        session()->flash('message', 'Comment added successfully 😁');

    }

    public function remove($id){

        $cargo = Cargo::find($id);
        $cargo->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render(){

        return view('livewire.cargos',
            ['cargos' => Cargo::latest()->get()]);
    }

}
