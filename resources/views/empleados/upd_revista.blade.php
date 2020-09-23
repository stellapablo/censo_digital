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
                        <li class="breadcrumb-item">Agentes</li>
                        <li class="breadcrumb-item active">Datos del Cargo</li>
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
                        <form action="{{ route('empleados.urevista') }}" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Situacion de revista</label>
                                        <input type="hidden" name="empleado_id" value="{{$agente->nrouag}}"  class="form-control">
                                        <p>{{ $revista }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Percepción de haberes</label>
                                        {!! Form::select('haberes', ['Si'=>'Si','No'=>'No'] ,  null, ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="text" name="motivo" value="{{ $data->motivo }}" class="form-control" placeholder="Si no percibe, indique la razón">
                                    </div>
                                </div>
                            </div>

                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Situación actual</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="callout callout-info">
                                                <h5>Subrogancia</h5>
                                                <p>Subroga: <strong>{{ $sub }}</strong></p>
                                                @if($agente->CPTO20)
                                                    <p>TIENE COMPENSACIÓN TÉCNICA: GRUPO {{ $agente->GRUPO }}</p>
                                                @endif
                                                <h5>Cargo de base</h5>
                                                <p>Lugar de trabajo: {{ $agente->DENARE }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="callout callout-info">
                                                <h5>OTROS CONCEPTOS</h5>
                                                <ul>
                                                    @foreach($conceptos as $row)
                                                        <li>{{ $row }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Subroga por:</label>
                                                    <input type="text" class="form-control" value="{{ $data->subroga_en }}" name="subroga_en" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Lugar fisico de trabajo</label>
                                                    {!! Form::select('trabaja_en', $areas ,  $data->trabaja_en , ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5>Horario de trabajo</h5>
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <!-- <h5 class="mt-4 mb-2">Enfermedades</h5> -->
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->mañana)
                                                        <input class="custom-control-input" name="mañana" type="checkbox" id="customCheckbox1" checked>
                                                    @else
                                                        <input class="custom-control-input" name="mañana" type="checkbox" id="customCheckbox1" >
                                                    @endif
                                                    <label for="customCheckbox1" class="custom-control-label">Mañana</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->tarde)
                                                        <input class="custom-control-input" name="tarde" type="checkbox" id="customCheckbox2" checked>
                                                    @else
                                                        <input class="custom-control-input" name="tarde" type="checkbox" id="customCheckbox2" >
                                                    @endif
                                                    <label for="customCheckbox2" class="custom-control-label">Tarde</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->noche)
                                                        <input class="custom-control-input" name="noche" type="checkbox" id="customCheckbox3" checked>
                                                    @else
                                                        <input class="custom-control-input" name="noche" type="checkbox" id="customCheckbox3" >
                                                    @endif
                                                    <label for="customCheckbox3" class="custom-control-label">Noche</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-default" >Cancelar</button>
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

