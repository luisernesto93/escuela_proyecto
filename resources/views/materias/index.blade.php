@extends('layouts.app')

@section('title', 'Lista de Materia')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Materias</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('materias.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> NUEVA MATERIA
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
                                <th>Plan Estudio</th>
                                <th>Carrera</th>
                                <th>Sigla</th>
                                <th>Nombre Materia</th>
                                <th>Horas</th>
                                <th>Nivel</th>
                                <th>Orden</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($materias))
                                @foreach ($materias as $key => $materia)
                                    <tr>
                                        <td class="p-2 align-middle">{{ $materia->id }}</td>
                                        <td class="p-2 align-middle">{{ $materia->plan_estudio->area_formacion ?? ''}}</td>
                                        <td class="p-2 align-middle">{{ $materia->carrera->nombre ?? '' }} </td>
                                        <td class="p-2 align-middle">{{ $materia->sigla ?? '' }} </td>
                                        <td class="p-2 align-middle">{{ $materia->nombre_materia ?? '' }} </td>
                                        <td class="p-2 align-middle">{{ $materia->horas ?? '' }} </td>
                                        <td class="p-2 align-middle">{{ $materia->nivel ?? '' }} </td>
                                        <td class="p-2 align-middle">{{ $materia->orden ?? '' }} </td>
                                        <td class="p-2 align-middle text-center"> {!! $materia->estado_texto == 'ACTIVO'
                                            ? '<span class="badge badge-success shadow">ACTIVO</span>'
                                            : '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
                                        <td style="display: flex">
                                            <a href="{{ route('materias.edit', ['materia' => $materia->id]) }}"
                                                class="btn btn-outline-primary m-1">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="{{ route('materias.show', ['materia' => $materia->id]) }}"
                                                class="btn btn-outline-info m-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if ($materia->estado_texto == 'INACTIVO')
												<a
													href="{{ route('materias.estado', ['materia_id' => $materia->id, 'estado' => 1]) }}"
													class="btn btn-outline-success m-1">
													<i class="fa fa-check"></i>
												</a>
											@elseif ($materia->estado == 1)
												<a
													href="{{ route('materias.estado', ['materia_id' => $materia->id, 'estado' => 0]) }}"
													class="btn btn-outline-danger m-1">
													<i class="fa fa-ban"></i>
												</a>
											@endif
											<a class="btn btn-outline-danger m-1" href="#"
												data-toggle="modal" data-target="#deleteModal" data-placement="top">
												<i class="fas fas fa-trash-alt"></i>
											</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12" class="text-center">No hay Materias registrados</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $materias->links() }}
                </div>
            </div>
        </div>

    </div>
    @if (count($materias))
        @include('materias.delete-modal')
    @endif
@endsection

@section('scripts')

@endsection
