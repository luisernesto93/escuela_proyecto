@extends('layouts.app')

@section('title', 'REGISTRO DE NOTAS')

@section('content')
    <div class="container-fluid">
        @include('notasgestions.filtros')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-md-flex justify-content-start" style="font-size: 12px; font-weight: bold;">
                    <p class="mt-2 mr-4"><strong>GESTI&Oacute;N: </strong>{{ $notasgestions[0]->nombre_gestion ?? '-' }} -
                        {{ $notasgestions[0]->anio_gestion ?? '-' }}</p>
                    <p class="mt-2 mr-4"><strong>CARRERA: </strong>{{ $notasgestions[0]->nombre_carrera ?? '-' }}</p>
                    <p class="mt-2 mr-4"><strong>NIVEL: </strong>{{ textoNivelIndex($notasgestions[0]->nivel_id ?? '-') }}
                    </p>
                    <p class="mt-2 mr-4"><strong>MATERIA (CURSO):
                        </strong>{{ $notasgestions[0]->nombre_materia ?? '-' }} -
                        {{ textoOrdenIndex($notasgestions[0]->materia_gestion ?? '-') }}</p>
                </div>

                <form method="POST" action="{{ route('notasgestions.notas_estudiantes') }}">
                    @csrf
                    @method('POST')
                    <div class="table-responsive">
                        <table class="table-sm table-striped table-bordered bg-white shadow fs-12">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">ESTUDIANTE</th>
                                    <th>REGISTRO DE NOTAS</th>
                                    <th>PROMEDIO</th>
                                    <th>NOTA_FINAL</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                            @isset($notasgestions)
                                @php
                                    $notas_estudiantes = [];
                                @endphp
                                @foreach ($notasgestions as $key => $notasgestion)
                                    <tr>
                                        <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                        <td class="p-2 align-middle">{{ $notasgestion->nombre_estudiante ?? '-' }}
                                            {{ $notasgestion->apellido_estudiante ?? '-' }}</td>
                                        <td class="p-2">
                                            <div class="form-group row" style="font-size: 12px;">
                                                <div class="col-md-2">
                                                    <strong>NOTA 1:</strong>
                                                    <input type="number" name="nota1" class="form-control form-control-sm"
                                                        placeholder="Nota 1" value="{{ old('nota1', $notasgestion->nota1) }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <strong>NOTA 2:</strong>
                                                    <input type="number" name="nota2" class="form-control form-control-sm"
                                                        placeholder="Nota 2" value="{{ old('nota2', $notasgestion->nota2) }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <strong>NOTA 3:</strong>
                                                    <input type="number" name="nota3" class="form-control form-control-sm"
                                                        placeholder="Nota 3" value="{{ old('nota3', $notasgestion->nota3) }}">
                                                </div>

                                                <div class="col-md-2">
                                                    <strong>P. RECP:</strong>
                                                    <input type="number" name="prueba_recuperatoria"
                                                        class="form-control form-control-sm" placeholder="Recuperatorio"
                                                        value="{{ old('prueba_recuperatoria', $notasgestion->prueba_recuperatoria) }}">
                                                </div>


                                            </div>
                                        </td>
                                        <td class="p-2 align-middle">{{ $notasgestion->promedio ?? '-' }}</td>
                                        <td class="p-2 align-middle">{{ $notasgestion->nota_final ?? '-' }}</td>
                                    </tr>
                                    @php
                                        $notas_estudiantes += [
                                            'id' => $notasgestion->id,
                                            'nota1' => $notasgestion->nota1,
                                            'nota2' => $notasgestion->nota2,
                                            'nota3' => $notasgestion->nota3,
                                            'prueba_recuperatoria' => $notasgestion->prueba_recuperatoria,
                                        ];
                                    @endphp
                                @endforeach
                            @endisset
                        </tbody> --}}
                            <tbody>
                                @isset($notasgestions)
                                    @foreach ($notasgestions as $key => $notasgestion)
                                        <tr>
                                            <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                            <td class="p-2 align-middle">{{ $notasgestion->nombre_estudiante ?? '-' }}
                                                {{ $notasgestion->apellido_estudiante ?? '-' }}</td>
                                            <td class="p-2">
                                                <div class="form-group row col-12" style="font-size: 14px;">
                                                    <div class="col-md-3">
                                                        <strong>NOTA 1:</strong>
                                                        <input type="number" name="notas[{{ $notasgestion->id }}][nota1]"
                                                            class="form-control form-control-sm" placeholder="Nota 1"
                                                            value="{{ old('nota1', $notasgestion->nota1) }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>NOTA 2:</strong>
                                                        <input type="number" name="notas[{{ $notasgestion->id }}][nota2]"
                                                            class="form-control form-control-sm" placeholder="Nota 2"
                                                            value="{{ old('nota2', $notasgestion->nota2) }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>NOTA 3:</strong>
                                                        <input type="number" name="notas[{{ $notasgestion->id }}][nota3]"
                                                            class="form-control form-control-sm" placeholder="Nota 3"
                                                            value="{{ old('nota3', $notasgestion->nota3) }}">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <strong>P. RECP:</strong>
                                                        <input type="number"
                                                            name="notas[{{ $notasgestion->id }}][prueba_recuperatoria]"
                                                            class="form-control form-control-sm" placeholder="Recuperatorio"
                                                            value="{{ old('prueba_recuperatoria', $notasgestion->prueba_recuperatoria) }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 align-middle">{{ $notasgestion->promedio ?? '-' }}</td>
                                            <td class="p-2 align-middle">{{ $notasgestion->nota_final ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            <input type="hidden" name="gestion_id" value="{{ $notasgestions[0]->gestion_id ?? '' }}">
                            <input type="hidden" name="carrera_id" value="{{ $notasgestions[0]->carrera_id ?? '' }}">
                            <input type="hidden" name="nivel" value="{{ $notasgestions[0]->nivel_id ?? '' }}">
                            <button type="submit" class="btn btn-lg btn-success shadow">
                                <i class="fas fa-plus-circle"></i>
                                Registrar Notas
                            </button>
                        </div>
                    </div>
                </form>
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
