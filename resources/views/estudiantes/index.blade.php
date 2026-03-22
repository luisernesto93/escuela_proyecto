@extends('layouts.app')

@section('title', 'Lista de Estudiantes')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Estudiantes</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('estudiantes.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> NUEVO ESTUDIANTE
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
                                <th>#</th>
                                <th>Nombres y Apellidos</th>
                                <th>Documento</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($estudiantes))
                            @foreach ($estudiantes as $key => $estudiante)
                                <tr>
                                    <td class="p-2 align-middle">{{ $estudiante->id}}</td>
                                    <td class="p-2 align-middle">{{ $estudiante->nombres ?? '' }} {{ $estudiante->apellidos ?? '' }}</td>
                                    <td class="p-2 align-middle">{{ $estudiante->documento }}</td>
                                    <td class="p-2 align-middle">{{ $estudiante->telefono }}</td>
                                    <td class="p-2 align-middle">{{ $estudiante->correo }}</td>
                                    {{-- <td class="p-2 align-middle"> {{ $estudiante->estado_texto }} </td> --}}
                                    <td class="p-2 align-middle text-center"> {!! ($estudiante->estado_texto == 'ACTIVO') ? ('<span class="badge badge-success shadow">ACTIVO</span>'): ('<span class="badge badge-danger shadow">INACTIVO</span>') !!} </td>
                                    <td style="display: flex">
                                        <a href="{{ route('estudiantes.edit', ['estudiante' => $estudiante->id]) }}"
                                            class="btn btn-outline-primary m-1">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a href="{{ route('estudiantes.show', ['estudiante' => $estudiante->id]) }}"
                                            class="btn btn-outline-info m-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if ($estudiante->estado == 0)
                                        <a href="{{ route('estudiantes.estado', ['estudiante_id' => $estudiante->id, 'estado' => 1]) }}"
                                            class="btn btn-outline-success m-1">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        @elseif ($estudiante->estado == 1)
                                            <a href="{{ route('estudiantes.estado', ['estudiante_id' => $estudiante->id, 'estado' => 0]) }}"
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
								<td colspan="7" class="text-center">No hay Esudiantes registrados</td>
							</tr>
							@endif
                        </tbody>
                    </table>

                    {{ $estudiantes->links() }}
                </div>
            </div>
        </div>

    </div>
    @if(count($estudiantes))
    @include('estudiantes.delete-modal')
    @endif
@endsection

@section('scripts')

@endsection