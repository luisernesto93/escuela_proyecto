@extends('layouts.app')

@section('title', 'Lista de Modalidad Pagos')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Modalidad Pagos</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('modalidadpagos.create') }}"
						class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nueva Modalidad
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
								<th>descripcion</th>
								<th>Monto a Pagar</th>
								<th>Gestion</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($modalidadpagos))
								@foreach ($modalidadpagos as $key => $modalidadpago)
									<tr>
										<td class="p-2 align-middle">{{ $modalidadpago->id }}</td>
										<td class="p-2 align-middle">
											{{ $modalidadpago->descripcion ?? '' }}
										</td>
										<td class="p-2 align-middle">
											{{ $modalidadpago->monto_pagar ?? '' }} </td>
										<td class="p-2 align-middle">
											{{ $modalidadpago->gestion->descripcion ?? '' }} </td>
										<td class="p-2 align-middle text-center"> {!! $modalidadpago->estado_texto == 'ACTIVO'
										? '<span class="badge badge-success shadow">ACTIVO</span>'
										: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
										<td style="display: flex">
											<a
												href="{{ route('modalidadpagos.edit', ['modalidadpago' => $modalidadpago->id]) }}"
												class="btn btn-outline-primary m-1">
												<i class="fa fa-pen"></i>
											</a>
											<a
												href="{{ route('modalidadpagos.show', ['modalidadpago' => $modalidadpago->id]) }}"
												class="btn btn-outline-info m-1">
												<i class="fa fa-eye"></i>
											</a>
											@if ($modalidadpago->estado == 0)
												<a
													href="{{ route('modalidadpagos.estado', ['modalidadpago_id' => $modalidadpago->id, 'estado' => 1]) }}"
													class="btn btn-outline-success m-1">
													<i class="fa fa-check"></i>
												</a>
											@elseif ($modalidadpago->estado == 1)
												<a
													href="{{ route('modalidadpagos.estado', ['modalidadpago_id' => $modalidadpago->id, 'estado' => 0]) }}"
													class="btn btn-outline-danger m-1">
													<i class="fa fa-ban"></i>
												</a>
											@endif

											<a class="btn btn-outline-danger m-1" href="#" data-toggle="modal" data-target="#deleteModal" data-placement="top">
												<i class="fas fas fa-trash-alt"></i>
											</a>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="6" class="text-center">No hay Modalidades registrados
									</td>
								</tr>
							@endif
						</tbody>
					</table>

					{{-- {{ $modalidadpagos->links() }} --}}
				</div>
			</div>
		</div>

	</div>

    @if (count($modalidadpagos)) {{-- verificar si hay datos o no --}}
        @include('modalidadpagos.delete-modal')
    @endif
@endsection

@section('scripts')

@endsection
