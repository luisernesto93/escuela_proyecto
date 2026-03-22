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
    <div class="container" style="font-family: Courier, monospace;">
        <div class="row text-center">
            <div class="col-3">
                {{--  <img src="data:image/png;base64s, {{ $empresa->image1 }}" width="100" height="75"
                    alt="logo.jpg"> --}}
            </div>
            <div class="col-6">
                <h4>{{ $empresa->nombre ?? '-' }}</h4>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <hr style="border: 1px solid black;">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h4 style="text-decoration: underline;">FORMULARIO DE INSCRIPCI&Oacute;N</h4>
            </div>
        </div>
        <div class="row mt-2">
            A. <strong>DATOS DE INSCRIPCI&Oacute;N</strong>
        </div>
        <div class="row">
            <div class="col-6">
                <table>
                    <tr>
                        <td>Matricula: </td>
                        <td><strong>{{ $inscripcions->id ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>Carrera: </td>
                        <td><strong>{{ $inscripcions->carrera->nombre ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>Turno: </td>
                        <td><strong>{{ $inscripcions->nombre_turno ?? '' }}</strong>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <tr>
                        <td>Gesti&oacute;n: </td>
                        <td><strong>{{ $inscripcions->gestion->descripcion ?? '-' }}-{{ $inscripcions->gestion->anio ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>Nivel: </td>
                        <td><strong>{{ $inscripcions->nombre_nivel ?? '1MER SEMESTRE' }}</strong>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            B. <strong>DATOS DEL ESTUDIANTE</strong>
        </div>
        <div class="row">
            <div class="col-6">
                <table>
                    <tr>
                        <td>Apellidos: </td>
                        <td><strong>{{ $inscripcions->estudiante->apellidos ?? '' }}</strong>
                    </tr>
                    <tr>
                        <td>Nombres: </td>
                        <td><strong>{{ $inscripcions->estudiante->nombres ?? '' }}</strong>
                    </tr>
                    <tr>
                        <td>Documento: </td>
                        <td><strong>{{ $inscripcions->estudiante->documento ?? '' }}
                                {{ $inscripcions->estudiante->expedicion_ci->sigla ?? '' }}</strong>
                    </tr>
                    <tr>
                        <td>Genero: </td>
                        <td><strong>{{ $inscripcions->estudiante->genero->genero ?? '' }}</strong>
                    </tr>
                    <tr>
                        <td>Fecha de Nacimiento: </td>
                        <td><strong>{{ $inscripcions->estudiante->fecha_nacimiento ?? '' }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <tr>
                        <td>Departamento: </td>
                        <td><strong>{{ $inscripcions->estudiante->localidad->provincia->departamento->nombre ?? '' }}</strong>
                    </tr>
                    <tr>
                        <td>Localidad: </td>
                        <td><strong>{{ $inscripcions->estudiante->localidad->nombre ?? '' }}</strong>
                    </tr>
                    <tr>
                        <td>Provincia: </td>
                        <td><strong>{{ $inscripcions->estudiante->localidad->provincia->nombre ?? '' }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            C. <strong>DATOS DEL T&Iacute;TULO DE BACHILLER</strong>
        </div>
        <div class="row">
            <div class="col-4">
                <table>
                    <tr>
                        <td>Serie: </td>
                        <td><strong>{{ $inscripcions->serie ?? '-' }}
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>N&uacute;mero: </td>
                        <td><strong>{{ $inscripcions->numero ?? '-' }}
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>Emisi&Oacute;n: </td>
                        <td><strong>{{ $inscripcions->emision ?? '-' }}</strong>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            D. <strong>DATOS DEL T&Iacute;TULO DE BACHILLER</strong>
        </div>
        <div class="row">
            <div class="col-6">
                <table>
                    <tr>
                        <td>Domicilio actual: </td>
                        <td><strong>{{ $inscripcions->estudiante->direccion ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>Tel&eacute;fono Fijo: </td>
                        <td><strong>{{ $inscripcions->estudiante->telefono ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>Correo Electr&oacute;nico: </td>
                        <td><strong>{{ $inscripcions->estudiante->correo ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>Ref. Nombre: </td>
                        <td><strong>{{ $inscripcions->estudiante->nombre_referencia ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>{{ 'Santa Cruz, ' }}<strong>{{ date('d') }}</strong>{{ ' de ' }}<strong>{{ date('F') }}</strong>{{ ' de ' }}<strong>{{ date('Y') }}</strong>
                        </td>
                    </tr>
                </table>
                <table class="text-center mt-2">
                    <tr>
                        <td>-----------------------------</td>
                    </tr>
                    <tr>
                        <td>Nombre y Firma - Estudiante</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <br />
                    <tr>
                        <td>Celular: </td>
                        <td><strong>{{ $inscripcions->estudiante->celular ?? '-' }}</strong>
                    </tr>
                    <tr>
                        <td>
                            <br />
                        </td>
                    </tr>
                    <tr>
                        <td>Ref. Tel&eacute;fono: </td>
                        <td><strong>{{ $inscripcions->estudiante->telefono_referencia ?? '-' }}</strong>
                    </tr>
                </table>
                <table class="text-center mt-4">
                    <tr>
                        <td><strong>{{ $inscripcions->estudiante->nombre_referencia ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td>Nombre y Firma - Inscribi&oacute;</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            E. <strong>VERIFICACI&Oacute;N DE REQUISITOS</strong>
        </div>
        <div class="row">
            <div class="col-12">
                <table>
                    <tr>
                        <td>1. Folder Colgante Verde
                            [<strong>{{ $estado_verificacions->folder_estado == 1 ? 'SI' : 'NO' }}</strong>]
                        </td>
                    </tr>
                    <tr>
                        <td>2. Fotograf&iacute;as 3 x 3 Fondo Celeste
                            [<strong>{{ $estado_verificacions->foto_estado == 1 ? 'SI' : 'NO' }}</strong>]
                        </td>
                    </tr>
                    <tr>
                        <td>3. Fotocop&iacute;a del T&iacute;tulo de Bachiller
                            [<strong>{{ $estado_verificacions->compromiso_titulo == 1 ? 'SI' : 'NO' }}</strong>]
                        </td>
                    </tr>
                    <tr>
                        <td>4. Fotocop&iacute;a del Carnet de Identidad
                            [<strong>{{ $estado_verificacions->ci_estado == 1 ? 'SI' : 'NO' }}</strong>]
                        </td>
                    </tr>
                    <tr>
                        <td>5. Fotocop&iacute;a del Certif&iacute;cado de Nacimiento
                            [<strong>{{ $estado_verificacions->certificado_estado == 1 ? 'SI' : 'NO' }}</strong>]
                        </td>
                    </tr>
                    <tr>
                        <td>6. Pago Aporte Voluntario
                            [<strong>{{ $estado_verificacions->certificado_estado == 1 ? 'SI' : 'NO' }}</strong>]
                        </td>
                    </tr>
                    <tr>
                        <td>7. Glosa o Nro. Comprobante </td>

                        <td> [<strong>{{ $inscripcions->modalidad_pagos->descripcion ?? '-' }}
                                {{ $inscripcions->modalidad_pagos->monto_pagar ?? '-' }} Bs.]</strong>

                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <hr style="border: 1px solid black;">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <strong>{{ $empresa->nombre ?? '-' }} - {{ $empresa->telefono ?? '-' }}</strong>
            </div>
        </div>
    </div>
</body>

</html>
