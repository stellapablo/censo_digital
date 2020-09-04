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
                        <li class="breadcrumb-item active">Datos Biometricos</li>
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
                        <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                            @csrf
                        </form>
                        <div align="center">
                            <button type="button" class="btn btn-info" id="submit-all">Upload</button>
                        </div>
                    </div>
                    <br />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Imagenes</h3>
                        </div>
                        <div class="panel-body" id="uploaded_image">

                        </div>
                    </div>
                </div>
                <script type="text/javascript">

                    Dropzone.options.dropzoneForm = {
                        autoProcessQueue : false,
                        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",

                        init:function(){
                            var submitButton = document.querySelector("#submit-all");
                            myDropzone = this;

                            submitButton.addEventListener('click', function(){
                                myDropzone.processQueue();
                            });

                            this.on("complete", function(){
                                if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                                {
                                    var _this = this;
                                    _this.removeAllFiles();
                                }
                                load_images();
                            });

                        }

                    };

                    load_images();

                    function load_images()
                    {
                        $.ajax({
                            url:"{{ route('dropzone.fetch') }}",
                            success:function(data)
                            {
                                $('#uploaded_image').html(data);
                            }
                        })
                    }

                    $(document).on('click', '.remove_image', function(){
                        var name = $(this).attr('id');
                        $.ajax({
                            url:"{{ route('dropzone.delete') }}",
                            data:{name : name},
                            success:function(data){
                                load_images();
                            }
                        })
                    });

                </script>

            </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
    </div>
@stop
