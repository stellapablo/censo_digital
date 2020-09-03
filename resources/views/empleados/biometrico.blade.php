@extends('adminlte::page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
@section('title', 'Dashboard')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Agente</a></li>
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
                        <form method="post" action="{{route('empleados.sbiometrico',$agente->id)}}" enctype="multipart/form-data"
                              class="dropzone" id="dropzone">
                            <input type="hidden" value="{{ $agente->id }}" name="empĺeado_id">
                            @csrf
                        </form>
                        <br />
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Archivos</h3>
                            </div>
                            <div class="panel-body" id="uploaded_image">
                                @foreach($images as $image)
                                    <div class="col-md-2" style="margin-bottom:16px;" align="center">
                                        <img src="{{ asset('images/' . $image->imagen) }}" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        Dropzone.options.dropzone = {
                                maxFilesize: 10,
                                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                                addRemoveLinks: true,
                                timeout: 60000,
                                init: function () {
                                    this.on("removedfile", function (file) {
                                        $.post({
                                            url: 'image/delete',
                                            data: {nombre: file.name, id: {{ $agente->id }},_token: $('[name="_token"]').val()},
                                            dataType: 'json',
                                            success: function (data) {
                                                $('#uploaded_image').html(data);
                                            }
                                        });
                                    });

                                    this.on("complete", function(){
                                        load_images();
                                    });
                                },


                                success: function (file, response) {
                                    console.log(response);
                                },
                                error: function (file, response) {
                                    return false;
                                }
                            };

                            load_images();

                            function load_images()
                            {
                                $.ajax({
                                    url:"{{ route('dropzone.fetch') }}",
                                    data: {id: {{ $agente->id }},_token: $('[name="_token"]').val()},
                                    success:function(data)
                                    {
                                        $('#uploaded_image').html(data);
                                    }
                                })
                            }
                    </script>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
@stop

