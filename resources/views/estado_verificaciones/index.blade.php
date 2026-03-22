@extends('layouts.app')

@section('title', 'Lista de estado de verificaciones')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Verificaciones</h1>
        </div>
        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id Estudiante</th>
                                <th>Estudiante</th>
                                {{-- <th>Apellidos</th> --}}
                                <th>Certificado</th>
                                <th>CI</th>
                                <th>Compromiso Título</th>
                                <th>Foto</th>
                                <th>Folder</th>
                                <th>Pago Folder</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($estado_verificaciones))
                            @foreach ($estado_verificaciones as $estado_verificacion)
                            <tr>
                                <td class="p-2 align-middle">{{ $estado_verificacion->id }}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->estudiante->id ?? ''}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->estudiante->nombres ." ". $estado_verificacion->estudiante->apellidos ?? ''}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->certificado_estado ==1 ? 'SI' : 'NO'}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->ci_estado==1 ? 'SI' : 'NO'}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->compromiso_titulo==1 ? 'SI' : 'NO'}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->foto_estado ==1 ? 'SI' : 'NO'}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->folder_estado ==1 ? 'SI' : 'NO'}}</td>
                                <td class="p-2 align-middle">{{ $estado_verificacion->pago_folder_estado==1 ? 'SI' : 'NO'}}</td>
                                <td class="p-2 align-middle text-center"> {!! ($estado_verificacion->estado_texto == 'ACTIVO') ? ('<span class="badge badge-success shadow">ACTIVO</span>'): ('<span class="badge badge-danger shadow">INACTIVO</span>') !!}
                                </td>
                                <td style="display: flex">
                                    <a href="{{ route('estado_verificaciones.edit', ['estado_verificacione' => $estado_verificacion->id] ) }}"
                                        class="btn btn-outline-primary m-1">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="{{ route('estado_verificaciones.show', ['estado_verificacione' => $estado_verificacion->id] ) }}"
                                        class="btn btn-outline-info m-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-danger m-1" href="#" data-toggle="modal" data-target="#deleteModal" data-placement="top">
                                        <i class="fas fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="12" class="text-center">No hay verificaciones registradas!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                    {{-- {{ $estado_verificaciones->links() }} --}}
                </div>
            </div>
        </div>

    </div>
    @if (count($estado_verificaciones)) {{-- verificar si hay datos o no --}}
    @include('estado_verificaciones.delete-modal')
    @endif
 


@endsection

@section('scripts')

@endsection