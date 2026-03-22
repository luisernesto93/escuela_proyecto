@extends('layouts.app')

@section('title', 'Editar Docente')

@section('content')

<div class="container-fluid">
    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR DOCENTE</h6>
        </div>
        <form method="POST" action="{{route('docentes.update', ['docente' => $docente->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Documento:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('documento') is-invalid @enderror"
                            id="documento"
                            placeholder="Documento"
                            name="documento"
                            value="{{ old('documento', $docente->documento) }}"
                            onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                        @error('documento')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Apellidos</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('apellidos') is-invalid @enderror"
                            id="apellidos"
                            placeholder="Apellidos"
                            name="apellidos"
                            value="{{ old('apellidos', $docente->apellidos) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" required>
                        @error('apellidos')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Nombres:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombres') is-invalid @enderror"
                            id="nombres"
                            placeholder="Nombres"
                            name="nombres"
                            value="{{ old('nombres', $docente->nombres) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" required>
                        @error('nombres')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>C&oacute;digo Interno:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('codigo_interno') is-invalid @enderror"
                            id="codigo_interno"
                            placeholder="C&oacute;digo Interno"
                            name="codigo_interno"
                            value="{{ old('codigo_interno', $docente->codigo_interno) }}" required>
                        @error('codigo_interno')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Celular:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('telefono') is-invalid @enderror"
                            id="celular"
                            placeholder="Nro Celular"
                            name="telefono"
                            value="{{ old('telefono', $docente->telefono) }}" required>
                        @error('telefono')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Fecha de Registro:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('fecha_registro') is-invalid @enderror"
                            id="fecha_registro"
                            placeholder="Fecha de Registro"
                            name="fecha_registro"
                            value="{{ old('fecha_registro', $docente->fecha_registro) }}" required>
                        @error('fecha_registro')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" required>
                            <option value="1" {{ old('estado', $docente->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $docente->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Observaciones:</strong></label>
                        <textarea
                            class="form-control form-control-sm @error('observaciones') is-invalid @enderror"
                            placeholder="Observaciones"
                            name="observaciones"
                            value="{{ old('observaciones', $docente->observaciones) }}"
                            rows="2">
                        </textarea>
                        @error('observaciones')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('docentes.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>

@endsection