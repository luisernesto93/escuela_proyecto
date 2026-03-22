@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')

<div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registrar Nuevo Usuario</h6>
        </div>
        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- First Name --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        Nombres: <span style="color:red;">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="Nombres"
                            name="first_name" 
                            value="{{ old('first_name') }}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        Apellidos:<span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                            id="last_name"
                            placeholder="Apellidos"
                            name="last_name"
                            value="{{ old('last_name') }}">
                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        Correo:<span style="color:red;">*</span></label>
                        <input
                            type="email"
                            class="form-control form-control-user @error('email') is-invalid @enderror" 
                            id="exampleEmail"
                            placeholder="Correo"
                            name="email"
                            value="{{ old('email') }}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Mobile Number --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        Tel&eacute;fono:<span style="color:red;">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror" 
                            id="exampleMobile"
                            placeholder="Tel&eacute;fono"
                            name="mobile_number" 
                            value="{{ old('mobile_number') }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        Rol: <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('role_id') is-invalid @enderror" name="role_id">
                            <option selected disabled>Seleccione un Rol</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        Contrase&ntilde;a: <span style="color:red;">*</span></label>
                        <input 
                            type="password" 
                            class="form-control form-control-user @error('password') is-invalid @enderror" 
                            id="exampleInputPassword"
                            placeholder="Contrase&ntilde;a"
                            name="password" 
                            value="{{ old('password') }}">

                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        Estado: <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                            <option value="1" selected>ACTIVO</option>
                            <option value="0">INACTIVO</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-user float-right mb-3">GUARDAR</button>
                <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">CANCELAR</a>
            </div>
        </form>
    </div>

</div>


@endsection