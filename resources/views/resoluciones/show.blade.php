@extends('layouts.app')

@section('title', 'Detalle Resolucion')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE RESOLUCION</h6>
        </div>
        <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>N&uacute;mero Resolucion:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('numero_resolucion') is-invalid @enderror"
                            id="numero_resolucion"
                            placeholder="Nombres"
                            name="numero_resolucion"
                            value="{{ old('numero_resolucion', $resolucion->numero_resolucion) }}"
                            disabled>
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Gestion</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                            id="gestion_id"
                            placeholder="Gestion"
                            name="gestion_id"
                            value="{{ old('gestion_id', $resolucion->gestion->descripcion .'-'. $resolucion->gestion->anio ?? '') }}"disabled>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Carrera</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('carrera_id') is-invalid @enderror"
                            id="carrera_id"
                            placeholder="Carrera"
                            name="carrera_id"
                            value="{{ old('carrera_id', $resolucion->carrera->nombre ?? '') }}"disabled>
                        @error('carrera_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $resolucion->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $resolucion->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
            </div>
        </div>

        <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('resoluciones.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
        </div>
    </div>

</div>

@endsection