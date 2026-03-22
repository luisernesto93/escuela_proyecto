@extends('layouts.app')

@section('title', 'Lista de Inscripciones')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Inscripciones</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('inscripciones.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> NUEVA INSCRIPCI&Oacute;N
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
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Estudiante</th>
                                <th>Documento</th>
                                <th>Carrera</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($inscripciones))
                                @foreach ($inscripciones as $key => $inscripcion)
                                    <tr>
                                        <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                        <td class="p-2 align-middle">
                                            {{ $inscripcion->estudiante->nombres . ' ' . $inscripcion->estudiante->apellidos ?? '' }}
                                        </td>
                                        <td class="p-2 align-middle">{{ $inscripcion->estudiante->documento ?? '' }}
                                        </td>
                                        <td>
                                            {{ $inscripcion->carrera->nombre ?? '-' }}
                                        </td>
                                        <td class="p-2 align-middle text-center"> {!! $inscripcion->estado_texto == 'ACTIVO'
                                            ? '<span class="badge badge-success shadow">ACTIVO</span>'
                                            : '<span class="badge badge-danger shadow">INACTIVO</span>' !!}
                                        </td>
                                        {{-- Actiones --}}
                                        <td style="display: flex">
                                            <a href="{{ route('inscripciones.edit', ['inscripcione' => $inscripcion->id]) }}"
                                                class="btn btn-outline-primary m-1">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="{{ route('inscripciones.show', ['inscripcione' => $inscripcion->id]) }}"
                                                class="btn btn-outline-info m-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if ($inscripcion->estado == 0)
                                                <a href="{{ route('inscripciones.estado', ['inscripcion_id' => $inscripcion->id, 'estado' => 1]) }}"
                                                    class="btn btn-outline-success m-1">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @elseif ($inscripcion->estado == 1)
                                                <a href="{{ route('inscripciones.estado', ['inscripcion_id' => $inscripcion->id, 'estado' => 0]) }}"
                                                    class="btn btn-outline-danger m-1">
                                                    <i class="fa fa-ban"></i>
                                                </a>
                                            @endif
                                            <a class="btn btn-outline-danger m-1" href="#" data-toggle="modal"
                                                data-target="#deleteModal" data-placement="top">
                                                <i class="fas fas fa-trash-alt"></i>
                                            </a>
                                            <form action="{{ route('reporte_inscripcion', $inscripcion->id) }}"
                                                method="post" target="_blank">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-info m-1" target="_blank">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('inscripciones.toma_materia', $inscripcion->estudiante->id) }}"
                                                method="post" target="_blank">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success m-1" target="_blank">
                                                    <i class="fas fa-notes-medical"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No hay inscripciones registradas!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @if (count($inscripciones))
        {{-- verificar si hay datos o no --}}
        @include('inscripciones.delete-modal')
    @endif
@endsection

@section('scripts')

@endsection
