@extends('layouts.app')

@section('title', 'Editar Modalidades de Pago')

@section('content')

<div class="container-fluid">
    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR MODALIDADES DE PAGO</h6>
        </div>
        <form method="POST" action="{{route('modalidadpagos.update', ['modalidadpago' => $modalidadpago->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Descripcion:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                            id="exampleLastName"
                            placeholder="Descripcion"
                            name="descripcion"
                            value="{{ old('descripcion', $modalidadpago->descripcion) }}"
                            disabled
                            onkeypress="return event.charCode>=48 && event.charCode<=57">
                        @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Monto a Pagar</strong>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('monto_pagar') is-invalid @enderror" 
                            id="monto_pagar"
                            placeholder="monto a pagar"
                            name="monto_pagar"
                            value="{{ old('monto_pagar', $modalidadpago->monto_pagar) }}"
                            disabled
                            onkeypress="return event.charCode>=48 && event.charCode<=57">
                        @error('monto_pagar')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n:<span style="color:red;">*</span></strong>
                        <select class="form-control form-control-sm @error('gestion_id') is-invalid @enderror" name="gestion_id" disabled>
                            @foreach ($gestiones as $gestion)
                                <option value="{{$gestion->id}}" {{ old('gestion_id',$modalidadpago->gestion_id) == $gestion->id ? 'selected' : ''}}>
                                    {{$gestion->descripcion}}
                                </option>
                            @endforeach
                        </select>
                        @error('gestion_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> --}}

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Gesti&oacute;n:</strong> <span style="color:red;">*</span>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('gestion_id') is-invalid @enderror"
                            id="gestion_id"
                            placeholder="Gesti&oacute;n"
                            name="gestion_id"
                            @if ($modalidadpago->gestion)
                            value="{{ old('gestion_id', $modalidadpago->gestion->descripcion ?? '') }}"
                            @endif
                            disabled>
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> <span style="color:red;">*</span></label>
                        <select disabled class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado">
                            <option value="1" {{ old('estado', $modalidadpago->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $modalidadpago->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('modalidadpagos.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>
</div>

@endsection