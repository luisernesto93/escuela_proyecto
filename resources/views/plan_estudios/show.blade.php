@extends('layouts.app')

@section('title', 'Mostrar Inscripciones')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE PLAN DE ESTUDIOS</h6>
        </div>
        <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Resoluciones:</strong> <span style="color:red;">*</span>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('resolucion_id') is-invalid @enderror"
                            id="resolucion_id"
                            placeholder="Resoluciones"
                            name="resolucion_id"
                            @if ($plan_estudio->resolucion)
                            value="{{ old('resolucion_id', $plan_estudio->resolucion->numero_resolucion ?? '') }}"
                            @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>&Aacute;rea formaci&oacute;n: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('area_formacion') is-invalid @enderror"
                            id="area_formacion"
                            placeholder="&Aacute;rea formaci&oacute;n"
                            name="area_formacion"
                            value="{{ old('area_formacion', $plan_estudio->area_formacion) }}"
                            disabled>
                        @error('area_formacion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- fecha limite --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Horas Semanales: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('horas_semanales') is-invalid @enderror"
                            id="horas_semanales"
                            placeholder="horas_semanales"
                            name="horas_semanales"
                            value="{{ old('horas_semanales', $plan_estudio->horas_semanales) }}"
                            disabled>

                        @error('horas_semanales')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Horas mes: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('horas_mes') is-invalid @enderror"
                            id="horas_mes"
                            placeholder="horas_mes"
                            name="horas_mes"
                            value="{{ old('horas_mes', $plan_estudio->horas_mes) }}"
                            disabled>
                        @error('horas_semanales')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Horas Gesti&oacute;n: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('horas_gestion') is-invalid @enderror"
                            id="horas_gestion"
                            placeholder="horas Gestión"
                            name="horas_gestion"
                            value="{{ old('horas_gestion', $plan_estudio->horas_gestion) }}"
                            disabled>

                        @error('horas_gestion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Carga Horaria: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('carga_horaria') is-invalid @enderror"
                            id="carga_horaria"
                            placeholder="carga_horaria"
                            name="carga_horaria"
                            value="{{ old('carga_horaria', $plan_estudio->carga_horaria) }}"
                            disabled>

                        @error('carga_horaria')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $plan_estudio->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $plan_estudio->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('plan_estudios.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>
</div>

@endsection