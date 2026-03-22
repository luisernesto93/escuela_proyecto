@extends('layouts.app')

@section('title', 'Nuevo Resolucion')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> REGISTRAR RESOLUCION</h6>
        </div>
        <form method="POST" action="{{route('resoluciones.store')}}">
            @csrf

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>N&uacute;mero de Resoluci&oacute;n</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('numero_resolucion') is-invalid @enderror"
                            id="numero_resolucion"
                            placeholder="Número de Resoluci&oacute;n"
                            name="numero_resolucion"
                            value="{{ old('numero_resolucion') }}" required>
                        @error('numero_resolucion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        {{-- <label for="gestion_id"> --}}<strong>Gesti&oacute;n:</strong>
                            <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror" name="gestion_id" id="gestion_id" required> {{-- name debe corresponder al nombre del campo de la tabla --}}
                            <option value="" selected>Seleccione Gesti&oacute;n</option>
                            @foreach ($gestiones as $gestion_id)
                                <option value="{{$gestion_id->id}}" {{ old('gestion_id') == $gestion_id->id ? 'selected' : ''}}>{{$gestion_id->descripcion.' - '.$gestion_id->anio}}</option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        {{-- <label for="carrera_id"> --}}<strong>Carrera:</strong>
                            <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('carrera_id') is-invalid @enderror" name="carrera_id" id="carrera_id" required> {{-- name debe corresponder al nombre del campo de la tabla --}}
                            <option value="" selected>Seleccione Carrera</option>
                            @foreach ($carreras as $carrera_id)
                                <option value="{{$carrera_id->id}}" {{ old('carrera_id') == $carrera_id->id ? 'selected' : ''}}>{{$carrera_id->nombre}}</option>
                            @endforeach
                        </select>
                        @error('carrera_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{-- <label for="estado"> --}}Estado <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('estado') is-invalid @enderror" name="estado" id="estado" disabled>
                            <option value="1" selected>ACTIVO</option>
                            <option value="0">INACTIVO</option>
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