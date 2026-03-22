@extends('layouts.app')

@section('title', 'Editar Gestion')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE GESTIÓN</h6>
        </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Id: </strong><span style="color:red;">*</span></label>
                        <input type="text"
                            class="form-control form-control-sm @error('id') is-invalid @enderror"
                            placeholder="id"
                            id="id"
                            name="id"
                            value="{{ old('id', $gestion->id) }}"
                            disabled>
                        </input>
                        @error('id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Descripción: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="Descripción"
                            name="descripcion"
                            value="{{ old('descripcion', $gestion->descripcion) }}"
                            disabled>
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Año: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('anio') is-invalid @enderror"
                            id="anio"
                            placeholder="Año"
                            name="anio"
                            value="{{ old('anio', $gestion->anio) }}"
                            disabled>
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado" disabled>
                            <option value="1" {{ old('estado', $gestion->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $gestion->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('gestions.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection