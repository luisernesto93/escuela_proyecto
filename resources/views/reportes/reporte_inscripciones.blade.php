@extends('layouts.app')

@section('title', 'Reporte de Inscripciones')

@section('content')
    <div class="container-fluid">
        
        @include('reportes.filtros_inscripciones')

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres y Apellidos</th>
                                <th>Fecha Inscripci&oacute;n</th>
                                <th>Carrera</th>
                                <th>Gesti&oacute;n</th>
                                <th>Turno</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($r_inscripciones)
                                @foreach ($r_inscripciones as $key => $r_inscripcion)
                                    <tr>
                                        <td class="p-2 align-middle">{{ $r_inscripcion->id }}</td>
                                        <td class="p-2 align-middle">{{ $r_inscripcion->nombres }}
                                            {{ $r_inscripcion->apellidos }}</td>
                                        <td class="p-2 align-middle">{{ $r_inscripcion->fecha_inscripcion }}</td>
                                        <td class="p-2 align-middle">{{ $r_inscripcion->carrera }}</td>
                                        <td class="p-2 align-middle">{{ $r_inscripcion->gestion }} - {{ $r_inscripcion->anio }}
                                        </td>
                                        <td class="p-2 align-middle">{{ $r_inscripcion->turno }}</td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection
