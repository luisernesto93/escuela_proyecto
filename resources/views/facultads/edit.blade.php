@extends('layouts.app')

@section('title', 'Editar Plazo Inscripciones')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR FACULTAD</h6>
        </div>
        <form method="POST" action="{{route('facultads.update', ['facultad' => $facultad->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        DESCRIPCI&Oacute;N: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="DESCRIPCI&oacute;N"
                            name="descripcion"
                            value="{{ old('descripcion', $facultad->descripcion) }}"
                            required>
                        @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span</label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado"
                        required>
                            <option value="1" {{ old('estado', $facultad->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $facultad->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('facultads.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>
</div>

@endsection