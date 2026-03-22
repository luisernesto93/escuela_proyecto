@extends('layouts.app')

@section('title', 'Editar Libro')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR LIBROS</h6>
        </div>
        <form method="POST" action="{{route('libros.update', ['libro' => $libro->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{--<label for="gestion_id"> --}}<strong>Gesti&oacute;n: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('gestion_id') is-invalid @enderror" name="gestion_id" id="gestion_id"
                        required>
                            <option value="" selected disabled>Seleccione la Gesti&oacute;n</option>
                            @foreach ($gestiones as $gestion)
                                <option value="{{$gestion->id}}" {{ old('gestion_id', $libro->gestion_id) == $gestion->id ? 'selected' : ''}} >{{$gestion->descripcion.' - '.$gestion->anio}}</option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        {{-- <label for="nro_libro">--}}<strong>Nro Libro: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nro_libro') is-invalid @enderror"
                            id="nro_libro"
                            placeholder="Nro Libro"
                            name="nro_libro"
                            value="{{ old('nro_libro', $libro->nro_libro) }}"
                            required>
                        @error('nro_libro')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span</label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado"
                        required>
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
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('libros.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>
</div>

@endsection