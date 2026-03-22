@extends('layouts.app')

@section('title', 'Listado Verificaciones')

@section('content')

<div class="container-fluid">
    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE VERIFICACIONES</h6>
        </div>
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
                    <div class="col-sm-4 mb-3 mt-3">
                        <strong>Id Estudiante:</strong></label>
                        <input type="text"
                            class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                            placeholder="ID Estudiante"
                            name="estudiante"
                            value="{{ old('estudiante', $estado_verificacione->estudiante->id)}}"
                            disabled>
                        @error('estudiante_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>Estudiante:</strong>
                        <input type="text"
                            class="form-control form-control-sm @error('estudiante_id') is-invalid @enderror"
                            placeholder="Estudiante"
                            name="estudiante"
                            value="{{ old('estudiante_id', $estado_verificacione->estudiante->nombres .' '.$estado_verificacione->estudiante->apellidos) }}"
                            disabled>
                        @error('estudiante_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>Compromiso T&iacute;tulo:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('compromiso_titulo') is-invalid @enderror"
                            id="compromiso_titulo"
                            placeholder="Compromiso T&iacute;tulo"
                            name="compromiso_titulo"
                            value="{{ old('compromiso_titulo', $estado_verificacione->compromiso_titulo) == 1 ? 'SI' : 'NO' }}"disabled>
                        @error('compromiso_titulo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>CI:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('ci_estado') is-invalid @enderror"
                            id="ci_estado"
                            placeholder="CI"
                            name="ci_estado"
                            value="{{ old('ci_estado', $estado_verificacione->ci_estado) == 1 ? 'SI' : 'NO' }}"
                            disabled>
                        @error('ci_estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>Foto:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('foto_estado') is-invalid @enderror"
                            id="foto_estado"
                            placeholder="Foto"
                            name="foto_estado"
                            value="{{ old('foto_estado', $estado_verificacione->foto_estado) == 1 ? 'SI' : 'NO' }}"
                            disabled>
                        @error('foto_estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>Folder:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('compromiso_estado') is-invalid @enderror"
                            id="folder_estado"
                            placeholder="Folder"
                            name="folder_estado"
                            value="{{ old('folder_estado', $estado_verificacione->folder_estado) == 1 ? 'SI' : 'NO' }}"
                            disabled>
                        @error('folder_estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>Certificado:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('compromiso_estado') is-invalid @enderror"
                            id="certificado_estado"
                            placeholder="Certificado"
                            name="certificado_estado"
                            value="{{ old('certificado_estado', $estado_verificacione->certificado_estado) == 1 ? 'SI' : 'NO' }}"disabled>
                        @error('certificado_estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3">
                        <strong>Pago folder:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('pago_folder_estado') is-invalid @enderror"
                            id="pago_folder_estado"
                            placeholder="Pago Folder"
                            name="pago_folder_estado"
                            value="{{ old('pago_folder_estado', $estado_verificacione->pago_folder_estado) == 1 ? 'SI' : 'NO' }}"
                            disabled>
                        @error('pago_folder_estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2 mb-3 mt-3">
                        <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" disabled>
                            <option value="1" {{ old('estado', $estado_verificacione->estado) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('estado', $estado_verificacione->estado) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('estado_verificaciones.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection