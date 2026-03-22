@extends('layouts.app')

@section('title', 'Editar Inscripciones')

@section('content')

    <div class="container-fluid">

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR INSCRIPCIONES</h6>
            </div>
            <form method="POST" action="{{ route('inscripciones.update', ['inscripcione' => $inscripcion->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Fecha Inscripción:</strong> <span style="color:red;">*</span></label>
                            <input type="datetime-local"
                                class="form-control form-control-sm @error('fecha_inscripcion') is-invalid @enderror"
                                id="fecha_inscripcion" placeholder="Fecha Inscripci&oacute;n" name="fecha_inscripcion"
                                value="{{ old('fecha_inscripcion', $inscripcion->fecha_inscripcion) }}" required>
                            @error('fecha_inscripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Gesti&oacute;n:</strong><span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                                name="gestion_id" required>
                                @foreach ($gestiones as $gestion)
                                    <option value="{{ $gestion->id }}"
                                        {{ old('gestion_id', $inscripcion->gestion_id) == $gestion->id ? 'selected' : '' }}>
                                        {{ $gestion->descripcion }} - {{ $gestion->anio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gestion_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-sm-3 mb-3 mt-3">
                            <strong>Id Estudiante:</strong></label>
                            <input type="text"
                                class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                                placeholder="estudiante_id" name="estudiante_id"
                                value="{{ old('estudiante_id', $inscripcion->estudiante_id) }}">
                            @error('estudiante_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Turno: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('turno_id') is-invalid @enderror"
                                name="turno_id" required>
                                <strong>Seleccione una categor&iacute;a</strong><span style="color:red;">*</span>
                                @foreach ($turnos as $turno)
                                    <option value="{{ $turno->id }}"
                                        {{ old('turno_id', $inscripcion->turno_id) == $turno->id ? ' selected' : '' }}>
                                        {{ $turno->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('turno_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Categor&iacute;a: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('carrera_id') is-invalid @enderror"
                                name="carrera_id" required>
                                <strong>Categor&iacute;a</strong><span style="color:red;">*</span>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ old('carrera_id', $inscripcion->carrera_id) == $carrera->id ? ' selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Nombres: </strong> <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                                name="estudiante_id" required>
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}"
                                        {{ old('estudiante_id', $inscripcion->estudiante_id) == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->nombres . ' ' . $estudiante->apellidos }}</option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Inscriptor:</strong><span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('nombre_inscriptor') is-invalid @enderror"
                                id="nombre_inscriptor" placeholder="nombre_inscriptor" name="nombre_inscriptor"
                                value="{{ old('nombre_inscriptor', $inscripcion->nombre_inscriptor) }}" disabled>
                            @error('nombre_inscriptor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="col-sm-3 mb-3 mt-3">
                                <strong>Beca:</strong><span style="color:red;">*</span></label>
                                <select class="form-control form-control-sm @error('beca_id') is-invalid @enderror"
                                    name="beca_id" required>
                                    @foreach ($becas as $beca)
                                        <option value="{{ $beca->id }}"
                                            {{ old('beca_id', $inscripcion->beca_id) == $beca->id ? 'selected' : '' }}>
                                            {{ $beca->descripcion }} =>
                                            {{ $beca->porcentaje }}%
                                        </option>
                                    @endforeach
                                </select>
                                @error('beca_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3 mt-3">
                                <strong>Modalidad de Pago:</strong><span style="color:red;">*</span></label>
                                <select
                                    class="form-control form-control-sm @error('modalidad_pago_id') is-invalid @enderror"
                                    name="modalidad_pago_id" required>
                                    @foreach ($modalidades_pago as $modalidad_pago)
                                        <option value="{{ $modalidad_pago->id }}"
                                            {{ old('modalidad_pago_id', $inscripcion->modalidad_pago_id) == $modalidad_pago->id ? 'selected' : '' }}>
                                            {{ $modalidad_pago->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('modalidad_pago_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3 mt-3">
                                <strong>Nro de Dep&oacute;sito:</strong><span style="color:red;">*</span></label>
                                <input type="text"
                                    class="form-control form-control-sm @error('nro_deposito_glosa') is-invalid @enderror"
                                    id="nro_deposito_glosa" placeholder="Nro de Dep&oacute;sito" name="nro_deposito_glosa"
                                    value="{{ old('nro_deposito_glosa', $inscripcion->nro_deposito_glosa) }}" required>
                                @error('nro_deposito_glosa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3 mt-3">
                                <strong>Canal Publicitario:</strong><span style="color:red;">*</span></label>
                                <select
                                    class="form-control form-control-sm @error('canal_publicitario_id') is-invalid @enderror"
                                    name="canal_publicitario_id" required>
                                    @foreach ($canales_publicitarios as $canal_publicitario)
                                        <option value="{{ $canal_publicitario->id }}"
                                            {{ old('canal_publicitario_id', $inscripcion->canal_publicitario_id) == $canal_publicitario->id ? 'selected' : '' }}>
                                            {{ $canal_publicitario->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('canal_publicitario_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3 mt-3">
                                <strong>Estado:</strong> <span style="color:red;">*</span></label>
                                <select class="form-control form-control-sm @error('estado') is-invalid @enderror"
                                    name="estado" required>
                                    <option value="1"
                                        {{ old('estado', $inscripcion->estado) == 1 ? 'selected' : '' }}>
                                        ACTIVO</option>
                                    <option value="0"
                                        {{ old('estado', $inscripcion->estado) == 0 ? 'selected' : '' }}>
                                        INACTIVO</option>
                                </select>
                                @error('estado')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i
                                class="fas fa-save"></i> ACTUALIZAR</button>
                        <a class="btn btn-outline-danger float-right mr-3 mb-3"
                            href="{{ route('inscripciones.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
                    </div>
            </form>
        </div>
    </div>

@endsection
