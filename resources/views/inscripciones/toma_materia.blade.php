@extends('layouts.app')

@section('title', 'Lista de materias_tomadas_tomadas')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-center">LISTA DE MATERIAS TOMADAS</h4>
                @include('common.alert')
                <div class="form-group row">
                    <p class="ml-2 mr-2"><strong>Estudiante: </strong>{{ $materias_tomadas[0]->nombre_estudiante ?? '' }}
                        {{ $materias_tomadas[0]->apellido_estudiante ?? '' }}</p>
                    <p><strong>Carrera: </strong>{{ $materias_tomadas[0]->nombre_carrera ?? '' }}</p>
                </div>
                <table class="table-sm table-striped table-bordered bg-white shadow" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SIGLAS</th>
                            <th>GESTION</th>
                            <th>MATERIAS</th>
                            <th>NOTA_1</th>
                            <th>NOTA_2</th>
                            <th>NOTA_3</th>
                            <th>PROMEDIO</th>
                            <th>OBSERVACIONES</th>
                            <th>X</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($materias_tomadas))
                            @foreach ($materias_tomadas as $key => $materias_tomada)
                                <tr>
                                    <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                    <td class="p-2 align-middle">{{ $materias_tomada->sigla ?? '' }} </td>
                                    <td class="p-2 align-middle">{{ $materias_tomada->gestion }} -
                                        {{ $materias_tomada->anio }}</td>

                                    <td class="p-2 align-middle">
                                        {{ $materias_tomada->nombre_materia ?? '' }}
                                    </td>
                                    <td class="p-2 align-middle">
                                        {{ $materias_tomada->nota1 ?? '' }}
                                    </td>
                                    <td class="p-2 align-middle">
                                        {{ $materias_tomada->nota2 ?? '' }}
                                    </td>
                                    <td class="p-2 align-middle">
                                        {{ $materias_tomada->nota3 ?? '' }}
                                    </td>
                                    <td class="p-2 align-middle">
                                        {{ $materias_tomada->nota_final ?? '' }}
                                    </td>
                                    <td class="p-2 align-middle">
                                        {{ $materias_tomada->observaciones ?? '' }}
                                    </td>
                                    <td class="p-2 align-middle">
                                        @if ($materias_tomada->nota1 <= 0 && $materias_tomada->nota2 <= 0 && $materias_tomada->nota3 <= 0)
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#deletemateriaModal" data-placement="top">
                                                <i class="fas fa-Ftrash-alt"></i>X
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-danger" disabled>
                                                <i class="fas fa-Ftrash-alt"></i>X
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No hay materias tomadas!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
        @include('inscripciones.delete-materia-tomada')

        <div class="card shadow mt-4">
            <h4 class="text-center mt-2"><strong> TOMA DE MATERIAS</strong></h4>
            @php
                // Aplanar el array y agrupar las materias por 'orden'
                $materiasAgrupadas = collect($materias_no_tomadas)
                    ->flatten(1)
                    ->groupBy('orden');
            @endphp

            @foreach ($materiasAgrupadas as $orden => $materias)
                <table class="table-sm table-striped table-bordered bg-white shadow" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SIGLA</th>
                            <th style="width: 400px">MATERIAS</th>
                            <th>HORAS</th>
                            <th>ORDEN</th>
                            <th>SELECCIONAR Y TOMAR MATERIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($materias->count())
                            @foreach ($materias as $key => $materias_no_tomada)
                                <tr>
                                    <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                    <td class="p-2 align-middle">{{ $materias_no_tomada->sigla ?? '' }}</td>
                                    <td class="p-2 align-middle">{{ $materias_no_tomada->nombre_materia ?? '' }}</td>
                                    <td class="p-2 align-middle">{{ $materias_no_tomada->horas ?? '' }}</td>
                                    <td class="p-2 align-middle">{{ textoOrden($materias_no_tomada->orden ?? '') }}</td>
                                    <td class="p-2 align-middle">
                                        <form action="{{ route('new', $materias_no_tomada->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="estudiante_id"
                                                value="{{ $materias_tomadas[0]->estudiante_id ?? '' }}">
                                            <input type="hidden" name="materia_id" value="{{ $materias_no_tomada->id }}">
                                            <input type="hidden" name="carrera_id"
                                                value="{{ $materias_tomadas[0]->carrera_id }}">
                                            @php
                                                $materia_prerequisito = array_search($materias_no_tomada->materia_prerequisito_id, array_column($materias_no_tomadas->toArray(), 'id'));
                                            @endphp
                                            @if ($materia_prerequisito === false)
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <select
                                                            class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                                                            name="gestion_id" required>
                                                            @foreach ($gestiones as $gestion)
                                                                <option value="{{ $gestion->id }}"
                                                                    {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>
                                                                    {{ $gestion->descripcion }} - {{ $gestion->anio }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('gestion_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <select
                                                            class="form-control form-control-sm @error('turno_id') is-invalid @enderror"
                                                            name="turno_id" required>
                                                            @foreach ($turnos as $turno)
                                                                <option value="{{ $turno->id }}"
                                                                    {{ old('turno_id') == $turno->id ? 'selected' : '' }}>
                                                                    {{ $turno->descripcion }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('turno_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-plus-circle"></i>
                                                            Tomar
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-danger" disabled>
                                                    <i class="fas fa-clock"></i>
                                                    No se puede tomar la materia
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">¡No hay materias tomadas para el orden
                                    {{ $orden }}!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @unless ($loop->last)
                    <hr> <!-- Agrega una línea después de cada tabla, excepto después de la última -->
                @endunless
            @endforeach

        </div>
    </div>
@endsection

@php
    function estadoTexto($estado)
    {
        switch ($estado) {
            case 1:
                return 'APROBADO';
                break;
            case 2:
                return 'REPROBADO';
                break;
            case 3:
                return 'REPROBADO POR INASISTENCIA';
                break;
            case 4:
                return 'REPROBADO POR ABANDONO';
                break;
            case 5:
                return 'REPROBADO POR INASISTENCIA Y ABANDONO';
                break;
            case 6:
                return 'REPROBADO POR INASISTENCIA Y NOTA';
                break;

            default:
                return 'SIN ESTADO';
                break;
        }
    }
    function textoOrden($orden)
    {
        if ($orden == 1) {
            return '1MER AÑO';
        } elseif ($orden == 2) {
            return '2DO AÑO';
        } elseif ($orden == 3) {
            return '3ER AÑO';
        } elseif ($orden == 4) {
            return '4TO AÑO';
        } elseif ($orden == 5) {
            return '5TO AÑO';
        } elseif ($orden == 6) {
            return '6TO AÑO';
        }
        return '';
    }
@endphp
