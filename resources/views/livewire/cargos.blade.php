<form wire:submit="addCargo" >
    <div class="card-body">
        <h5>Agregar Formación</h5>

        @error('newCargo') <span class="text-red">{{ $message }}</span> @enderror
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control col-sm-4" placeholder="Ingrese el cargo."  wire:model.debounce.0ms="newCargo">

            <input type="text" style="margin-left: 2em;" class="form-control  col-sm-4" placeholder="Ingrese el nivel."  wire:model.debounce.0ms="newCargo">

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
                <th style="width: 10px">#</th>
                <th>Titulo</th>
                <th>Creado</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
        @foreach($cargos as $cargo)
            <tr>
                <td>{{ $cargo->id }}</td>
                <td>{{ $cargo->nombre }}</td>
                <td>{{ $cargo->created_at }}</td>
                <td><a href="{{ route('delete.formacion',[$cargo->id]) }}" ><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->

    <!-- /.box-body -->
