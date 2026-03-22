<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin/css/snappy-css.css') }}">
    <title>REPORTE-INSCRIPCI&Oacute;N</title>
</head>

<body>
    <div class="container" style="font-family: Arial, Helvetica, sans-serif;">
        <div class="row text-center">
            <div class="col-3">
                {{--  <img src="data:image/png;base64s, {{ $empresa->image1 }}" width="100" height="75"
                    alt="logo.jpg"> --}}
            </div>
            <div class="col-6">
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr style="border: 1px solid black;">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h4><strong>HISTORICO ACADEMICO</strong></h4>
            </div>
        </div>
         <div class="row mt-4">
            <div class="col-6" style="font-size: 14px;">
                <table>
                    <tr>
                        <td><strong>ESTUDIANTE: </strong></td>
                        <td>{{ $r_historicos[0]->nombre_estudiante ?? '-' }}
                            {{ $r_historicos[0]->apellido_estudiante ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>CI: </strong></td>
                        <td>{{ $r_historicos[0]->documento ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>CARRERA: </strong></td>
                        <td>{{ $r_historicos[0]->nombre_carrera ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-2" style="font-size: 14px;"></div>
            <div class="col-4 ml-4" style="font-size: 14px;">
                <table>
                    <tr>
                        <td><strong>FECHA ADMISI&Oacute;N: </strong></td>
                        <td>{{ $r_historicos[0]->fecha_admision ?? '01/01/2020' }}</td>
                    </tr>
                    <tr>
                        <td><strong>FECHA CONCLUSI&Oacute;N: </strong></td>
                        <td>{{ $r_historicos[0]->fecha_conclusion ?? '01/01/2025' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable"
                    width="100%">
                    <thead class="text-center" style="font-size: 12px; background-color: #9edde5;">
                        <tr>
                            <th>N&deg;</th>
                            <th>GESTI&Oacute;N</th>
                            <th>SEMESTRE</th>
                            <th>C&Oacute;DIGO</th>
                            <th>ASIGANTURA</th>
                            <th>PRE - REQUISITO</th>
                            <th>NOTA</th>
                            <th>P. RECUP.</th>
                            <th>OBSERVACI&Oacute;N</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px; background-color: #ffffff; border: 1px solid #000000;">
                        @isset($r_historicos)
                            @foreach ($r_historicos as $key => $r_historico)
                                <tr>
                                    <td class="p-2 align-middle">{{ $key + 1 }}</td>
                                    <td class="p-2 align-middle">{{ $r_historico->gestion }} - {{ $r_historico->anio }}
                                    </td>
                                    <td class="p-2 align-middle">{{ textoNivel($r_historico->nivel ?? '-') }}</td>
                                    <td class="p-2 align-middle">{{ $r_historico->sigla ?? '-' }}</td>
                                    <td class="p-2 align-middle">{{ $r_historico->nombre_materia ?? '-' }}</td>
                                    <td class="p-2 align-middle">{{ $r_historico->nombre_materia_prerequisito ?? '-' }}
                                    </td>
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
        <div class="row mt-4">
            <div class="col-12">
                <p><strong>Lugar y Fecha: </strong>{{ $empresa->ciudad ?? 'Santa Cruz de la Sierra' }},
                    {{ now()->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-12 text-center" style="font-size: 12px;">
                <p>Firma de Autoridad Acad&eacute;mica</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-4" style="font-size: 12px;">
                <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead class="text-center" style="font-size: 12px; background-color: #9edde5;">
                        <tr>
                            <th colspan="2">ESCALA DE VALORACI&Oacute;N</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px; background-color: #ffffff; border: 1px solid #000000;">
                        <tr>
                            <td>61 - 100</td>
                            <td>APROBADO</td>
                        </tr>
                        <tr>
                            <td>0 - 60</td>
                            <td>REPROBADO</td>
                        </tr>
                        <tr>
                            <td>61</td>
                            <td>NOTA M&Iacute;NIMA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4" style="font-size: 12px;">

            </div>

            <div class="col-4" style="font-size: 12px;">
                <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead class="text-center" style="font-size: 12px; background-color: #9edde5;">
                        <tr>
                            <th colspan="2">DATOS GENENERALES</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px; background-color: #ffffff; border: 1px solid #000000;">
                        <tr>
                            <td>CARGA HORARIA</td>
                            <td>{{ $r_historicos[0]->carga_horaria ?? '3600' }} Hrs.</td>
                        </tr>
                        <tr>
                            <td>ASIGNATURAS APROBADAS</td>
                            <td>{{ $r_historicos[0]->aprobadas ?? '30/30' }}</td>
                        </tr>
                        <tr>
                            <td>PROMEDIO DE CALIFICACIONES</td>
                            <td>{{ $r_historicos[0]->promedio ?? '100' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table-sm table-striped table-bordered shadow fs-12" id="dataTable" width="100%">
                    <thead class="text-center" style="font-size: 12px;">
                        <tr>
                            <th>Cualquier raspadura o enmienda invalida el presente documento</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

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
