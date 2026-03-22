@extends('layouts.app')

@section('title', 'DETALLE USUARIO')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary"><i class="fas fa-user-show"></i> DETALLE USUARIO</h6>
        </div>
            <div class="card-body">
                <div class="form-group row">
                    @if ($user != null)
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Nombres:</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('first_name') is-invalid @enderror"
                            id="exampleLastName"
                            placeholder="Nombres"
                            name="first_name"
                            value="{{ old('first_name', $user->first_name) }}"
                            disabled>
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Apellidos:</strong></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('last_name') is-invalid @enderror"
                            placeholder="email"
                            name="last_name"
                            value="{{ old('last_name', $user->last_name) }}"
                            rows="2" disabled>
                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Correo</strong> <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('email') is-invalid @enderror" 
                            id="email"
                            placeholder="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" disabled>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Tel&eacute;fono:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('mobile_number') is-invalid @enderror" 
                            id="mobile_number"
                            placeholder="mobile_number"
                            name="mobile_number"
                            value="{{ old('mobile_number', $user->mobile_number) }}"
                            disabled>
                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Contraseña:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('password') is-invalid @enderror"
                            id="password"
                            placeholder="password"
                            name="password"
                            {{-- value="{{ old('password', $user->password) }}" --}}
                            disabled>
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Rol:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('role_id') is-invalid @enderror"
                            id="role_id"
                            placeholder="role_id"
                            name="role_id"
                            @foreach ($roles as $role)
                            @if ($user->role_id == $role->id)
                            value="{{ old('role_id',$role->name) }}"
                            @endif
                            @endforeach
                            disabled>
                        @error('role_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Fecha Creaci&oacute;n:</strong> <span style="color:red;">*</span> </label>
                        <input
                            type="text"
                            class="form-control form-control-sm @error('created_at') is-invalid @enderror"
                            id="created_at"
                            placeholder="created_at"
                            name="created_at"
                            value="{{ old('created_at', $user->created_at) }}"
                            disabled>
                        @error('created_at')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3 mt-3">
                        <strong>Estado:</strong> </label>
                        <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status" disabled>
                            <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>
            @else
            <tr>
                <td colspan="4" class="text-center">No hay usuarios registrados!</td>
            </tr>
            @endif
            <div class="card-footer">
                <a class="btn btn-outline-success float-right mr-3 mb-3" href="{{ route('users.index') }}"><i class="fas fa-window-close"></i> ATR&Aacute;S</a>
            </div>
    </div>

</div>

@endsection