@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agentes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Listado de Agentes</li>
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
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable dtr-inline" role="grid" id="users">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Fecha Turno </th>
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
                ajax: '{!! route('datatable.agentes') !!}',
                language: {
                    'url': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                columns: [
                    { data: 'APYNOM', name: 'APYNOM' },
                    { data: 'DOCUME', name: 'DOCUME' },
                    { data: 'turno', name: 'turno' },
                    { data: 'action', name: 'action', orderable: true, searchable: true}
                ]
            });
        });
    </script>
@stop

