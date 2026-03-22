@extends('layouts.app')

@section('title', 'Actualizar Resolucion')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> ACTUALIZAR RESOLUCION</h6>
        </div>
        <form method="POST" action ="{{route('resoluciones.update', ['resolucione' => $resolucion->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>N&uacute;mero Resoluci&oacute;n:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('numero_resolucion') is-invalid @enderror"
                            id="numero_resolucion"
                            placeholder="numero_resolucion"
                            name="numero_resolucion"
                            value="{{ old('numero_resolucion', $resolucion->numero_resolucion) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                            required>
                        @error('numero_resolucion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n:</strong><span style="color:red;">*</span>
                        <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror" name="gestion_id"
                        required>
                            <option value="" selected disabled>Seleccione la Gesti&oacute;n</option>
                            @foreach ($gestiones as $gestion)
                                <option value="{{$gestion->id}}" {{ old('gestion_id', $resolucion->gestion_id) == $gestion->id ? 'selected' : ''}}> {{$gestion->descripcion.'-'.$gestion->anio}} </option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Carrera:</strong><span style="color:red;">*</span>
                        <select class="form-control form-control-sm @error('carrera_id') is-invalid @enderror" name="carrera_id"
                        required>
                            <option value="" selected disabled>Seleccione la Carrera</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{$carrera->id}}" {{ old('carrera_id', $resolucion->carrera_id) == $carrera->id ? 'selected' : ''}}> {{$carrera->nombre}} </option>
                            @endforeach
                        </select>
                        @error('carrera_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" required>
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
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> GUARDAR</button>
                <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('resoluciones.index') }}"><i class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection