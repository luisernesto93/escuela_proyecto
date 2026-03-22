@extends('layouts.app')

@section('title', 'Nuevo Canal Publicitario')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">NUEVO CANAL PUBLICITARIO</h1>
        <a href="{{route('canal_publicitarios.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> ATR&Aacute;S</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <form method="POST" action="{{route('canal_publicitarios.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    {{-- Last Name --}}
                    <div class="col-sm-7 mb-3 mt-3 mb-sm-0">
                        Descripción: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="Descripción"
                            name="descripcion"{{-- Laravael trabaja con el name  --}}
                            value="{{ old('descripcion') }}" required>{{-- lo que  a la DB --}}

                        @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                        Estado <span style="color:red;">*</span></label>
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
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('canal_publicitarios.index') }}">CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection