<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin/css/snappy-css.css') }}">
    <title>REPORTE-CENTRALIZADOR</title>
</head>
<style>
    .page_break {
        page-break-before: always;
    }
</style>

<body>
    @php
        $nro_folio = 1;
    @endphp
    @foreach ($r_centralizadors->chunk(30) as $grupo_r_centralizadors)
        <div class="container" style="font-family: Arial, Helvetica, sans-serif;">
            <div class="row text-center">
                <div class="col-3">
                    {{--  <img src="data:image/png;base64s, {{ $empresa->image1 }}" width="100" height="75"
                    alt="logo.jpg"> --}}
                </div>
                <div class="col-6">

                </div>
                <div class="col-3">
                    <table style="border: 1px solid black; border-collapse: collapse; width: 100%; height: 100%;">
                        <tr>
                            <td><strong>N&deg; LIBRO: </strong></td>
                            <td>{{ $grupo_r_centralizadors[0]->nro_libro ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>N&deg; FOLIO: </strong></td>
                            <td>{{ $nro_folio ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h3><strong>CENTRALIZADOR DE CALIFICACIONES</strong></h3>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-7">
                    <table>
                        <tr>
                            <td><strong>INSTITUCI&Oacute;N: </strong></td>
                            <td>{{ $empresa->nombre ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-2">
                    <table>
                        <tr>
                            <td><strong>R.M.: </strong></td>
                            <td>{{ $grupo_r_centralizadors[0]->numero_resolucion ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-3">
                    <table>
                        <tr>
                            <td><strong>TURNO: </strong></td>
                            <td>{{ $grupo_r_centralizadors[0]->nombre_turno ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12 " id="dataTable"
                        width="100%">
                        <thead style="font-size: 16px; background-color: #c5f8ff; text-align: center;">

                            {{--   <tr>
                                <th colspan="2">GESTI&Oacute;N: {{ $grupo_r_centralizadors[0]->anio_gestion ?? '-' }}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">NIVEL:
                                    {{ textoNivelPrint($grupo_r_centralizadors[0]->nivel_id ?? '-') }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">CARRERA: {{ $grupo_r_centralizadors[0]->nombre_carrera ?? '-' }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">MATERIA (CURSO):
                                    {{ textoOrdenPrint($grupo_r_centralizadors[0]->materia_gestion ?? '-') }}
                                </th>
                            </tr> --}}

                            <tr>
                                <td>GESTI&Oacute;N: {{ $grupo_r_centralizadors[0]->nombre_gestion ?? '-' }} - {{ $grupo_r_centralizadors[0]->anio_gestion ?? '-' }}
                                </td>
                                <td>NIVEL:
                                    {{ textoNivelPrint($grupo_r_centralizadors[0]->nivel_id ?? '-') }}</td>
                                <td>CARRERA: {{ $grupo_r_centralizadors[0]->nombre_carrera ?? '-' }}</td>
                                <td>MATERIA (CURSO):
                                    {{ textoOrdenPrint($grupo_r_centralizadors[0]->materia_gestion ?? '-') }}
                                    {{-- <td>CEDULA DE IDENTIDAD: {{ $grupo_r_centralizadors[0]->ci ?? '-' }}</td> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12 " id="dataTable"
                        width="100%">
                        <thead
                            style="font-size: 14px; background-color: #b2f2d4; text-align: center; font-weight: bold;">
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

                        <tbody style="font-size: 14px;">
                            @isset($grupo_r_centralizadors)
                                @php
                                    $numMaterias = count($materias);
                                    $estudiantes = collect($grupo_r_centralizadors)->groupBy('estudiante_id');
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
                                        $nro_folio++;
                                    @endphp
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mr-2">
                <div class="col-12">
                    <p>* En observaciones tomar en cuenta: Aprobado, Reprobado y Abandono.</p>
                </div>
            </div><br />
            @if (!$loop->last)
                <div class="page_break"></div>
            @else
                <div class="row mt-4">
                    <div class="col-3 text-center">
                        <p>_____________________________</p>
                        <p>FIRMA JEFE DE CARRERA</p>
                    </div>
                    <div class="col-3 text-center">
                        <p>_____________________________</p>
                        <p>FIRMA DIRECTOR ACADEMICO</p>
                    </div>
                    <div class="col-3 text-center">
                        <p>_____________________________</p>
                        <p>FIRMA RECTOR</p>
                    </div>
                    <div class="col-3 text-center">
                        <p>_____________________________</p>
                        <p>SELLO INSTITUTO</p>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</body>

</html>

@php
    function textoNivelPrint($nivel)
    {
        $nivel = (int) $nivel;

        switch ($nivel) {
            case 1:
                return 'TÉCNICO MEDIO';
                break;
            case 2:
                return 'TÉCNICO SUPERIOR';
                break;
            case 3:
                return 'LICENCIATURA';
                break;
            case 4:
                return 'MAESTRÍA';
                break;
            case 5:
                return 'DOCTORADO';
                break;
            default:
                return '';
                break;
        }
    }
    function textoOrdenPrint($orden)
    {
        $orden = (int) $orden;
        switch ($orden) {
            case 1:
                return 'PRIMER AÑO';
                break;
            case 2:
                return 'SEGUNDO AÑO';
                break;
            case 3:
                return 'TERCER AÑO';
                break;
            case 4:
                return 'CUARTO AÑO';
                break;
            case 5:
                return 'QUINTO AÑO';
                break;
            case 6:
                return 'SEXTO AÑO';
                break;
            default:
                return '';
                break;
        }
    }

@endphp
