@extends('layouts.app')

@section('title', 'Mostrar Libros')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE LIBRO</h6>
        </div>
        <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Id:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('id') is-invalid @enderror"
                            id="id"
                            placeholder="ID:"
                            name="id"
                            value="{{ old('id', $libro->id)  ?? ''}}"
                            disabled>
                        @error('id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n :</strong> <span style="color:red;">*</span>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                            id="gestion_id"
                            placeholder="Gesti&oacute;n "
                            name="gestion_id"
                            @if ($libro->gestion)
                            value="{{ old('gestion_id', $libro->gestion->descripcion ?? '') }}"
                            @endif
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <strong>Nro de Libro:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nro_libro') is-invalid @enderror"
                            id="nro_libro"
                            placeholder="Nro de Libro:"
                            name="nro_libro"
                            value="{{ old('nro_libro', $libro->nro_libro) }}"
                            disabled>
                        @error('nro_libro')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $libro->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $libro->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('libros.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>
</div>

@endsection