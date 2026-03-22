@extends('layouts.app')

@section('title', 'Detalle inscriptor')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE INSCRIPTOR</h6>
        </div>
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Id: </strong><span style="color:red;">*</span></label>
                        <input type="text"
                            class="form-control form-control-sm @error('id') is-invalid @enderror"
                            placeholder="id"
                            name="id"
                            value="{{ old('id', $inscriptor->id) }}"
                            disabled>
                        </input>
                        @error('id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Name: </strong><span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('name') is-invalid @enderror" 
                            id="exampleLastName"
                            placeholder="Nombre"
                            name="name"
                            value="{{ old('name', $inscriptor->name) }}"disabled>
                    </div>
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Estado: </strong><span style="color:red;">*</span></label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $inscriptor->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $inscriptor->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('inscriptors.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection