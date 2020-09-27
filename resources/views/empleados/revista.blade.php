@extends('adminlte::page')
@section('adminlte_css')
@stop
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
                        <form action="{{ route('empleados.srevista') }}" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-4">
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
                                        <input type="text" name="motivo" class="form-control" placeholder="Si no percibe, indique la razón">
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
                                                <label>Area:</label>
                                                <input id="area_search" placeholder="Buscar Area" name="area" type="text" onfocus="this.value=''" autocomplete="off" class="form-control">
                                                <input id="area_nro" placeholder="Buscar Area" name="area_id" type="hidden" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Lugar fisico de trabajo:</label>
                                                {!! Form::select('reloj_id', $reloj ,  null, ['class' => 'form-control','autocomplete'=> 'off'])!!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Indicar Area, en caso de no encontrar</label>
                                                <input type="text" name="area_nueva"  class="form-control" placeholder="Indicar area">
                                            </div>
                                            <div class="form-group">
                                                <label>Indicar lugar, en caso de no encontrar</label>
                                                <input type="text" name="reloj_nuevo"  class="form-control" placeholder="Indicar reloj">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>Horario de trabajo</h5>
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <!-- <h5 class="mt-4 mb-2">Enfermedades</h5> -->
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" name="mañana" type="checkbox" id="customCheckbox1">
                                                    <label for="customCheckbox1" class="custom-control-label">Mañana</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" name="tarde" type="checkbox" id="customCheckbox2">
                                                    <label for="customCheckbox2" class="custom-control-label">Tarde</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" name="noche" type="checkbox" id="customCheckbox3" >
                                                    <label for="customCheckbox3" class="custom-control-label">Noche</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@section('adminlte_js')
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){

            $( "#area_search" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    $.ajax({
                        url:"{{ route('areas.autocomplete')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#area_search').val(ui.item.label); // display the selected text
                    $('#area_nro').val(ui.item.value)
                    return false;
                }
            });

        });
    </script>
@stop



})
