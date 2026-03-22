@extends('layouts.app')

@section('title', 'Lista de Becas')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Becas</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('becas.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nueva Beca
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
								<th>Descripcion</th>
								<th>Porcentaje</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($becas as $beca)
								<tr>
									<td class="p-2 align-middle">{{ $beca->descripcion ?? '' }} </td>
									<td class="p-2 align-middle">{{ $beca->porcentaje }} %</td>
									<td class="p-2 align-middle text-center"> {!! $beca->estado_texto == 'ACTIVO'
									? '<span class="badge badge-success shadow">ACTIVO</span>'
									: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
									<td style="display: flex">
										<a href="{{ route('becas.edit', ['beca' => $beca->id]) }}"
											class="btn btn-outline-primary m-1">
											<i class="fa fa-pen"></i>
										</a>
										<a href="{{ route('becas.show', ['beca' => $beca->id]) }}"
											class="btn btn-outline-info m-1">
											<i class="fa fa-eye"></i>
										</a>
										@if ($beca->estado == 0)
											<a
												href="{{ route('becas.estado', ['beca_id' => $beca->id, 'estado' => 1]) }}"
												class="btn btn-outline-success m-1">
												<i class="fa fa-check"></i>
											</a>
										@elseif ($beca->estado == 1)
											<a
												href="{{ route('becas.estado', ['beca_id' => $beca->id, 'estado' => 0]) }}"
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
						</tbody>
					</table>

					{{-- {{ $becas->links() }} --}}
				</div>
			</div>
		</div>

	</div>

	@if (count($becas))
		@include('becas.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
