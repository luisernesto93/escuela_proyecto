@extends('layouts.app')

@section('title', 'Detalle Carrera')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE CARRERA</h6>
        </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Código:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('codigo') is-invalid @enderror" 
                            id="codigo"
                            placeholder="Código"
                            name="codigo"
                            value="{{ old('codigo', $carrera->codigo) }}"
                            onkeypress="return event.charCode>=48 && event.charCode<=57" disabled>
                        @error('codigo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Nombre Carrera:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombre') is-invalid @enderror"
                            id="nombre"
                            placeholder="Nombre"
                            name="nombre"
                            value="{{ old('nombre', $carrera->nombre) }}"
                            disabled
                            >
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Facultad:</strong> <span style="color:red;">*</span>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('facultad_id') is-invalid @enderror"
                            id="facultad_id"
                            placeholder="Facultades"
                            name="facultad_id"
                            @if ($carrera->facultad)
                            value="{{ old('facultad_id', $carrera->facultad->descripcion ?? '') }}"
                            @endif
                            disabled>
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $carrera->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $carrera->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('carreras.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection