@extends('layouts.app')

@section('title', 'Mostrar Inscripciones')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE INSCRIPCIONES</h6>
        </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Inicio:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('fecha_inicio') is-invalid @enderror"
                            id="exampleLastName"
                            placeholder="Fecha_inicio"
                            name="fecha_inicio"
                            value="{{ old('fecha_inicio', $plazoinscripcion->fecha_inicio) }}"
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Límite:</strong> <span style="color:red;">*</span></label>
                        <input
                            class="form-control form-control-sm @error('fecha_limite') is-invalid @enderror"
                            placeholder="Fecha_limite"
                            name="fecha_limite"
                            value="{{ old('fecha_limite', $plazoinscripcion->fecha_limite) }}"
                            rows="2"
                        disabled>
                        @error('fecha_limite')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n:</strong> <span style="color:red;">*</span>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                            id="gestion_id"
                            placeholder="Gesti&oacute;n"
                            name="gestion_id"
                            @if ($plazoinscripcion->gestion)
                            value="{{ old('gestion_id', $plazoinscripcion->gestion->descripcion ?? '') }}"
                            @endif
                            disabled>
                    </div>
                    {{-- <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n: </strong> <span style="color:red;">*</span>
                        <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror" name="gestion_id" disabled>
                            @foreach ($gestiones as $gestion)
                            <option value="{{$gestion->id}}" {{ old('gestion_id', $plazoinscripcion->gestion_id) == $gestion->id ? 'selected' : '' }}>{{$gestion->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> --}}
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span</label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $plazoinscripcion->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $plazoinscripcion->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('plazoinscripcions.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection