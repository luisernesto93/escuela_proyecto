@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR ESTUDIANTE</h6>
        </div>
        <form method="POST" action="{{route('estudiantes.update', ['estudiante' => $estudiante->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nombres:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombres') is-invalid @enderror"
                            id="nombres"
                            placeholder="Nombres"
                            name="nombres"
                            value="{{ old('nombres', $estudiante->nombres) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" required>
                        @error('nombres')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Apellidos</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('apellidos') is-invalid @enderror"
                            id="apellidos"
                            placeholder="Apellidos"
                            name="apellidos"
                            value="{{ old('apellidos', $estudiante->apellidos) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" required>
                        @error('apellidos')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>G&eacute;nero:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('genero_id') is-invalid @enderror" name="genero_id" id="genero_id" required>
                            {{-- <option value="" selected>Seleccione el g&eacute;nero</option> --}}
                            @foreach ($generos as $genero)
                            <option value="{{$genero->id}}" {{ old('genero_id', $estudiante->genero_id) == $genero->id ? 'selected' : ''}}> {{$genero->genero}} </option>
                            @endforeach
                        </select>
                        @error('genero_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Nacimiento:</strong><span style="color:red;">*</span>
                        <input
                            type="date"
                            class="form-control form-control-sm @error('fecha_nacimiento') is-invalid @enderror"
                            id="fecha_nacimiento"
                            placeholder="Fecha Nacimiento:"
                            name="fecha_nacimiento"
                            value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}"
                            {{-- onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"--}}
                            required>
                        @error('fecha_nacimiento')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Documento:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('documento') is-invalid @enderror"
                            id="exampleLastName"
                            placeholder="Documento"
                            name="documento"
                            value="{{ old('documento', $estudiante->documento) }}"
                            onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                        @error('documento')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Expedido en:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('expedicion_ci_id') is-invalid @enderror" name="expedicion_ci_id" id="expedicion_ci_id" required>
                            <option value="" selected>Seleccione la expedici&oacute;n</option>
                            @foreach ($expedicion_cis as $expedicion_ci)
                            <option value="{{$expedicion_ci->id}}" {{ old('expedicion_id', $estudiante->expedicion_ci_id) == $expedicion_ci->id ? 'selected' : ''}}> {{$expedicion_ci->sigla}} </option>
                            @endforeach
                        </select>
                        @error('expedicion_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Localidad</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('localidad_id') is-invalid @enderror" name="localidad_id" id="localidad_id" required>
                            <option value="" selected>Seleccione la localidad</option>
                            @foreach ($localidades as $localidad)
                            <option value="{{$localidad->id}}" {{ old('localidad_id', $estudiante->localidad_id) == $localidad->id ? 'selected' : ''}}> {{$localidad->nombre}} </option>
                            @endforeach
                        </select>
                        @error('localidad_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Direci&oacute;n</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('direccion') is-invalid @enderror"
                            id="direccion"
                            placeholder="Direci&oacute;n"
                            name="direccion"
                            value="{{ old('direccion', $estudiante->direccion) }}" required>
                        @error('direccion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Correo:</strong><span style="color:red;">*</span></label>
                        <input
                            type="correo"
                            class="form-control form-control-sm @error('correo') is-invalid @enderror"
                            id="correo"
                            placeholder="Correo"
                            name="correo"
                            value="{{ old('correo', $estudiante->correo) }}" required>

                        @error('correo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Celular:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('telefono') is-invalid @enderror"
                            id="telefono"
                            placeholder="Nro Celular"
                            name="telefono"
                            value="{{ old('telefono', $estudiante->telefono) }}"required>
                        @error('telefono')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nombre Referencia:</strong></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombre_referencia') is-invalid @enderror"
                            id="nombre_referencia"
                            placeholder="Nombre Referencia"
                            name="nombre_referencia"
                            value="{{ old('nombre_referencia', $estudiante->nombre_referencia) }}">
                        @error('nombre_referencia')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Tel&eacute;fono Referencia</strong></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('telefono_referencia') is-invalid @enderror"
                            id="telefono_referencia"
                            placeholder="Tel&eacute;fono Referencia"
                            name="telefono_referencia"
                            value="{{ old('telefono_referencia', $estudiante->telefono_referencia) }}">
                        @error('telefono_referencia')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Registro:</strong><span style="color:red;">*</span></label>
                        <input
                            type="datetime-local"
                            class="form-control form-control-sm @error('fecha_registro') is-invalid @enderror"
                            id="fecha_registro"
                            placeholder="Fecha Registro:"
                            name="fecha_registro"
                            value="{{ old('fecha_registro', $estudiante->fecha_registro) }}" required>
                        @error('fecha_registro')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" required>
                            <option value="1" {{ old('estado', $estudiante->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $estudiante->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('estudiantes.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection