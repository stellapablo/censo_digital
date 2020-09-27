<?php

namespace App\Http\Livewire;

use App\Agente;
use App\Cargo;
use App\Titulo;
use Livewire\Component;

class Cargos extends Component{

    public $newCargo;
    public $nivel;
    public $formacion;
    public $posta = '<i class="fas fa-check"></i>';

    public function addCargo(){

        $this->validate(['newCargo' => 'required|max:255','nivel'=>'required','formacion'=>'required']);

        $createdCargo = Cargo::create([
            'nombre' => $this->newCargo,
            'nivel_id' => $this->nivel,
            'formacion_id' => $this->formacion,
            'empleado_id' => session('agente_id'),
        ]);
        $this->newCargo = "";
        Agente::where('NROUAG','=',session('agente_id'))->update(['posta4'=>$this->posta]);


        session()->flash('message', 'Comment added successfully 😁');

    }

    public function remove($id){

        $cargo = Cargo::find($id);
        $cargo->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render(){

        $agente = Agente::where('NROUAG','=',session('agente_id'))->first();
        $cargos = Cargo::where('empleado_id','=',session('agente_id'))->orderBy('nivel_id','DESC')->get();
        $titulo = Titulo::where('codigo','=',session('agente_titulo'))->first();


        $niveles =  [''=>'','Sin formacion'=>'Sin formacion','Secundario'=>'Secundario','Terciario'=>'Terciario','Universitario'=>'Universitario'] ;

        return view('livewire.cargos',compact('cargos','titulo','niveles'));
    }

}
