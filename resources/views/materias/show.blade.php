@extends('layouts.app')

@section('title', 'Detalle Materia')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE MATERIA</h6>
        </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Id:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('id') is-invalid @enderror"
                            id="id"
                            placeholder="Id"
                            name="id"
                            value="{{ old('id', $materia->id) }}"
                            disabled
                            >
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Plan de Estudios:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('plan_estudio_id') is-invalid @enderror"
                            id="plan_estudio_id"
                            placeholder="Plan de Estudio"
                            name="plan_estudio_id"
                            value="{{ old('plan_estudio_id', $materia->plan_estudio->area_formacion) }}"
                            disabled
                            >
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Carrera</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('carrera_id') is-invalid @enderror"
                            id="carrera_id"
                            placeholder="Carrera"
                            name="carrera_id"
                            value="{{ old('carrera_id', $materia->carrera->nombre) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" disabled>
                        @error('carrera_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Sigla:</strong><span style="color:red;">*</span>
                        <input
                        type="text"
                        class="form-control form-control-sm @error('sigla') is-invalid @enderror"
                        id='sigla'
                        name="sigla"
                        placeholder="Sigla"
                            value= "{{ old('sigla', $materia->sigla)}}"
                        disabled>
                        @error('sigla')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Materia:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombre_materia') is-invalid @enderror" 
                            id="nombre_materia"
                            placeholder="Materia"
                            name="nombre_materia"
                            value="{{ old('nombre_materia', $materia->nombre_materia) }}"
                            onkeypress="return event.charCode>=48 && event.charCode<=57" disabled>
                        @error('nombre_materia')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Horas:</strong><span style="color:red;">*</span></label>
                        <input
                        type="text"
                        class="form-control form-control-sm @error('horas') is-invalid @enderror"
                        id="horas"
                        placeholder="Horas"
                        name="horas"
                        value= "{{ old('horas', $materia->horas)}}"
                        disabled>
                    @error('horas')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nivel</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nivel') is-invalid @enderror"
                            id="nivel"
                            placeholder="Nivel"
                            name="nivel"
                            value="{{ old('nivel', $materia->nivel) }}"disabled>
                        @error('nivel')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Grado</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('orden') is-invalid @enderror"
                            id="orden"
                            placeholder="Grado"
                            name="orden"
                            value="{{ old('orden', $materia->orden) }}"disabled>
                        @error('orden')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $materia->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $materia->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('materias.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection