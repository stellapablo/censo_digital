@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Agentes</a></li>
                        <li class="breadcrumb-item active">Datos Personales</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">{{ $agente->APYNOM }}  - ({{ $agente->CUILAG }}) </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif

                        <form action="{{ route('empleados.upersonal') }}" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="hidden" name="empleado_id" value="{{$agente->nrouag}}"  class="form-control">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="text" value="{{$data->fecha_nac}}" name="fecha_nac" data-mask="0000-00-00" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        {!! Form::select('estado_civil', [''=>'','1'=>'Soltero/a','2'=>'Casado/a','3'=>'Concubino/a'] ,  $data->estado_civil, ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Permiso para conducir</label>
                                        {!! Form::select('permiso', [''=>'','1'=>'Si','2'=>'No'] ,  $data->permiso, ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        {!! Form::select('sexo', [''=>'','M'=>'Masculino','F'=>'Femenino'] ,  $data->sexo, ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                    </div>
                                </div>
                            </div>
                            <!-- general form elements disabled -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Domicilio: {{ $agente->DOMICI }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <!-- <h5 class="mt-4 mb-2">Enfermedades</h5> -->
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->residencia)
                                                        <input class="custom-control-input" name="residencia" type="checkbox" id="customCheckbox1" checked>
                                                    @else
                                                        <input class="custom-control-input" name="residencia" type="checkbox" id="customCheckbox1" >
                                                    @endif
                                                    <label for="customCheckbox1" class="custom-control-label">La RESIDENCIA ACTUAL es la misma que en el DNI</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Calle</label>
                                                <input type="text" value="{{$data->calle}}" name="calle" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Altura</label>
                                                <input type="text" value="{{$data->altura}}" name="altura" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Manzana</label>
                                                <input type="text" value="{{$data->manzana}}" name="manzana" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Parcela</label>
                                                <input type="text" value="{{$data->parcela}}" name="parcela" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Piso</label>
                                                <input type="text" value="{{$data->piso}} "name="piso" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departamento</label>
                                                <input type="text" value="{{$data->dpto}}" name="dpto" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barrio</label>
                                                <input type="text" value="{{$data->barrio}}" name="barrio" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Localidad</label>
                                                <input type="text" value="{{$data->localidad}}" name="localidad" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Contacto</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" value="{{$data->celular}}" name="celular" data-mask="0000-000000" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tel. Fijo</label>
                                                <input type="text" value="{{$data->tel_fijo}}" data-mask="0000-000000" name="tel_fijo" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" value="{{$data->email}}" name="email" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tel. Emergencia</label>
                                                <input type="text" value="{{$data->tel_emergencia}}" name="tel_emergencia" data-mask="0000-000000"  class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Datos Familiares</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Vive en pareja?</label>
                                                {!! Form::select('pareja', ['Si'=>'Si','No'=>'No'] ,  $data->pareja, ['class' => 'form-control'])!!}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Cuántos hijos viven en su domicilio?</label>
                                                <input type="text" value="{{$data->hijos}}" name="hijos" data-mask="00" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hijos menores de 15 años?</label>
                                                <input type="text" value="{{$data->menores}}" name="menores" data-mask="00" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hijos mayores de 18?</label>
                                                <input type="text" value="{{$data->mayores}}" name="mayores" data-mask="00" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Familiares a cargo</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Apellido y Nombre</th>
                                                            <th>Fecha Nacimiento</th>
                                                            <th>DNI</th>
                                                        </tr>
                                                        </thead>
                                                        @foreach($familiares as $row)
                                                            <tr>
                                                                <td>{{ $row->apynof }}</td>
                                                                <td>{{ $row->fecnaf }}</td>
                                                                <td>{{ $row->documf }}</td>
                                                            </tr>
                                                        @endforeach
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Seguro de vida</h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">

                                            @if($data->poliza)
                                                <input class="custom-control-input" name="poliza" type="checkbox" id="customCheckbox1" checked>
                                            @else
                                                <input class="custom-control-input" name="poliza" type="checkbox" id="customCheckbox2" >
                                            @endif
                                            <label for="customCheckbox2" class="custom-control-label">SEGURO: Declaro que necesito ser citado para modificar los datos de la o las personas aseguradas en mi póliza.</label>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Obra Social</h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            @if($data->obra_social)
                                                <input class="custom-control-input" name="obra_social" type="checkbox" id="customCheckbox4" checked>
                                            @else
                                                <input class="custom-control-input" name="obra_social" type="checkbox" id="customCheckbox4" >
                                            @endif
                                            <label for="customCheckbox4" class="custom-control-label">OBRA SOCIAL: Declaro que necesito ser citado para modificar los datos de las personas que están a cargo en mi obra social.  </label>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Personas a Cargo</h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            @if($data->fliares_cargo)
                                                <input class="custom-control-input" name="fliares_cargo" type="checkbox" id="customCheckbox3" checked>
                                            @else
                                                <input class="custom-control-input" name="fliares_cargo" type="checkbox" id="customCheckbox3" >
                                            @endif
                                            <label for="customCheckbox3" class="custom-control-label">Declaro que necesito ser citado para modificar los datos de quienes tengo a cargo para el cobro de salario familiar.  </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
@stop

