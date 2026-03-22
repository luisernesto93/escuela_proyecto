@extends('layouts.app')

@section('title', 'Nuevo Genero')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> REGISTRAR G&Eacute;NERO</h6>
        </div>
        <form method="POST" action="{{route('generos.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>G&eacute;nero:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('genero') is-invalid @enderror"
                            id="genero"
                            placeholder="g&eacute;nero"
                            name="genero"
                            value="{{ old('genero') }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                            required>
                        @error('genero')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Sigla:</strong> <span style="color:red;"></span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('sigla') is-invalid @enderror"
                            id="sigla"
                            placeholder="abreviatura"
                            name="sigla"
                            value="{{ old('sigla') }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))"
                            required>
                        @error('sigla')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
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
                <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('generos.index') }}"><i class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection