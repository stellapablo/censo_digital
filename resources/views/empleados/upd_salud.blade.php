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
            <div class="col-md-7">
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
                            <input type="hidden" name="empleado_id" value="{{$agente->nrouag}}"  class="form-control" placeholder="Enter ...">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Frecuencia Cardiaca</label>
                                        <input type="text" value="{{ $data->frecuencia_cardiaca }}"  data-mask="00.00"  name="frecuencia_cardiaca" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Frecuencia Respiratoria</label>
                                        <input type="text" value="{{ $data->frecuencia_respiratoria }}"  data-mask="00.00"  name="frecuencia_respiratoria" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Temperatura</label>
                                        <input type="text" value="{{ $data->temperatura }}"  data-mask="00.0"  class="form-control" name="temperatura" placeholder="Enter ...">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Altura</label>
                                        <input type="text" value="{{ $data->altura }}"  data-mask="0.00"   class="form-control" name="altura" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Peso</label>
                                        <input type="text" value="{{ $data->peso }}"  data-mask="00.00"  class="form-control" name="peso" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Presión Diastole</label>
                                        <input type="text" class="form-control" data-mask="0000" value="{{ $data->diastole }}" name="diastole" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Presión Sistole</label>
                                        <input type="text" class="form-control" data-mask="0000" value="{{ $data->sistole }}" name="sistole" placeholder="Enter ...">
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
                                            <h4>Sin vacunas registradas</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">OBSERVACIONES GENERALES</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-5">
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
                                        <div class="col-sm-5">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->def_auditivas)
                                                        <input class="custom-control-input" name="def_auditivas" type="checkbox" id="customCheckbox4" checked>
                                                    @else
                                                        <input class="custom-control-input" name="def_auditivas" type="checkbox" id="customCheckbox4" >
                                                    @endif
                                                    <label for="customCheckbox4" class="custom-control-label">Def. Auditivas</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->def_visual)
                                                        <input class="custom-control-input" name="def_visual" type="checkbox" id="customCheckbox5" checked>
                                                    @else
                                                        <input class="custom-control-input" name="def_visual" type="checkbox" id="customCheckbox5" >
                                                    @endif
                                                    <label for="customCheckbox5" class="custom-control-label">Def. Visual</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->discapacidad)
                                                        <input class="custom-control-input" name="discapacidad" type="checkbox" id="customCheckbox6" checked>
                                                    @else
                                                        <input class="custom-control-input" name="discapacidad" type="checkbox" id="customCheckbox6" >
                                                    @endif
                                                    <label for="customCheckbox6" class="custom-control-label">Posee alguna discapacidad</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Nombre..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Observaciones</label>
                                                <textarea class="form-control"  rows="5" name="observaciones">{{ $data->observaciones }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->consulta)
                                                        <input class="custom-control-input" name="consulta" type="checkbox" id="customCheckbox7" checked>
                                                    @else
                                                        <input class="custom-control-input" name="consulta" type="checkbox" id="customCheckbox7" >
                                                    @endif
                                                        <label for="customCheckbox7" class="custom-control-label">Es necesario realizar una CONSULTA posterior al censo con éste agente. </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    @if($data->preocupacional)
                                                        <input class="custom-control-input" name="preocupacional" type="checkbox" id="customCheckbox8" checked>
                                                    @else
                                                        <input class="custom-control-input" name="preocupacional" type="checkbox" id="customCheckbox8" >
                                                    @endif
                                                        <label for="customCheckbox8" class="custom-control-label">Tiene completo su pre-ocupacional</label>
                                                </div>
                                            </div>
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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ultimas licencias Medicas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Diagnóstico</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>CODLRM</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($licencias as $row)
                                <tr>
                                    <td>{{ $row->DIAGNO }}</td>
                                    <td>{{ $row->FDESDE }}</td>
                                    <td>{{ $row->FDESDE }}</td>
                                    <td>{{ $row->CODLRM }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@stop

