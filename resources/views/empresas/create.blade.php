@extends('layouts.app')

@section('title', 'Nueva Empresa')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">NUEVA EMPRESA</h1>
            <a href="{{ route('empresas.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> ATR&Aacute;S</a>
        </div>
        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <form method="POST" action="{{ route('empresas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        {{-- direccion --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            Nombre: <span style="color:red;">*</span> </label>
                            <input type="text"
                                class="form-control form-control-user @error('nombre') is-invalid @enderror" id="nombre"
                                placeholder="Nombre" name="nombre" value="{{ old('nombre') }}" required>

                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            Nit: <span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-user @error('nit') is-invalid @enderror"
                                id="nit" placeholder="C&oacute;digo Interno" name="nit"
                                value="{{ old('nit') }}" required>

                            @error('nit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            Direcci&oacute;n: <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-user @error('direccion') is-invalid @enderror"
                                id="exampleLastName" placeholder="direccion" name="direccion" value="{{ old('direccion') }}"
                                required>

                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Mobile Number --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            Tel&eacute;fono:<span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-user @error('telefono') is-invalid @enderror"
                                id="exampleMobile" placeholder="Nro Celular" name="telefono" value="{{ old('telefono') }}"
                                required>

                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Imagen 1 --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label for="image1">Image 1:</label>
                            <input type="file"
                                class="form-control form-control-user @error('image1') is-invalid @enderror" id="image1"
                                placeholder="image1" name="image1" value="{{ old('image1') }}">
                            @error('image1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Imagen 2 --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            Image 2:</label>
                            <input type="file" name="image2"
                                class="form-control form-control-user @error('image2') is-invalid @enderror" id="image2"
                                placeholder="image2" name="image2" value="{{ old('image2') }}">

                            @error('image2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            Estado <span style="color:red;">*</span></label>
                            <select class="form-control form-control-user @error('estado') is-invalid @enderror"
                                name="estado" disabled>
                                <option value="1" selected>ACTIVO</option>
                                <option value="0">INACTIVO</option>
                            </select>
                            @error('estado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">GUARDAR</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('empresas.index') }}">CANCELAR</a>
                </div>
            </form>
        </div>

    </div>


@endsection
