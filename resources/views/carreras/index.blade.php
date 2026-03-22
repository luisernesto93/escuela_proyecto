@extends('layouts.app')

@section('title', 'Lista de Carreras')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Carreras</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('carreras.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> NUEVA CARRERA
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
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Facultad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($carreras))
                                @foreach ($carreras as $carrera)
                                    <tr>
                                        <td class="p-2 align-middle">{{ $carrera->codigo ?? '' }}</td>
                                        <td class="p-2 align-middle">{{ $carrera->nombre ?? ''}}</td>
                                        <td class="p-2 align-middle"> {{ $carrera->facultad->descripcion ?? ''}} </td>
                                        <td class="p-2 align-middle text-center"> {!! ($carrera->estado == 1) ? ('<span class="badge badge-success shadow">ACTIVO</span>'): ('<span class="badge badge-danger shadow">INACTIVO</span>') !!} </td>

                                        <td style="display: flex">
                                            <a href="{{ route('carreras.edit', ['carrera' => $carrera->id]) }}"
                                                class="btn btn-outline-primary m-1">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="{{ route('carreras.show', ['carrera' => $carrera->id]) }}"
                                                class="btn btn-outline-info m-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if ($carrera->estado == 0)
                                            <a href="{{ route('carreras.estado', ['carrera_id' => $carrera->id, 'estado' => 1]) }}"
                                                class="btn btn-outline-success m-1">
                                                <i class="fa fa-check"></i>
                                            </a>
                                            @elseif ($carrera->estado == 1)
                                                <a href="{{ route('carreras.estado', ['carrera_id' => $carrera->id, 'estado' => 0]) }}"
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
                                <td colspan="4" class="text-center">No hay carreras registradas!</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                    {{ $carreras->links() }}
                </div>
            </div>
        </div>

    </div>
    @if(count($carreras))
        @include('carreras.delete-modal')
    @endif

@endsection

@section('scripts')

@endsection