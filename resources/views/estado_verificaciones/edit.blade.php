@extends('layouts.app')

@section('title', 'Editar Estado Verificacion')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-edit"></i> EDITAR ESTADO DE VERIFICACION</h6>
        </div>
        <form method="POST" action="{{route('estado_verificaciones.update', ['estado_verificacione'=> $estado_verificacione->id])}}">
            @csrf
            @method('PUT')
            {{-- @php
            dd($estado_verificacione);
            //dd($estudiante);
            @endphp --}}
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>#</strong></label>
                        <input type="text"
                            class="form-control form-control-sm @error('id') is-invalid @enderror"
                            placeholder="id"
                            name="id"
                            value="{{ old('id', $estado_verificacione->id) }}"
                            disabled>
                        </input>
                        @error('id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Id Estudiante:</strong></label>
                        <input type="text"
                            class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                            placeholder="ID Estudiante"
                            name="estudiante_id"
                            value="{{ old('estudiante_id', $estado_verificacione->estudiante->id) }}"
                            disabled>
                        @error('estudiante_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-5 mb-3 mt-3">
                        <strong>Estudiante:</strong>
                        <input type="text"
                            class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                            placeholder="Estudiante"
                            name="estudiante_id"
                            value="{{ old('estudiante_id', $estado_verificacione->estudiante->nombres .' '.$estado_verificacione->estudiante->apellidos) }}"
                            disabled>
                        @error('estudiante_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado">
                            <option value="1" {{ old('estado', $estado_verificacione->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $estado_verificacione->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Inicio --}}
                    {{--  --}}
                    <div class="col-sm-3 mb-3 mt-3">
                            <strong>COMPROMISO TITULO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="compromiso_titulo" value="1"
                                        {{ old('compromiso_titulo', $estado_verificacione->compromiso_titulo) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="compromiso_titulo" value="0"
                                        {{ old('compromiso_titulo', $estado_verificacione->compromiso_titulo) == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>CI PRESENTADO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="ci_estado" value="1"
                                        {{ old('ci_estado', $estado_verificacione->ci_estado) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="ci_estado" value="0"
                                        {{ old('ci_estado', $estado_verificacione->ci_estado) == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>FOTO PRESENTADA?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="foto_estado" value="1"
                                        {{ old('foto_estado', $estado_verificacione->foto_estado) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="foto_estado" value="0"
                                        {{ old('foto_estado', $estado_verificacione->foto_estado) == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>FOLDER PRESENTADO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="folder_estado" value="1"
                                        {{ old('folder_estado', $estado_verificacione->folder_estado) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="folder_estado" value="0"
                                        {{ old('folder_estado', $estado_verificacione->folder_estado) == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>ADQUIRI&Oacute; EL FOLDER?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="pago_folder_estado" value="1"
                                        {{ old('pago_folder_estado', $estado_verificacione->pago_folder_estado) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="pago_folder_estado" value="0"
                                        {{ old('pago_folder_estado', $estado_verificacione->pago_folder_estado) == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>CERTIFICADO PRESENTADO?: </strong> <span style="color:red;">*</span>
                            <br><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="certificado_estado" value="1"
                                        {{ old('certificado_estado', $estado_verificacione->foto_estado) == 1 ? 'checked' : '' }}> SI
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="certificado_estado" value="0"
                                        {{ old('certificado_estado', $estado_verificacione->foto_estado) == 0 ? 'checked' : '' }}> NO
                                </label>
                            </div>
                        </div>
                    {{-- Fin --}}
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i class="fas fa-save"></i> ACTUALIZAR</button>
                <a class="btn btn-outline-danger float-right mr-3 mb-3" href="{{ route('estado_verificaciones.index') }}"><i class="fas fa-window-close"></i> CANCELAR</a>
            </div>
        </form>
    </div>

</div>

@endsection