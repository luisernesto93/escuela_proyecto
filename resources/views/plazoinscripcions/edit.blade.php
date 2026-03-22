@extends('layouts.app')

@section('title', 'Editar Plazo Inscripciones')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR PLAZO INSCRIPCIONES</h6>
        </div>
        <form method="POST" action="{{route('plazoinscripcions.update', ['plazoinscripcion' => $plazoinscripcion->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha inicio:</strong> <span style="color:red;">*</span></label>
                        <input type="datetime-local" class="form-control form-control-sm @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" placeholder="Fecha inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $plazoinscripcion->fecha_inicio ?? '') }}"
                        required>
                        @error('fecha_inicio')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Límite: </strong><span style="color:red;">*</span></label>
                        <input type="datetime-local" class="form-control form-control-sm @error('fecha_limite') is-invalid @enderror" placeholder="fecha_limite" name="fecha_limite" value="{{ old('fecha_limite', $plazoinscripcion->fecha_limite) }}"
                        required>
                        </input>
                        @error('fecha_limite')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Seleccione Gesti&oacute;n: </strong><span style="color:red;">*</span>
                        <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror" name="gestion_id" id="estado"
                        required>
                            @foreach ($gestiones as $gestion)
                            <option value="{{$gestion->id}}" {{ old('gestion_id', $plazoinscripcion->gestion_id) == $gestion->id ? 'selected' : '' }}>{{$gestion->descripcion.' - '.$gestion->anio}}</option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span</label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado"
                        required>
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
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('plazoinscripcions.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>
</div>

@endsection