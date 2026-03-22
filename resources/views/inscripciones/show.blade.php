@extends('layouts.app')

@section('title', 'Editar Inscripcion')

@section('content')

    <div class="container-fluid">

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE INSCRIPCIÓN</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    {{-- @php
                        dd($inscripcion);
                    @endphp --}}
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Id:</strong><span style="color:red;">*</span>
                        <input type="text" class="form-control form-control-sm @error('id') is-invalid @enderror"
                            placeholder="id" name="id" value="{{ old('id', $inscripcion->id) }}" disabled>
                        @error('id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Inscripción:</strong> <span style="color:red;">*</span>
                        <input type="datetime-local"
                            class="form-control form-control-sm @error('fecha_inscripcion') is-invalid @enderror"
                            id="fecha_inscripcion" placeholder="Fecha Inscripción" name="fecha_inscripcion"
                            value="{{ old('fecha_inscripcion', $inscripcion->fecha_inscripcion) }}" disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n:</strong> <span style="color:red;">*</span>
                        <input type="text"
                            class="form-control form-control-sm @error('categoria_id') is-invalid @enderror" id="gestion_id"
                            placeholder="Gesti&oacute;n" name="gestion_id"
                            @if ($inscripcion->gestion) value="{{ old('gestion_id', $inscripcion->gestion->descripcion ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Turno:</strong> <span style="color:red;">*</span>
                        <input type="text" class="form-control form-control-sm @error('turno_id') is-invalid @enderror"
                            id="turno_id" placeholder="Turno" name="turno_id"
                            @if ($inscripcion->turno) value="{{ old('turno_id', $inscripcion->turno->descripcion ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Carrera:</strong> <span style="color:red;">*</span>
                        <input type="text" class="form-control form-control-sm @error('carreras') is-invalid @enderror"
                            id="carreras" placeholder="Carreras" name="carreras"
                            @foreach ($carreras as $carrera)
                            @if ($carrera->id == $inscripcion->carrera_id)
                            value="{{ old('carreras', $carrera->nombre ?? '') }}"
                            @endif @endforeach
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nombres:</strong> <span style="color:red;">*</span>
                        <input type="text" class="form-control form-control-sm @error('nombres') is-invalid @enderror"
                            id="nombres" placeholder="Nombres" name="nombres"
                            @if ($inscripcion->estudiante) value="{{ old('nombres', $inscripcion->estudiante->nombres ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Apellidos:</strong> <span style="color:red;">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('apellidos') is-invalid @enderror"
                            id="apellidos" placeholder="Apellidos" name="apellidos"
                            @if ($inscripcion->estudiante) value="{{ old('apellidos', $inscripcion->estudiante->apellidos ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Inscriptor:</strong> <span style="color:red;">*</span>
                        <input type="text"
                            class="form-control form-control-sm @error('nombre_inscriptor') is-invalid @enderror"
                            id="nombre_inscriptor" placeholder="Inscriptor" name="nombre_inscriptor"
                            value="{{ old('nombre_inscriptor', $inscripcion->nombre_inscriptor) }}" disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Beca:</strong> <span style="color:red;">*</span>
                        <input type="text" class="form-control form-control-sm @error('beca_id') is-invalid @enderror"
                            id="beca_id" placeholder="¿Es becado ?" name="beca_id"
                            @if ($inscripcion->beca) value="{{ old('beca_id', $inscripcion->beca->descripcion ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Modalidad Pago:</strong><span style="color:red;">*</span>
                        <input type="text"
                            class="form-control form-control-sm @error('modalidad_pago_id') is-invalid @enderror"
                            id="modalidad_pago_id" placeholder="Modalidad Pago" name="modalidad_pago_id"
                            @if ($inscripcion->modalidad_pago) value="{{ old('modalidad_pago_id', $inscripcion->modalidad_pago->descripcion ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nro. Dep&oacute;sito:</strong> <span style="color:red;">*</span></label>
                        <input type="text"
                            class="form-control form-control-sm @error('nro_deposito_glosa') is-invalid @enderror"
                            id="nro_deposito_glosa" placeholder="Nro. de Dep&oacute;sito" name="nro_deposito_glosa"
                            value="{{ old('nro_deposito_glosa', $inscripcion->nro_deposito_glosa) }}" disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Canal Publicitario:</strong><span style="color:red;">*</span>
                        <input type="text"
                            class="form-control form-control-sm @error('canal_publicitario_id') is-invalid @enderror"
                            id="canal_publicitario_id" placeholder="Canal Publicitario" name="canal_publicitario_id"
                            @if ($inscripcion->canal_publicitario) value="{{ old('canal_publicitario_id', $inscripcion->canal_publicitario->descripcion ?? '') }}" @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado"
                            disabled>
                            <option value="1" {{ old('estado', $inscripcion->estado) == 1 ? 'selected' : '' }}>ACTIVO
                            </option>
                            <option value="0" {{ old('estado', $inscripcion->estado) == 0 ? 'selected' : '' }}>
                                INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('inscripciones.index') }}"><i
                        class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
        </div>

    </div>

@endsection
