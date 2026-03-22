@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Usuarios</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> Nuevo Usuario
                    </a>
                    <a href="{{ route('users.export') }}" class="btn btn-outline-success">
                        <i class="fas fa-file-excel"></i> Exportar
                    </a>
                </div>
            </div>
        </div>

        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Todos los Usuarios</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Celular</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users))
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile_number }}</td>
                                        <td>{{ $user->role->name ?? 'N/A' }}</td>
                                        {{-- <td>{{ $user->roles ? $user->roles->pluck('name')->first() : 'N/A' }}</td> --}}
                                        <td>
                                            @if ($user->status == 0)
                                                <span class="badge badge-danger">INACTIVO</span>
                                            @elseif ($user->status == 1)
                                                <span class="badge badge-success">ACTIVO</span>
                                            @endif
                                        </td>
                                        <td style="display: flex">

                                            @if ($user->status == 0)
                                                <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                                    class="btn btn-success m-2">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @elseif ($user->status == 1)
                                                <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                                    class="btn btn-danger m-2">
                                                    <i class="fa fa-ban"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-primary m-2">
                                                <i class="fa fa-pen"></i>
                                            </a>

                                            <a href="{{ route('users.show', ['user' => $user->id]) }}"
                                                class="btn btn-info m-2">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal"
                                                data-target="#deleteModal">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No hay Usuarios registrados!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('users.delete-modal')

@endsection

@section('scripts')

@endsection
