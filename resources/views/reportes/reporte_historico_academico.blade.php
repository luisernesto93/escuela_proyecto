@extends('layouts.app')

@section('title', 'Reporte de Inscripciones')

@section('content')
    <div class="container-fluid">
        @include('reportes.filtros_historico_academico')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-md-flex justify-content-start" style="font-size: 16px; font-weight: bold;">
                    <p class="mt-2 mr-4"><strong>CARRERA: </strong>{{ $r_historicos[0]->nombre_carrera ?? '-' }}</p>
                    <p class="mt-2"><strong>ESTUDIANTE: </strong>{{ $r_historicos[0]->nombre_estudiante ?? '-' }}
                        {{ $r_historicos[0]->apellido_estudiante ?? '-' }}</p>
                    <form action="{{ route('print_historico', $r_historicos[0]->id_estudiante ?? '-') }}" method="post"
                        target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger ml-2 mb-1" target="_blank">
                            <i class="fas fa-print"></i>
                        </button>
                    </form>
                    <form action="{{ route('excel_historico', $r_historicos[0]->id_estudiante ?? '-') }}" method="post"
                        target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-outline-success ml-2 mb-1" target="_blank">
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>GESTI&Oacute;N</th>
                                <th>SEMESTRE</th>
                                <th>C&Oacute;DIGO</th>
                                <th>ASIGANTURA</th>
                                <th>NOTA</th>
                                <th>P. RECUPERATORIA</th>
                                <th>OBSERVACI&Oacute;N</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($r_historicos)
                                @foreach ($r_historicos as $key => $r_historico)
                                    <tr>
                                        <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                        <td class="p-2 align-middle">{{ $r_historico->gestion }} - {{ $r_historico->anio }}</td>
                                        <td class="p-2 align-middle">{{ textoNivel($r_historico->nivel ?? '-') }}</td>
                                        <td class="p-2 align-middle">{{ $r_historico->sigla ?? '-' }}</td>
                                        <td class="p-2 align-middle">{{ $r_historico->nombre_materia ?? '-' }}</td>
                                        <td class="p-2 align-middle">{{ $r_historico->nota_final ?? '-' }}</td>
                                        <td class="p-2 align-middle">{{ $r_historico->prueba_recuperatoria ?? '-' }}</td>
                                        <td class="p-2 align-middle">{{ $r_historico->observaciones ?? '-' }}</td>
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

@php
    function textoNivel($nivel)
    {
        if ($nivel == 1) {
            return 'PRIMERO';
        } elseif ($nivel == 2) {
            return 'SEGUNDO';
        } elseif ($nivel == 3) {
            return 'TERCERO';
        } elseif ($nivel == 4) {
            return 'CUARTO';
        } elseif ($nivel == 5) {
            return 'QUINTO';
        } elseif ($nivel == 6) {
            return 'SEXTO';
        } elseif ($nivel == 7) {
            return 'SEPTIMO';
        } elseif ($nivel == 8) {
            return 'OCTAVO';
        } elseif ($nivel == 9) {
            return 'NOVENO';
        } elseif ($nivel == 10) {
            return 'DECIMO';
        } elseif ($nivel == 11) {
            return 'UNDECIMO';
        } elseif ($nivel == 12) {
            return 'DUODECIMO';
        }

        return '';
    }

@endphp
