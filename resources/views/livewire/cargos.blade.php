<form wire:submit="addCargo" >
    <div class="card-body">
        <p>Agregar Cargos</p>

        @error('newCargo') <span class="text-red">{{ $message }}</span> @enderror
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="Ingrese el cargo." wire:model.debounce.500ms="newCargo">
            <span class="input-group-append">
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
        </tr>
        </thead>
        <tbody>
        @foreach($cargos as $cargo)
            <tr>
                <td>{{ $cargo->id }}</td>
                <td>{{ $cargo->nombre }}</td>
                <td>{{ $cargo->created_at }}</td>
                <td><button wire:click="remove(158)">Eliminar</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->

    <!-- /.box-body -->
