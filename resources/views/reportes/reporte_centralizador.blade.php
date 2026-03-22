@extends('layouts.app')

@section('title', 'CENTRALIZADOR DE CALIFICACIONES')

@section('content')
    <div class="container-fluid">
        @include('reportes.filtros_centralizador')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-md-flex justify-content-start" style="font-size: 12px; font-weight: bold;">
                    <p class="mt-2 mr-4"><strong>GESTI&Oacute;N: </strong>{{ $r_centralizadors[0]->nombre_gestion ?? '-' }} -
                        {{ $r_centralizadors[0]->anio_gestion ?? '-' }}</p>
                    <p class="mt-2 mr-4"><strong>CARRERA: </strong>{{ $r_centralizadors[0]->nombre_carrera ?? '-' }}</p>
                    <p class="mt-2 mr-4"><strong>NIVEL: </strong>{{ textoNivelIndex($r_centralizadors[0]->nivel_id ?? '-') }}
                    </p>
                    <p class="mt-2 mr-4"><strong>MATERIA (CURSO):
                        </strong>{{ textoOrdenIndex($r_centralizadors[0]->materia_gestion ?? '-') }}</p>
                    <form action="{{ route('print_centralizador') }}" method="post" target="_blank">
                        @csrf
                        <input type="hidden" name="gestion_id" value="{{ $r_centralizadors[0]->gestion_id ?? '-' }}">
                        <input type="hidden" name="carrera_id" value="{{ $r_centralizadors[0]->carrera_id ?? '-' }}">
                        <input type="hidden" name="nivel" value="{{ $r_centralizadors[0]->nivel_id ?? '-' }}">
                        <input type="hidden" name="materia_gestion"
                            value="{{ $r_centralizadors[0]->materia_gestion ?? '-' }}">

                        <button type="submit" class="btn btn-outline-danger ml-2 mb-1" target="_blank">
                            <i class="fas fa-print"></i>
                        </button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table-sm table-striped table-bordered" id="dataTable"
                            width="100%">
                            <thead
                                style="font-size: 12px; background-color: #b2f2d4; text-align: center; font-weight: bold;">
                                <tr>
                                    <td>N&deg;</td>
                                    <td style="white-space: nowrap; overflow: hidden;">N&Oacute;MINA ESTUDIANTES</td>
                                    <td>C.I</td>
                                    @isset($materias)
                                        @foreach ($materias as $materia)
                                            <td>{{ $materia->nombre_materia ?? '-' }}</td>
                                        @endforeach
                                        <td>OBSERVACIONES</td>
                                    @endisset
                                </tr>
                            </thead>

                            <tbody style="font-size: 12px;">
                                @isset($r_centralizadors)
                                    @php
                                        $numMaterias = count($materias);
                                        $estudiantes = collect($r_centralizadors)->groupBy('estudiante_id');
                                        $contador = 1;
                                    @endphp
                                    @foreach ($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ $contador }}</td>
                                            <td>
                                                {{ $estudiante[0]->nombre_estudiante ?? '-' }}
                                                {{ $estudiante[0]->apellido_estudiante ?? '-' }}
                                            </td>
                                            <td>{{ $estudiante[0]->documento ?? '-' }}</td>
                                            @foreach ($materias as $materia)
                                                @php
                                                    $nota = $estudiante->firstWhere('materia_id', $materia->id);
                                                @endphp
                                                <td class="text-center">{{ $nota ? $nota->nota_final : '-' }}</td>
                                            @endforeach
                                            @php
                                                $suma = 0;
                                                foreach ($estudiante as $est) {
                                                    $suma += $est->nota_final;
                                                }
                                                $promedio = $suma / $numMaterias;
                                            @endphp
                                            <td>{{ $promedio >= 61 ? 'APROBADO' : 'REPROBADO' }}</td>
                                        </tr>
                                        @php
                                            $contador++;
                                        @endphp
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @php
        function textoNivelIndex($nivel)
        {
            if ($nivel == 1) {
                return 'TÉCNICO MEDIO';
            } elseif ($nivel == 2) {
                return 'TÉCNICO SUPERIOR';
            } elseif ($nivel == 3) {
                return 'LICENCIATURA';
            } elseif ($nivel == 4) {
                return 'MAESTRÍA';
            } elseif ($nivel == 5) {
                return 'DOCTORADO';
            }

            return '';
        }
        function textoOrdenIndex($orden)
        {
            if ($orden == 1) {
                return 'PRIMER AÑO';
            } elseif ($orden == 2) {
                return 'SEGUNDO AÑO';
            } elseif ($orden == 3) {
                return 'TERCER AÑO';
            } elseif ($orden == 4) {
                return 'CUARTO AÑO';
            } elseif ($orden == 5) {
                return 'QUINTO AÑO';
            } elseif ($orden == 6) {
                return 'SEXTO AÑO';
            }
            return '';
        }

    @endphp
@endsection
