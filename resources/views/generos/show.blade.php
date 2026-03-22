@extends('layouts.app')

@section('title', 'Detalle Genero')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> DETALLE G&Eacute;NERO</h6>
        </div>
        {{-- <form method="POST" action="{{route('generos.update', ['genero' => $genero->id])}}">
            @csrf
            @method('PUT') --}}
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>#:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('id') is-invalid @enderror"
                            id="id"
                            placeholder="id"
                            name="id"
                            value="{{ old('id', $genero->id) }}"
                            disabled
                            onkeypress="return event.charCode>=48 && event.charCode<=57">
                        @error('id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>G&eacute;nero:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('genero') is-invalid @enderror"
                            id="genero"
                            placeholder="genero"
                            name="genero"
                            value="{{ old('genero', $genero->genero) }}"
                            disabled
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('genero')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Sigla:</strong> <span style="color:red;"></span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('sigla') is-invalid @enderror"
                            id="sigla"
                            placeholder="sigla"
                            name="sigla"
                            value="{{ old('sigla', $genero->sigla) }}"
                            disabled
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('sigla')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $genero->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $genero->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
            <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('generos.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
        </form>
    </div>

</div>


@endsection