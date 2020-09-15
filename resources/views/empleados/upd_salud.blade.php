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
                        <li class="breadcrumb-item active">Salud</li>
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
                        <form action="{{ route('empleados.usalud') }}" method="POST" >
                            {{ csrf_field() }}
                            <input type="hidden" name="empleado_id" value="{{$agente->id}}"  class="form-control" placeholder="Enter ...">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Frecuencia Cardiaca</label>
                                        <input type="text" value="{{ $data->frecuencia_cardiaca }}" name="frecuencia_cardiaca" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Frecuencia Respiratoria</label>
                                        <input type="text" value="{{ $data->frecuencia_respiratoria }}" name="frecuencia_respiratoria" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Temperatura</label>
                                        <input type="text" value="{{ $data->temperatura }}" class="form-control" name="temperatura" placeholder="Enter ...">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Altura</label>
                                        <input type="text" value="{{ $data->altura }}" class="form-control" name="altura" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Peso</label>
                                        <input type="text" value="{{ $data->peso }}" class="form-control" name="peso" placeholder="Enter ...">
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-4 mb-2">IMC/m2 = 34.69</h5>

                            <!-- general form elements disabled -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">VACUNACIÓN</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <!-- <h5 class="mt-4 mb-2">Enfermedades</h5> -->
                                                 <div class="custom-control custom-checkbox">
                                                    @if($data->hipertension)
                                                        <input class="custom-control-input" name="hipertension" type="checkbox" id="customCheckbox1" checked>
                                                    @else
                                                        <input class="custom-control-input" name="hipertension" type="checkbox" id="customCheckbox1" >
                                                    @endif
                                                    <label for="customCheckbox1" class="custom-control-label">Hipertension</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->diabetes)
                                                        <input class="custom-control-input" name="diabetes" type="checkbox" id="customCheckbox2" checked>
                                                    @else
                                                        <input class="custom-control-input" name="diabetes" type="checkbox" id="customCheckbox2" >
                                                    @endif
                                                    <label for="customCheckbox2" class="custom-control-label">Diabetes</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->agudas)
                                                        <input class="custom-control-input" name="agudas" type="checkbox" id="customCheckbox3" checked>
                                                    @else
                                                        <input class="custom-control-input" name="agudas" type="checkbox" id="customCheckbox3" >
                                                    @endif
                                                    <label for="customCheckbox3" class="custom-control-label">Antecedente enfermedades agudas</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->antitetanica)
                                                        <input class="custom-control-input" name="antitetanica" type="checkbox" id="customCheckbox15" checked>
                                                    @else
                                                        <input class="custom-control-input" name="antitetanica" type="checkbox" id="customCheckbox15" >
                                                    @endif
                                                    <label for="customCheckbox15" class="custom-control-label">Anti-tetanica</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->hepa)
                                                        <input class="custom-control-input" name="hepa" type="checkbox" id="customCheckbox4" checked>
                                                    @else
                                                        <input class="custom-control-input" name="hepa" type="checkbox" id="customCheckbox4" >
                                                    @endif
                                                    <label for="customCheckbox4" class="custom-control-label">Hep. A</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->hepb)
                                                        <input class="custom-control-input" name="hepb" type="checkbox" id="customCheckbox5" checked>
                                                    @else
                                                        <input class="custom-control-input" name="hepb" type="checkbox" id="customCheckbox5" >
                                                    @endif
                                                    <label for="customCheckbox5"  class="custom-control-label">Hep. B</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->hepb)
                                                        <input class="custom-control-input" name="doble" type="checkbox" id="customCheckbox6" checked>
                                                    @else
                                                        <input class="custom-control-input" name="doble" type="checkbox" id="customCheckbox6" >
                                                    @endif
                                                    <label for="customCheckbox6" class="custom-control-label">Doble gripal</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">

                                                    @if($data->antigripal)
                                                        <input class="custom-control-input" name="antigripal" type="checkbox" id="customCheckbox7" checked>
                                                    @else
                                                        <input class="custom-control-input" name="antigripal" type="checkbox" id="customCheckbox7" >
                                                    @endif
                                                    <label for="customCheckbox7" class="custom-control-label">Antigripal</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->def_auditivas)
                                                        <input class="custom-control-input" name="def_auditivas" type="checkbox" id="customCheckbox8" checked>
                                                    @else
                                                        <input class="custom-control-input" name="def_auditivas" type="checkbox" id="customCheckbox8" >
                                                    @endif
                                                    <label for="customCheckbox8" class="custom-control-label">Def. Auditivas</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">

                                                    @if($data->def_visual)
                                                        <input class="custom-control-input" name="def_visual" type="checkbox" id="customCheckbox9" checked>
                                                    @else
                                                        <input class="custom-control-input" name="def_visual" type="checkbox" id="customCheckbox9" >
                                                    @endif
                                                    <label for="customCheckbox9"  class="custom-control-label">Def. Visual</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">

                                                    @if($data->discapacidad)
                                                        <input class="custom-control-input" name="discapacidad" type="checkbox" id="customCheckbox10" checked>
                                                    @else
                                                        <input class="custom-control-input" name="discapacidad" type="checkbox" id="customCheckbox10" >
                                                    @endif
                                                    <label for="customCheckbox10"  class="custom-control-label">Posee alguna discapacidad</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Nombre..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">

                                                    @if($data->preocupacional)
                                                        <input class="custom-control-input" name="preocupacional" type="checkbox" id="customCheckbox11" checked>
                                                    @else
                                                        <input class="custom-control-input" name="preocupacional" type="checkbox" id="customCheckbox11" >
                                                    @endif
                                                    <label for="customCheckbox11" class="custom-control-label">Tiene completo su pre-ocupacional</label>
                                                </div>
                                            </div>
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Observaciones</label>
                                                <textarea class="form-control" rows="5" name="observaciones" placeholder="Enter ...">{{ $data->observaciones }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">

                                                    @if($data->consulta)
                                                        <input class="custom-control-input" name="consulta" type="checkbox" id="customCheckbox12" checked>
                                                    @else
                                                        <input class="custom-control-input" name="consulta" type="checkbox" id="customCheckbox12" >
                                                    @endif
                                                    <label for="customCheckbox12" class="custom-control-label">Es necesario realizar una CONSULTA posterior al censo con éste agente. </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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

