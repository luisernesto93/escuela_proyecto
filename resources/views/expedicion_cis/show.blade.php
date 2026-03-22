@extends('layouts.app')

@section('title', 'Detalle Expedicion CI')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> DETALLE EXPEDICI&Oacute;N CI</h6>
        </div>
        {{-- <form method="POST" action="{{route('expedicion_cis.update', ['expedicion_ci' => $expedicion_ci->id])}}">
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
                            value="{{ old('id', $expedicion_ci->id) }}"
                            disabled
                            onkeypress="return event.charCode>=48 && event.charCode<=57">
                        @error('id')
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
                            value="{{ old('sigla', $expedicion_ci->sigla) }}"
                            disabled
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('sigla')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                    <strong>Descripci&oacute;n:</strong>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="descripcion"
                            name="descripcion"
                            value="{{ old('descripcion', $expedicion_ci->descripcion) }}"
                            disabled
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                    <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $expedicion_ci->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $expedicion_ci->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
            <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('expedicion_cis.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
        </form>
    </div>

</div>

@endsection