@extends('layouts.app')

@section('title', 'Nueva Modalidad de Pago')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">NUEVA MODALIDAD DE PAGO</h1>
        <a href="{{route('modalidadpagos.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> ATR&Aacute;S</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <form method="POST" action="{{route('modalidadpagos.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    {{-- Descripcion --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Descripcion: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="descripcion"
                            name="descripcion"
                            value="{{ old('descripcion') }}" required>

                        @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- MontoPagar --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Monto a Pagar: <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('monto_pagar') is-invalid @enderror"
                            id="monto_pagar"
                            placeholder="monto_pagar"
                            name="monto_pagar"
                            value="{{ old('monto_pagar') }}" required>
                        @error('monto_pagar')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="gestion_id">Seleccione Gesti&oacute;n: <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('gestion_id') is-invalid @enderror" name="gestion_id" required>
                            <option value="" selected>Seleccione Gesti&oacute;n</option>
                            @foreach ($gestiones as $gestion)
                                <option value="{{$gestion->id}}">{{$gestion->descripcion}}</option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        Estado <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('estado') is-invalid @enderror" name="estado" required>
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
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('modalidadpagos.index') }}">CANCELAR</a>
            </div>
        </form>
    </div>

</div>

@endsection