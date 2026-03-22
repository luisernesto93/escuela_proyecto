@extends('layouts.app')

@section('title', 'Lista de canal publicitarios')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Canales Publicitarios</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('canal_publicitarios.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> Nuevo Canal Publicitario
                    </a>
                </div>
            </div>
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
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- dd($canal_publicitarios) --}}
                        @if (count($canal_publicitarios))
                            @foreach ($canal_publicitarios as $canal_publicitario)
                            <tr>
                                <td class="p-2 align-middle">{{ $canal_publicitario->id }}</td>
                                <td class="p-2 align-middle">{{ $canal_publicitario->descripcion ?? ''}}</td>
                                <td class="p-2 align-middle text-center"> {!! ($canal_publicitario->estado_texto == 'ACTIVO') ? ('<span class="badge badge-success shadow">ACTIVO</span>'): ('<span class="badge badge-danger shadow">INACTIVO</span>') !!} </td>
                                <td style="display: flex">
                                    <a href="{{ route('canal_publicitarios.edit', ['canal_publicitario' => $canal_publicitario->id]) }}"
                                        class="btn btn-outline-primary m-1">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="{{ route('canal_publicitarios.show', ['canal_publicitario' => $canal_publicitario->id]) }}" 
                                        class="btn btn-outline-info m-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if ($canal_publicitario->estado == 0)
                                    <a href="{{ route('canal_publicitarios.estado', ['canal_publicitario_id' => $canal_publicitario->id, 'estado' => 1]) }}"
                                        class="btn btn-outline-success m-1">
                                        <i class="fa fa-check"></i>
                                    </a>

                                    @elseif ($canal_publicitario->estado == 1)
                                    <a href="{{ route('canal_publicitarios.estado', ['canal_publicitario_id' => $canal_publicitario->id, 'estado' => 0]) }}"
                                        class="btn btn-outline-danger m-1">
                                        <i class="fa fa-ban"></i>
                                    </a>

                                    @endif
                                    <a class="btn btn-outline-danger m-1" href="#" data-toggle="modal" data-target="#deleteModal" data-placement="top">
                                        <i class="fas fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No hay canal_publicitarios registradas!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                    {{ $canal_publicitarios->links() }}
                </div>
            </div>
        </div>

    </div>
    @if (count($canal_publicitarios)) {{-- verificar si hay datos o no --}}
        @include('canal_publicitarios.delete-modal')
    @endif


@endsection

@section('scripts')

@endsection