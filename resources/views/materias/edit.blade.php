@extends('layouts.app')

@section('title', 'Editar Materia')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR MATERIA</h6>
        </div>
        <form method="POST" action="{{route('materias.update', ['materia' => $materia->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{--<label for="plan_estudio_id"> --}}<strong>Plan de Estudios: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('plan_estudio_id') is-invalid @enderror" name="plan_estudio_id" id="plan_estudio_id"
                        required>
                            <option value="" selected >Seleccione el de Plan Estudios</option>
                            @foreach ($plan_estudios as $plan_estudio)
                                <option value="{{$plan_estudio->id}}" {{ old('plan_estudio_id', $materia->plan_estudio_id) == $plan_estudio->id ? 'selected' : ''}} >{{$plan_estudio->area_formacion}}</option>
                            @endforeach
                        </select>
                        @error('plan_estudio_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Carrera: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('carrera_id') is-invalid @enderror" name="carrera_id" id="carrera_id" required>
                            <option value="" selected disabled>Seleccione el de Plan Estudios</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{$carrera->id}}" {{ old('carrera_id', $materia->carrera_id) == $carrera->id ? 'selected' : ''}} >{{$carrera->nombre}}</option>
                            @endforeach
                        </select>
                        @error('area_formacion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Sigla:</strong><span style="color:red;">*</span>
                        <input
                        type="text"
                        class="form-control form-control-sm @error('sigla') is-invalid @enderror"
                        id='sigla'
                        name="sigla"
                        placeholder="Sigla"
                            value= "{{ old('sigla', $materia->sigla)}}"
                        >
                        @error('sigla')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Materia:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombre_materia') is-invalid @enderror"
                            id="nombre_materia"
                            placeholder="Materia"
                            name="nombre_materia"
                            value="{{ old('nombre_materia', $materia->nombre_materia) }}">
                            {{-- onkeypress="return event.charCode>=48 && event.charCode<=57" > --}}
                        @error('nombre_materia')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Horas:</strong><span style="color:red;">*</span></label>
                        <input
                        type="text"
                        class="form-control form-control-sm @error('horas') is-invalid @enderror"
                        id="horas"
                        placeholder="Horas"
                        name="horas"
                        value= "{{ old('horas', $materia->horas)}}"
                        >
                    @error('horas')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nivel</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nivel') is-invalid @enderror"
                            id="nivel"
                            placeholder="Nivel"
                            name="nivel"
                            value="{{ old('nivel', $materia->nivel) }}">
                        @error('nivel')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Grado</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('orden') is-invalid @enderror"
                            id="orden"
                            placeholder="Grado"
                            name="orden"
                            value="{{ old('orden', $materia->orden) }}">
                        @error('orden')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" >
                            <option value="1" {{ old('estado', $materia->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $materia->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('materias.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>
</div>

@endsection