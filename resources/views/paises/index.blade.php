@extends('layouts.app')

@section('title', 'Lista de Paises')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Paises</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('paises.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nuevo Pais
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
								<th>C&oacute;digo</th>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($paises))
							@foreach ($paises as $pais)
								<tr>
									<td class="p-2 align-middle">{{ $pais->id ?? '' }} </td>
									<td class="p-2 align-middle">{{ $pais->nombre }}</td>
									<td class="p-2 align-middle text-center"> {!! $pais->estado_texto == 'ACTIVO'
									? '<span class="badge badge-success shadow">ACTIVO</span>'
									: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
									<td style="display: flex">
										<a href="{{ route('paises.edit', ['paise' => $pais->id]) }}"
											class="btn btn-outline-primary m-1">
											<i class="fa fa-pen"></i>
										</a>
										<a href="{{ route('paises.show', ['paise' => $pais->id]) }}"
											class="btn btn-outline-info m-1">
											<i class="fa fa-eye"></i>
										</a>
										@if ($pais->estado == 0)
											<a
												href="{{ route('paises.estado', ['pais_id' => $pais->id, 'estado' => 1]) }}"
												class="btn btn-outline-success m-1">
												<i class="fa fa-check"></i>
											</a>
										@elseif ($pais->estado == 1)
											<a
												href="{{ route('paises.estado', ['pais_id' => $pais->id, 'estado' => 0]) }}"
												class="btn btn-outline-danger m-1">
												<i class="fa fa-ban"></i>
											</a>
										@endif

										<a class="btn btn-outline-danger m-1" href="#"
											data-toggle="modal" data-target="#deleteModal" data-placement="top">
											<i class="fas fas fa-trash-alt"></i>
										</a>
									</td>
								</tr>
							@endforeach
							@else
							<tr>
								<td colspan="7" class="text-center">No hay pa&iacute;ses registrados</td>
							</tr>
							@endif
						</tbody>
					</table>

					{{ $paises->links() }}
				</div>
			</div>
		</div>

	</div>

	@if (count($paises))
		@include('paises.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
