@extends('layouts.app')

@section('title', 'Lista de Docentes')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Docentes</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('docentes.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nuevo Docente
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
								<th>Nombres y Apellidos</th>
								<th>Documento</th>
								<th>C&oacute;digo Interno</th>
								<th>Observaciones</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($docentes))
								@foreach ($docentes as $key => $docente)
									<tr>
										<td class="p-2 align-middle">{{ $docente->id }}</td>
										<td class="p-2 align-middle">{{ $docente->nombres ?? '' }}
											{{ $docente->apellidos ?? '' }} </td>
										<td class="p-2 align-middle">{{ $docente->documento }}</td>
										<td class="p-2 align-middle">{{ $docente->codigo_interno }}</td>
										<td class="p-2 align-middle">{{ $docente->observaciones }}</td>
										{{-- <td class="p-2 align-middle"> {{ $docente->estado_texto }} </td> --}}
										<td class="p-2 align-middle text-center"> {!! $docente->estado_texto == 'ACTIVO' ? '<span class="badge badge-success shadow">ACTIVO</span>' : '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
										<td style="display: flex">
											<a href="{{ route('docentes.edit', ['docente' => $docente->id]) }}"
												class="btn btn-outline-primary m-1">
												<i class="fa fa-pen"></i>
											</a>
											<a href="{{ route('docentes.show', ['docente' => $docente->id]) }}"
												class="btn btn-outline-info m-1">
												<i class="fa fa-eye"></i>
											</a>
											@if ($docente->estado == 0)
												<a
													href="{{ route('docentes.estado', ['docente_id' => $docente->id, 'estado' => 1]) }}"
													class="btn btn-outline-success m-1">
													<i class="fa fa-check"></i>
												</a>
											@elseif ($docente->estado == 1)
												<a
													href="{{ route('docentes.estado', ['docente_id' => $docente->id, 'estado' => 0]) }}"
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
									<td colspan="7" class="text-center">No hay docentes registrados</td>
								</tr>
						@endif
						</tbody>
					</table>

					{{-- {{ $docentes->links() }} --}}
				</div>
			</div>
		</div>

	</div>

	@if (count($docentes))
		@include('docentes.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
