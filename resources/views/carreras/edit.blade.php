@extends('layouts.app')

@section('title', 'Editar Carrera')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR CARRERA</h6>
        </div>
        <form method="POST" action="{{route('carreras.update', ['carrera' => $carrera->id])}}">
            @csrf
            @method('PUT')
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
                            onkeypress="return event.charCode>=48 && event.charCode<=57">
                        @error('codigo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nombre:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombre') is-invalid @enderror"
                            id="nombre"
                            placeholder="Nombre"
                            name="nombre"
                            value="{{ old('nombre', $carrera->nombre) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    {{--   <label for="facultad_id"> --}}<strong>Facultad: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('facultad_id') is-invalid @enderror" name="facultad_id" id="facultad_id"
                        required>
                            <option value="" selected>Seleccione la Factultad</option>
                            @foreach ($facultades as $facultad)
                                <option value="{{$facultad->id}}" {{ old('facultad_id', $carrera->facultad_id) == $facultad->id ? 'selected' : ''}} >{{$facultad->descripcion}}</option>
                            @endforeach
                        </select>
                        @error('facultad_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado">
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
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('carreras.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>
@endsection