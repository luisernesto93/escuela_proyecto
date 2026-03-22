@extends('layouts.app')

@section('title', 'Nuevo Libro')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">NUEVO LIBRO</h1>
        <a href="{{route('libros.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> ATR&Aacute;S</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <form method="POST" action="{{route('libros.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    {{-- fecha inicio --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{-- <labelfor="gestion_id"> --}}<strong>Libro: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('gestion_id') is-invalid @enderror" name="gestion_id" id="gestion_id"
                        required>
                            <option value="" selected disabled>Seleccione la Gesti&oacute;n</option>
                            @foreach ($gestiones as $gestion)
                                <option value="{{$gestion->id}}" {{ old('gestion_id') == $gestion->id ? 'selected' : ''}} >{{$gestion->descripcion.' - '.$gestion->anio}}</option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong> Nro de Libro: </strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('nro_libro') is-invalid @enderror"
                            id="nro_libro"
                            placeholder="Nro de Libro"
                            name="nro_libro"
                            value="{{ old('nro_libro') ?? '' }}"
                            required>
                        @error('nro_libro')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- fecha limite --}}

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
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('libros.index') }}">CANCELAR</a>
            </div>
        </form>
    </div>

</div>

@endsection