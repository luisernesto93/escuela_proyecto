@extends('layouts.app')

@section('title', 'Detalle Estudiante')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE ESTUDIANTE</h6>
        </div>
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
                            disabled
                            >
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
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" disabled>
                        @error('apellidos')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>G&eacute;nero:</strong><span style="color:red;">*</span>
                        <input
                        type="text"
                        class="form-control form-control-sm @error('genero') is-invalid @enderror"
                        id='genero'
                        name="genero"
                        placeholder="G&eacute;nero"
                            value= "{{ old('genero', $estudiante->genero->genero)}}"
                        disabled>
                        @error('genero')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Nacimiento:</strong><span style="color:red;">*</span></label>
                        <input
                            type="date"
                            class="form-control form-control-sm @error('fecha_nacimiento') is-invalid @enderror"
                            id="fecha_nacimiento"
                            placeholder="Fecha Nacimiento:"
                            name="fecha_nacimiento"
                            value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}"
                            {{-- onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"--}}
                            disabled>
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
                            onkeypress="return event.charCode>=48 && event.charCode<=57" disabled>
                        @error('documento')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Expedido en:</strong><span style="color:red;">*</span></label>
                        <input
                        type="text"
                        class="form-control form-control-sm @error('expedido_ci') is-invalid @enderror"
                        id="expedido_ci"
                        placeholder="Expedido en"
                        name="expedido_ci"
                        value= "{{ old('expedido_ci', $estudiante->expedicion_ci->sigla)}}"
                        disabled>
                    @error('expedido_ci')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Localidad</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('localidad') is-invalid @enderror"
                            id="localidad"
                            placeholder="Localidad"
                            name="localidad"
                            value="{{ old('localidad', $estudiante->localidad->nombre) }}"disabled>
                        @error('localidad')
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
                            value="{{ old('direccion', $estudiante->direccion) }}"disabled>
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
                            value="{{ old('correo', $estudiante->correo) }}" disabled>
                        @error('correo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Celular:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('telefono') is-invalid @enderror" 
                            id="celular"
                            placeholder="Nro Celular"
                            name="telefono"
                            value="{{ old('telefono', $estudiante->telefono) }}" disabled>

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
                            value="{{ old('nombre_referencia', $estudiante->nombre_referencia) }}"disabled>
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
                            value="{{ old('telefono_referencia', $estudiante->telefono_referencia) }}"disabled>
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
                            value="{{ old('fecha_registro', $estudiante->fecha_registro) }}"disabled>
                        @error('fecha_registro')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
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
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('estudiantes.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection