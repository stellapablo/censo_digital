@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>USUARIOS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">USUARIOS</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12   ">
            <div class="card">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable dtr-inline" role="grid" id="users">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Creación</th>
                                <th>Fecha Actualización</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop

@section('js')
    <script>
        $(function() {
            $('#users').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatable.users') !!}',
                language: {
                    'url': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'creado_el', name: 'creado_el' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: true, searchable: true}
                ]
            });
        });
    </script>
@stop

