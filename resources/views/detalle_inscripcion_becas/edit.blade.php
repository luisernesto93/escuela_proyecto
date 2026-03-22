@extends('layouts.app')

@section('title', 'Actualizar Detalle Incripcion Becas')

@section('content')

    <div class="container-fluid">
        {{-- alertas --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> ACTUALIZAR BECA</h6>
            </div>
            <form method="POST"
                action="{{ route('detalle_inscripcion_becas.update', ['detalle_inscripcion_beca' => $detalle_inscripcion_beca->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-2 mb-3 mt-3">

                            <strong>Id Inscripci&oacute;n:</strong><span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('inscripcion_id') is-invalid @enderror"
                                name="inscripcion_id" disabled>
                                @foreach ($inscripciones as $inscripcion)
                                    <option value="{{ $inscripcion->id }}"
                                        {{ old('inscripcion_id', $detalle_inscripcion_beca->inscripcion_id) == $inscripcion->id ? 'selected' : '' }}>
                                        {{ $inscripcion->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('inscripcion_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Beca:</strong><span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('beca_id') is-invalid @enderror"
                                name="beca_id" disabled>
                                @foreach ($becas as $beca)
                                    <option value="{{ $beca->id }}"
                                        {{ old('beca_id', $detalle_inscripcion_beca->beca_id) == $beca->id ? 'selected' : '' }}>
                                        {{ $beca->descripcion }} =>
                                        {{ $beca->porcentaje }}%
                                    </option>
                                @endforeach
                            </select>
                            @error('beca_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>Porcentaje:</strong> <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('porcentaje') is-invalid @enderror"
                                id="exampleLastName" placeholder="porcentaje" name="porcentaje"
                                value="{{ old('porcentaje', $detalle_inscripcion_beca->porcentaje) }}"
                                onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                            @error('porcentaje')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-2 mb-3 mt-3">
                            <strong>Estado:</strong><span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('estado') is-invalid @enderror"
                                name="estado" required>
                                <option value="1"
                                    {{ old('estado', $detalle_inscripcion_beca->estado) == 1 ? 'selected' : '' }}>ACTIVO
                                </option>
                                <option value="0"
                                    {{ old('estado', $detalle_inscripcion_beca->estado) == 0 ? 'selected' : '' }}>INACTIVO
                                </option>
                            </select>
                            @error('estado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i
                            class="fas fa-save"></i> GUARDAR</button>
                    <a class="btn btn-outline-primary float-right mr-3 mb-3"
                        href="{{ route('detalle_inscripcion_becas.index') }}"><i
                            class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
                </div>
            </form>
        </div>

    </div>


@endsection
