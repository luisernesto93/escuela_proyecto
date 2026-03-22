@extends('layouts.app')

@section('title', 'Lista de Detalle Incripcion Becas')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Detalle Incripciones con Beca</h1>
			<div class="row">
				{{-- <div class="col-md-12">
					<a href="{{ route('detalle_inscripcion_becas.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nuevo Detalle Incripcion con Becas
					</a>
				</div> --}}
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
								<th>Id Inscripci&oacute;n</th>
								<th>Estudiante</th>
								<th>Beca</th>
								<th>Porcentaje</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($detalle_inscripcion_becas as $detalle_inscripcion_beca)
								<tr>
									<td class="p-2 align-middle">
										{{ $detalle_inscripcion_beca->inscripcion_id ?? ''}}</td>
									<td class="p-2 align-middle">
										{{ $detalle_inscripcion_beca->inscripcion->estudiante->nombres.' '.$detalle_inscripcion_beca->inscripcion->estudiante->apellidos ?? '' }}
									</td>
									<td class="p-2 align-middle">
										{{ $detalle_inscripcion_beca->beca->descripcion.' '.$detalle_inscripcion_beca->beca->porcentaje ?? ''}} %
									</td>
									<td class="p-2 align-middle">
										{{ $detalle_inscripcion_beca->porcentaje ?? ''}} %
									</td>
									<td class="p-2 align-middle text-center"> {!! $detalle_inscripcion_beca->estado_texto == 'ACTIVO'
									? '<span class="badge badge-success shadow">ACTIVO</span>'
									: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
									<td style="display: flex">
										<a href="{{ route('detalle_inscripcion_becas.edit', ['detalle_inscripcion_beca' => $detalle_inscripcion_beca->id]) }}"
											class="btn btn-outline-primary m-1">
											<i class="fa fa-pen"></i>
										</a>
										{{-- <a href="{{ route('detalle_inscripcion_becas.show', ['detalle_inscripcion_beca' => $detalle_inscripcion_beca->id]) }}"
											class="btn btn-outline-info m-1">
											<i class="fa fa-eye"></i>
										</a> --}}
										@if ($detalle_inscripcion_beca->estado == 0)
											<a
												href="{{ route('detalle_inscripcion_becas.estado', ['detalle_inscripcion_beca_id' => $detalle_inscripcion_beca->id, 'estado' => 1]) }}"
												class="btn btn-outline-success m-1">
												<i class="fa fa-check"></i>
											</a>
										@elseif ($detalle_inscripcion_beca->estado == 1)
											<a
												href="{{ route('detalle_inscripcion_becas.estado', ['detalle_inscripcion_beca_id' => $detalle_inscripcion_beca->id, 'estado' => 0]) }}"
												class="btn btn-outline-danger m-1">
												<i class="fa fa-ban"></i>
											</a>
										@endif

										{{-- <a class="btn btn-outline-danger m-1" href="#"
											data-toggle="modal" data-target="#deleteModal" data-placement="top">
											<i class="fas fas fa-trash-alt"></i>
										</a> --}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $detalle_inscripcion_becas->links() }}
				</div>
			</div>
		</div>

	</div>

	{{-- @if (count($detalle_inscripcion_becas))
		@include('detalle_inscripcion_becas.delete-modal')
	@endif --}}
@endsection

@section('scripts')

@endsection
