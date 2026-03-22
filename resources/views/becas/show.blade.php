@extends('layouts.app')

@section('title', 'Detalle Beca')

@section('content')

<div class="container-fluid">
    {{-- alertas --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> DETALLE BECA</h6>
        </div>
        <form method="POST" action="{{route('becas.update', ['beca' => $beca->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-5 mb-3 mt-3">
                        <strong>Descripcion:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="descripcion"
                            name="descripcion"
                            value="{{ old('descripcion', $beca->descripcion) }}"
                            disabled
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">

                            @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Porcentaje:</strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('porcentaje') is-invalid @enderror" 
                            id="exampleLastName"
                            placeholder="porcentaje"
                            name="porcentaje"
                            value="{{ old('porcentaje', $beca->porcentaje) }}"
                            disabled
                            onkeypress="return event.charCode>=48 && event.charCode<=57">
                        @error('porcentaje')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $beca->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $beca->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
            <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('becas.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
              </div>
        </form>
    </div>

</div>


@endsection