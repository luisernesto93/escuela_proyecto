@extends('layouts.app')

@section('title', 'Nuevo Plan de Estudios')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">NUEVO PLAN DE ESTUDIOS</h1>
        <a href="{{route('plan_estudios.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> ATR&Aacute;S</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <form method="POST" action="{{route('plan_estudios.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    {{-- fecha inicio --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{-- <labelfor="resolucion_id"> --}}<strong>Resoluci&oacute;n: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('resolucion_id') is-invalid @enderror" name="resolucion_id" id="resolucion_id"
                        required>
                            <option value="" selected disabled>Seleccione la Resoluci&oacute;n</option>
                            @foreach ($resoluciones as $resolucion)
                                <option value="{{$resolucion->id}}" {{ old('resolucion_id') == $resolucion->id ? 'selected' : ''}} >{{$resolucion->numero_resolucion}}</option>
                            @endforeach
                        </select>
                        @error('resolucion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>&Aacute;rea formaci&oacute;n: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('area_formacion') is-invalid @enderror"
                            id="area_formacion"
                            placeholder="&Aacute;rea formaci&oacute;n"
                            name="area_formacion"
                            value="{{ old('area_formacion') }}"
                            required>
                        @error('area_formacion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- fecha limite --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Horas Semanales: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('horas_semanales') is-invalid @enderror"
                            id="horas_semanales"
                            placeholder="horas_semanales"
                            name="horas_semanales"
                            value="{{ old('horas_semanales') }}"
                            required>

                        @error('horas_semanales')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Horas mes: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('horas_mes') is-invalid @enderror"
                            id="horas_mes"
                            placeholder="horas_mes"
                            name="horas_mes"
                            value="{{ old('horas_mes') }}"
                            required>

                        @error('hoaras_semanales')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Horas Gesti&oacute;n: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('horas_gestion') is-invalid @enderror"
                            id="horas_gestion"
                            placeholder="horas Gestión"
                            name="horas_gestion"
                            value="{{ old('horas_gestion') }}"
                            required>

                        @error('horas_gestion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Carga Horaria: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('carga_horaria') is-invalid @enderror"
                            id="carga_horaria"
                            placeholder="carga_horaria"
                            name="carga_horaria"
                            value="{{ old('carga_horaria') }}"
                            required>

                        @error('carga_horaria')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{-- <labelfor="estado"> --}}<strong>Estado </strong><span style="color:red;">*</span></label>
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
                <button type="submit" class="btn btn-success btn-user float-right mb-3">GUARDAR</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('plan_estudios.index') }}">CANCELAR</a>
            </div>
        </form>
    </div>

</div>

@endsection