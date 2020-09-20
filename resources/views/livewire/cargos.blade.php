<form wire:submit="addCargo" >
    <br class="card-body">
        <div class="card-header">
            <h4>DECLARADO:
                @if( $titulo == NULL)
                    {{ 'Sin titulo registrado' }}
                @else
                    {{ $titulo->Carrera }}
                @endif
            </h4>
        </div>
        </br>
        @error('newCargo') <span class="text-red">{{ $message }}</span> @enderror
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control col-sm-4" placeholder="Agregar nueva formación u oficio."  wire:model.debounce.5ms="newCargo">
            {!! Form::select('nivel_id',$niveles, null, ['class' => 'form-control col-sm-4','style'=> 'margin-left: 2em','wire:model.debounce.5ms=formacion'])!!}
            {!! Form::select('formacion_id',[''=>'','Titulo'=>'Titulo','Oficio'=>'Oficio'], null, ['class' => 'form-control col-sm-4','style'=> 'margin-left: 2em','wire:model.debounce.5ms=nivel'])!!}
            <span class="input-group-append"  style="margin-left: 2em;">
                <button type="submit" class="btn btn-info btn-flat">Agregar!</button>
            </span>
        </div>
    </div>
</form>
<!-- /.card-header -->
<div class="card-body p-0">
    <table class="table">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Formacion</th>
                <th>Nivel</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
        @foreach($cargos as $cargo)
            <tr>
                <td>{{ $cargo->nombre }}</td>
                <td>{{ $cargo->nivel_id }}</td>
                <td>{{ $cargo->formacion_id }}</td>
                <td><a href="{{ route('delete.formacion',[$cargo->id]) }}" ><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<!-- /.box-body -->
