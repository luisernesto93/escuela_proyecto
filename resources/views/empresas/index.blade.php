@extends('layouts.app')

@section('title', 'Lista de Empresa')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Empresa</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('empresas.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nueva Empresa
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
					<table class="table-sm table-striped table-bordered bg-white shadow fs-12"
						id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Nit</th>
								<th>direcci&oacute;n</th>
								<th>Tel&eacute;fono</th>
								<th>Image1</th>
								<th>Image2</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($empresas))
								@foreach ($empresas as $key => $empresa)
									<tr>
										<td class="p-2 align-middle">{{ $empresa->id }}</td>
										<td class="p-2 align-middle">{{ $empresa->nombre }}</td>
										<td class="p-2 align-middle">{{ $empresa->nit }}</td>
										<td class="p-2 align-middle">{{ $empresa->direccion }}</td>
										<td class="p-2 align-middle">{{ $empresa->telefono }}</td>
										<td class="p-2 align-middle">{{ $empresa->Image1 }}</td>
										<td class="p-2 align-middle">{{ $empresa->Image2 }}</td>
										{{-- <td class="p-2 align-middle"> {{ $empresa->estado_texto }} </td> --}}
										<td class="p-2 align-middle text-center"> {!! $empresa->estado_texto == 'ACTIVO' ? '<span class="badge badge-success shadow">ACTIVO</span>' : '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
										<td style="display: flex">
											<a href="{{ route('empresas.edit', ['empresa' => $empresa->id]) }}"
												class="btn btn-outline-primary m-1">
												<i class="fa fa-pen"></i>
											</a>

											<a class="btn btn-outline-danger m-1" href="#"
												data-toggle="modal" data-target="#deleteModal" data-placement="top">
												<i class="fas fas fa-trash-alt"></i>
											</a>
										</td>
									</tr>
								@endforeach
						@else
								<tr>
									<td colspan="7" class="text-center">No hay empresas registrados</td>
								</tr>
						@endif
						</tbody>
					</table>

					{{-- {{ $empresas->links() }} --}}
				</div>
			</div>
		</div>

	</div>

	@if (count($empresas))
		@include('empresas.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
