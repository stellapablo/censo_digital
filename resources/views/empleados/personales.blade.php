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
                        <form action="{{ route('empleados.spersonal') }}" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="hidden" name="empleado_id" value="{{$agente->nrouag}}"  class="form-control">
                                    <div class="form-group">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="text" name="fecha_nac" data-mask="0000-00-00"  value="{{$agente->FECNAC}}"class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        {!! Form::select('estado_civil', [''=>'','1'=>'Soltero/a','2'=>'Casado/a','3'=>'Concubino/a', '4'=>'Viudo/a', '5'=>'Divorciado/a'] ,  null, ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Permiso para conducir</label>
                                        <select name="permiso"  class="form-control">
                                            <option>Si </option>
                                            <option>No </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select name="sexo"  class="form-control">
                                            <option value="M">Masculino </option>
                                            <option value="F">Femenino </option>
                                        </select>
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
                                                    <input class="custom-control-input" name="residencia" type="checkbox" id="customCheckbox1">
                                                    <label for="customCheckbox1" class="custom-control-label">La dirección que figura en el DNI es su residencia actual y es diferente a la registrada en el sistema actual<label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Calle</label>
                                                    <input type="text" name="calle" class="form-control"  value="{{ $agente->DOMICI  }}" placeholder="Enter ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Altura</label>
                                                    <input type="text" name="altura" class="form-control" placeholder="Enter ...">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Manzana</label>
                                                <input type="text" name="manzana" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Parcela</label>
                                                <input type="text" name="parcela" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Piso</label>
                                                <input type="text" name="piso" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departamento</label>
                                                <input type="text" name="dpto" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barrio</label>
                                                <input type="text" name="barrio" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Localidad</label>
                                                <input type="text" name="localidad" class="form-control" placeholder="Enter ...">
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
                                                <input type="text" name="celular" data-mask="0000-000000" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tel. Fijo</label>
                                                <input type="text" data-mask="0000-000000" name="tel_fijo" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tel. Emergencia</label>
                                                <input type="text" name="tel_emergencia" data-mask="0000-000000"  class="form-control" placeholder="Enter ...">
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
                                                <select name="pareja"  class="form-control">
                                                    <option>Si </option>
                                                    <option>No </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Cuántos hijos viven en su domicilio?</label>
                                                <input type="text" name="hijos" data-mask="00" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hijos menores de 15 años?</label>
                                                <input type="text" name="menores" data-mask="00" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hijos mayores de 15</label>
                                                <input type="text" name="mayores" data-mask="00" class="form-control" placeholder="Enter ...">
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
                                            <input class="custom-control-input" name="poliza" type="checkbox" id="customCheckbox2">
                                            <label for="customCheckbox2" class="custom-control-label">SEGURO: Declaro que necesito ser citado para modificar los datos de la o las personas aseguradas en mi póliza.</label>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Obra Social</h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="obra_social" type="checkbox" id="customCheckbox4">
                                            <label for="customCheckbox4" class="custom-control-label">OBRA SOCIAL: Declaro que necesito ser citado para modificar los datos de las personas que están a cargo en mi obra social.  </label>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="card-title">Personas a Cargo</h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="fliares_cargo" type="checkbox" id="customCheckbox3">
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

