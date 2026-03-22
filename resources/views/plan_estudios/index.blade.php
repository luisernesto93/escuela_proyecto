@extends('layouts.app')

@section('title', 'Lista de Plaza de Planes de Estudios')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Planes de Estudios</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('plan_estudios.create') }}"
						class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nuevo Plan Estudios
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
								<th>Resoluci&oacute;n</th>
								<th>&Aacute;rea de Formaci&oacute;n</th>
								<th>Horas Semanales</th>
								<th>Horas Mes</th>
								<th>Horas Geti&oacute;n</th>
								<th>Carga Horaria</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($plan_estudios))
								@foreach ($plan_estudios as $key => $plan_estudio)
									<tr>
										<td class="p-2 align-middle">{{ $plan_estudio->id }}</td>
										<td class="p-2 align-middle">
											{{ $plan_estudio->resolucion->numero_resolucion ?? '' }}
										</td>
										<td class="p-2 align-middle">
											{{ $plan_estudio->area_formacion ?? '' }} </td>
										<td class="p-2 align-middle">
											{{ $plan_estudio->horas_semanales ?? '' }} </td>
										<td class="p-2 align-middle"> {{ $plan_estudio->horas_mes }} </td>
										<td class="p-2 align-middle"> {{ $plan_estudio->horas_gestion }} </td>
										<td class="p-2 align-middle"> {{ $plan_estudio->carga_horaria }} </td>
										<td class="p-2 align-middle text-center"> {!! $plan_estudio->estado_texto == 'ACTIVO'
										? '<span class="badge badge-success shadow">ACTIVO</span>'
										: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
										<td style="display: flex">
											<a
												href="{{ route('plan_estudios.edit', ['plan_estudio' =>  $plan_estudio->id]) }}"
												class="btn btn-outline-primary m-1">
												<i class="fa fa-pen"></i>
											</a>
											<a
												href="{{ route('plan_estudios.show', ['plan_estudio' => $plan_estudio->id]) }}"
												class="btn btn-outline-info m-1">
												<i class="fa fa-eye"></i>
											</a>

											@if ($plan_estudio->estado == 0)
												<a
													href="{{ route('plan_estudios.estado', ['plan_estudios_id' => $plan_estudio->id, 'estado' => 1]) }}"
													class="btn btn-outline-success m-1">
													<i class="fa fa-check"></i>
												</a>
											@elseif ($plan_estudio->estado == 1)
												<a
													href="{{ route('plan_estudios.estado', ['plan_estudios_id' => $plan_estudio->id, 'estado' => 0]) }}"
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
									<td colspan="12" class="text-center">No hay Planes de Estudios registrados
									</td>
								</tr>
							@endif
						</tbody>
					</table>
					{{ $plan_estudios->links() }}
				</div>
			</div>
		</div>

	</div>

	@if (count($plan_estudios))
		@include('plan_estudios.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
