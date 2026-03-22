@extends('layouts.app')

@section('title', 'Nuevo Estudiante')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">NUEVO DOCENTE</h1>
        <a href="{{route('docentes.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> ATR&Aacute;S</a>
    </div>
    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <form method="POST" action="{{route('docentes.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    {{-- documento --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        C&oacute;digo Interno: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('codigo_interno') is-invalid @enderror"
                            id="codigo_interno"
                            placeholder="C&oacute;digo Interno"
                            name="codigo_interno"
                            value="{{ old('codigo_interno') }}" required>

                        @error('codigo_interno')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Documento: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('documento') is-invalid @enderror"
                            id="exampleLastName"
                            placeholder="Documento"
                            name="documento"
                            value="{{ old('documento') }}" required>

                        @error('documento')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- documento --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Observaciones:</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('observaciones') is-invalid @enderror"
                            id="observaciones"
                            placeholder="Observaciones"
                            name="observaciones"
                            value="{{ old('observaciones') }}">

                        @error('observaciones')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Last Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Apellidos: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('apellidos') is-invalid @enderror"
                            id="apellidos"
                            placeholder="Apellidos"
                            name="apellidos"
                            value="{{ old('apellidos') }}" required>
                        @error('apellidos')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- First Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Nombres: <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('nombres') is-invalid @enderror"
                            id="nombres"
                            placeholder="Nombres"
                            name="nombres"
                            value="{{ old('nombres') }}" required>

                        @error('nombres')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Mobile Number --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Celular:<span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('telefono') is-invalid @enderror"
                            id="exampleMobile"
                            placeholder="Nro Celular"
                            name="telefono"
                            value="{{ old('telefono') }}" required>

                        @error('telefono')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Estado <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('estado') is-invalid @enderror" name="estado" disabled>
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
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('docentes.index') }}">CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection