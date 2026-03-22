@extends('layouts.app')

@section('title', 'Nueva Inscripción')

@section('content')

    <div class="container-fluid">
        {{-- alertas --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i>
                    REGISTRAR INSCRIPCI&Oacute;N</h6>
            </div>
            <form method="POST" action="{{ route('inscripciones.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>ESTUDIANTE: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                                name="estudiante_id" required>
                                <option value="" selected>Seleccione un estudiante</option>
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}"
                                        {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->nombres }}
                                        {{ $estudiante->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>GESTI&Oacute;N: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                                name="gestion_id" required>
                                <option value="">Seleccione una gesti&oacute;n</option>
                                @foreach ($gestiones as $gestion)
                                    <option value="{{ $gestion->id }}"
                                        {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>
                                        {{ $gestion->descripcion }} - {{ $gestion->anio }}</option>
                                @endforeach
                            </select>
                            @error('gestion_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>BECA: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('beca_id') is-invalid @enderror"
                                name="beca_id" required>
                                <option value="">Seleccione Beca</option>
                                @foreach ($becas as $beca)
                                    <option value="{{ $beca->id }}"
                                        {{ old('beca_id') == $beca->id ? 'selected' : '' }}>{{ $beca->descripcion }} =>
                                        {{ $beca->porcentaje }}</option>
                                @endforeach
                            </select>
                            @error('beca_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>CARRERA: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('categoria_id') is-invalid @enderror"
                                name="carrera_id" required>
                                <option value="">Seleccione una categor&iacute;a</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ old('carrrera_id') == $carrera->id ? 'selected' : '' }}>{{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>TURNO: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('turno_id') is-invalid @enderror"
                                name="turno_id" required>
                                <option value="" selected>Seleccione un Turno</option>
                                @foreach ($turnos as $turno)
                                    <option value="{{ $turno->id }}"
                                        {{ old('turno_id') == $turno->id ? 'selected' : '' }}>{{ $turno->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('turno_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>CANAL PUBLICITARIO: </strong> <span style="color:red;">*</span></label>
                            <select
                                class="form-control form-control-sm @error('canal_publicitario_id') is-invalid @enderror"
                                name="canal_publicitario_id" required>
                                <option value="">Seleccione el canal_publicitario</option>
                                @foreach ($canal_publicitarios as $canal_publicitario)
                                    <option value="{{ $canal_publicitario->id }}"
                                        {{ old('canal_publicitario_id') == $canal_publicitario->id ? 'selected' : '' }}>
                                        {{ $canal_publicitario->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('canal_publicitario_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>MOD. DE PAGO: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('modalidad_pago_id') is-invalid @enderror"
                                name="modalidad_pago_id" required>
                                <option value="">Seleccione una modalidad de pago</option>
                                @foreach ($modalidad_pagos as $modalidad_pago)
                                    <option value="{{ $modalidad_pago->id }}"
                                        {{ old('modalidad_pago_id') == $modalidad_pago->id ? 'selected' : '' }}>
                                        {{ $modalidad_pago->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('modalidad_pago_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>NRO. DEPOSITO:</strong><span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('nro_deposito_glosa') is-invalid @enderror"
                                id="nro_deposito_glosa" placeholder="Nro de Dep&oacute;sito" name="nro_deposito_glosa"
                                value="{{ old('nro_deposito_glosa') }}" required>
                            @error('nro_deposito_glosa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>COMPROMISO TITULO?: </strong> <span style="color:red;">*</span>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="compromiso_titulo" value="1"
                                        {{ old('compromiso_titulo') == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="compromiso_titulo" value="0"
                                        {{ old('compromiso_titulo') == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>CI. PRESENTADO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="ci_estado" value="1"
                                        {{ old('ci_estado') == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="ci_estado" value="0"
                                        {{ old('ci_estado') == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>FOTO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="foto_estado" value="1"
                                        {{ old('foto_estado') == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="foto_estado" value="0"
                                        {{ old('foto_estado') == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>FOLDER?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="folder_estado" value="1"
                                        {{ old('folder_estado') == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="folder_estado" value="0"
                                        {{ old('folder_estado') == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>CERTIFICADO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="certificado_estado" value="1"
                                        {{ old('certificado_estado') == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="certificado_estado" value="0"
                                        {{ old('certificado_estado') == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>ADQUIRI&Oacute; EL FOLDER?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="pago_folder_estado" value="1"
                                        {{ old('pago_folder_estado') == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="pago_folder_estado" value="0"
                                        {{ old('pago_folder_estado') == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i
                            class="fas fa-save"></i> GUARDAR</button>
                    <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('inscripciones.index') }}"><i
                            class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
                </div>
            </form>
        </div>

    </div>
@endsection
