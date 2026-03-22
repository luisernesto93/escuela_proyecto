@extends('layouts.app')

@section('title', 'Lista de Plaza de Inscripciones')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Plaza de Inscripciones</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('plazoinscripcions.create') }}"
						class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nueva Inscripcion
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
								<th>Fecha Inicio</th>
								<th>Fecha Limite</th>
								<th>Gesti&oacute;n</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($plazoinscripcions))
								@foreach ($plazoinscripcions as $key => $plazoinscripcion)
									<tr>
										<td class="p-2 align-middle">{{ $key + 1 }}</td>
										<td class="p-2 align-middle">
											{{ $plazoinscripcion->fecha_inicio ?? '' }}
										</td>
										<td class="p-2 align-middle">
											{{ $plazoinscripcion->fecha_limite ?? '' }} </td>
										<td class="p-2 align-middle">
											{{ $plazoinscripcion->gestion->descripcion .' - '. $plazoinscripcion->gestion->anio ?? '' }} </td>
										{{-- <td class="p-2 align-middle"> {{ $docente->estado_texto }} </td> --}}
										<td class="p-2 align-middle text-center"> {!! $plazoinscripcion->estado_texto == 'ACTIVO'
										? '<span class="badge badge-success shadow">ACTIVO</span>'
										: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
										<td style="display: flex">
											<a
												href="{{ route('plazoinscripcions.edit', ['plazoinscripcion' => $plazoinscripcion->id]) }}"
												class="btn btn-outline-primary m-1">
												<i class="fa fa-pen"></i>
											</a>
											<a
												href="{{ route('plazoinscripcions.show', ['plazoinscripcion' => $plazoinscripcion->id]) }}"
												class="btn btn-outline-info m-1">
												<i class="fa fa-eye"></i>
											</a>

											@if ($plazoinscripcion->estado == 0)
												<a
													href="{{ route('plazoinscripcions.estado', ['plazoinscripcion_id' => $plazoinscripcion->id, 'estado' => 1]) }}"
													class="btn btn-outline-success m-1">
													<i class="fa fa-check"></i>
												</a>
											@elseif ($plazoinscripcion->estado == 1)
												<a
													href="{{ route('plazoinscripcions.estado', ['plazoinscripcion_id' => $plazoinscripcion->id, 'estado' => 0]) }}"
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
									<td colspan="6" class="text-center">No hay inscripciones registrados
									</td>
								</tr>
							@endif
						</tbody>
					</table>

					{{-- {{ $docentes->links() }} --}}
				</div>
			</div>
		</div>

	</div>

	@if (count($plazoinscripcions))
		@include('plazoinscripcions.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
