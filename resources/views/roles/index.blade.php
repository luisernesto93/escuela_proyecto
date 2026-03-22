@extends('layouts.app')

@section('title', 'Roles')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Roles</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('roles.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> NUEVO ROL
					</a>
				</div>
			</div>

		</div>

		{{-- Alert Messages --}}
		@include('common.alert')

		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
						cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
                                <th>Nombre del Rol</th>
								<th>Tipo de Rol</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($roles as $key => $role)
								<tr>
                                    <td>{{ $key + 1 }}</td>
									<td>{{ $role->name }}</td>
									<td>{{ $role->guard_name }}</td>
									<td style="display: flex">
										<a href="{{ route('roles.edit', ['role' => $role->id]) }}"
											class="btn btn-outline-primary m-1">
											<i class="fa fa-pen"></i>
										</a>
										<form method="POST"
											action="{{ route('roles.destroy', ['role' => $role->id]) }}">
											@csrf
											@method('DELETE')
											<button class="btn btn-outline-danger m-1" type="submit">
												<i class="fa fa-trash"></i>
											</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					{{ $roles->links() }}
				</div>
			</div>
		</div>

	</div>


@endsection
