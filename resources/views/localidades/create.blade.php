@extends('layouts.app')

@section('title', 'Nueva Localidad')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> REGISTRAR LOCALIDAD</h6>
        </div>
        <form method="POST" action="{{route('localidades.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <label for="nombre"><strong>Nombre:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('nombre') is-invalid @enderror"
                            id="nombre"
                            placeholder="Nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                            required>
                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <label for="provincia_id"><strong>Provincia:</strong>
                            <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('provincia_id') is-invalid @enderror" name="provincia_id" id="provincia_id" required>
                            <option value="" selected >Seleccione la Provincia</option>
                            @foreach ($provincias as $provincia)
                                <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                            @endforeach
                        </select>
                        @error('provincia_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <label for="estado"><strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado" disabled>
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
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> GUARDAR</button>
                <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('localidades.index') }}"><i class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection